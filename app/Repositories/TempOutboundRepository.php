<?php 

namespace App\Repositories;

use Ramsey\Uuid\Uuid;
use App\Models\Customer;
use App\Models\Outbound;
use App\Models\TempOutbound;
use App\Models\DetailOutbound;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class TempOutboundRepository
{
    protected $inboundRepository;

    public function __construct(InboundRepository $inboundRepository)
    {
        $this->inboundRepository = $inboundRepository;
    }

    public function getAllTempOutbounds()
    {
        return TempOutbound::all();
    }

    public function getAllTempOutboundsByWarehouseIdAndTenantId($warehouse)
    {
        return TempOutbound::where('tenant_id', auth()->user()->tenant->id)->where('warehouse_id', $warehouse->id)->orderBy('created_at')->get();
    }

    public function checkTempOutbounds($warehouse)
    {
        return TempOutbound::where('tenant_id', auth()->user()->tenant->id)
                            ->where('warehouse_id', $warehouse->id)
                            ->where('subscription_id', $warehouse->rented->warehouse_subscription->subscription_id)
                            ->count();
    }

    public function checkIfCustomerExist($warehouse, $customer)
    {
        return TempOutbound::where('tenant_id', auth()->user()->tenant->id)
                            ->where('warehouse_id', $warehouse->id)
                            ->where('subscription_id', $warehouse->rented->warehouse_subscription->subscription_id)
                            ->where('customer_id', $customer->id)
                            ->count();
    }

    public function checkIfProductExist($warehouse)
    {
        $check_products = TempOutbound::where('tenant_id', auth()->user()->tenant->id)
                            ->where('warehouse_id', $warehouse->id)
                            ->where('subscription_id', $warehouse->rented->warehouse_subscription->subscription_id)
                            ->get();

        $counter = 0;

        foreach ($check_products as $key => $check_product) {
            if ($check_product->product_id) {
                $counter++;
            }
        }

        return $counter;
    }

    public function getProductsTempOutbounds($warehouse)
    {
        return TempOutbound::where('tenant_id', auth()->user()->tenant->id)
                            ->where('warehouse_id', $warehouse->id)
                            ->where('subscription_id', $warehouse->rented->warehouse_subscription->subscription_id)
                            ->get();
    }

    public function getFirstProductsTempOutbounds($warehouse)
    {
        return TempOutbound::where('tenant_id', auth()->user()->tenant->id)
                            ->where('warehouse_id', $warehouse->id)
                            ->where('subscription_id', $warehouse->rented->warehouse_subscription->subscription_id)
                            ->first();
    }
    
    public function getCustomerTempOutbounds($warehouse)
    {
        $customers = TempOutbound::where('tenant_id', auth()->user()->tenant->id)
                            ->where('warehouse_id', $warehouse->id)
                            ->where('subscription_id', $warehouse->rented->warehouse_subscription->subscription_id)
                            ->get();

        $item = array();
        foreach ($customers as $key => $customer) {
            if (empty($customer->customer_id)) {
                $itwm[] = '';
            } else {
                $item[] = $customer->customer_id;
            }
        }

        return Customer::where('warehouse_id', $warehouse->id)
                    ->where('tenant_id', auth()->user()->tenant->id)
                    ->whereNotIn('id', $item)
                    ->get();
    }

    public function updateTempOutboundWithNewCustomer($warehouse, $customer)
    {
        return TempOutbound::where('tenant_id', auth()->user()->tenant->id)
                            ->where('warehouse_id', $warehouse->id)
                            ->where('subscription_id', $warehouse->rented->warehouse_subscription->subscription_id)
                            ->update([
                                'customer_id' => $customer->id
                            ]);
    }

    public function createTempOutboundWithNewCustomer($warehouse, $customer)
    {
        if (self::checkTempOutbounds($warehouse) > 0) {
            return self::updateTempOutboundWithNewCustomer($warehouse, $customer);
        } else {
            return false;
        }
    }

    public function checkIfProductExistById($warehouse, $product)
    {
        return TempOutbound::where('tenant_id', auth()->user()->tenant->id)
                            ->where('warehouse_id', $warehouse->id)
                            ->where('subscription_id', $warehouse->rented->warehouse_subscription->subscription_id)
                            ->where('product_id', $product->id)
                            ->count();
    }

    public function createTempOutboundWithNewOneProduct($warehouse, $product)
    {
        if (!self::checkIfProductExistById($warehouse, $product)) {
            DB::transaction(function () use ($warehouse, $product) {
                TempOutbound::create([
                    'id' => Uuid::uuid4()->toString(),
                    'tenant_id' => auth()->user()->tenant->id,
                    'warehouse_id' => $warehouse->id,
                    'subscription_id' => $warehouse->rented->warehouse_subscription->subscription_id,
                    'product_id' => $product->id,
                    'quantity' => 1,
                    'subtotal' => $product->sale_price
                ]);
            });
            
            return true;
        }
    }

    public function createTempOutboundWithNewProducts($warehouse, $products)
    {
        foreach ($products['product_ids'] as $key => $product) {
            $find_product = Product::find($product);
            self::createTempOutboundWithNewOneProduct($warehouse, $find_product);
        }

        return true;
    }

    public function updateQuantityProductTempOutbound($data, $tempOutbound)
    {
        return TempOutbound::where('id', $tempOutbound->id)
                            ->update([
                                'quantity' => $data->quantity,
                                'subtotal' => $tempOutbound->product->sale_price * $data->quantity
                            ]);
    }

    public function storeOutbound($warehouse, $data)
    {
        $tempOutbound = self::getFirstProductsTempOutbounds($warehouse);
        $tempOutbounds = self::getProductsTempOutbounds($warehouse);

        $outbound_id = Uuid::uuid4()->toString();

        DB::transaction(function () use ($tempOutbound, $tempOutbounds, $data, $warehouse, $outbound_id) {

            Outbound::create([
                'id' => $outbound_id,
                'tenant_id' => $tempOutbound->tenant_id,
                'warehouse_id' => $tempOutbound->warehouse_id,
                'subscription_id' => $tempOutbound->subscription_id,
                'customer_id' => $tempOutbound->customer_id,
                'amount_total' => $tempOutbounds->sum('quantity'),
                'grand_total' => $tempOutbounds->sum('subtotal'),
                'description' => $data->description ?? ''
            ]);

            foreach ($tempOutbounds as $key => $tempOutbound) {
                DetailOutbound::create([
                    'id' => Uuid::uuid4()->toString(),
                    'tenant_id' => $tempOutbound->tenant_id,
                    'warehouse_id' => $tempOutbound->warehouse_id,
                    'subscription_id' => $tempOutbound->subscription_id,
                    'outbound_id' => $outbound_id,
                    'product_id' => $tempOutbound->product_id,
                    'quantity' => $tempOutbound->quantity,
                    'subtotal' => $tempOutbound->subtotal
                ]);

                $this->inboundRepository->updateAvailableProductStockInbound($warehouse, $tempOutbound->product, $tempOutbound->quantity);
            }

            self::deleteTempOutbounds($warehouse);
        });

        return $outbound_id;
    }

    public function destroyTempOutboundById($id)
    {
        return TempOutbound::destroy($id);
    }

    public function deleteTempOutbounds($warehouse)
    {
        return TempOutbound::where('tenant_id', auth()->user()->tenant->id)
                            ->where('warehouse_id', $warehouse->id)
                            ->where('subscription_id', $warehouse->rented->warehouse_subscription->subscription_id)
                            ->delete();
    }

    public function destroyTempOutboundsById($data)
    {
        return TempOutbound::whereIn('id', $data->temp_outbound_ids)->delete();
    }
}