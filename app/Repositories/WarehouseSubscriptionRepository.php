<?php

namespace App\Repositories;

use Ramsey\Uuid\Uuid;
use App\Models\WarehouseSubscription;

class WarehouseSubscriptionRepository
{
    protected $warehouseSubscriptionCartRepository;

    public function __construct(WarehouseSubscriptionCartRepository $warehouseSubscriptionCartRepository)
    {
        $this->warehouseSubscriptionCartRepository = $warehouseSubscriptionCartRepository;
    }

    public function getAllWarehouseSubscriptions()
    {
        return WarehouseSubscription::orderBy('created_at', 'ASC');
    }

    public function getWarehouseSubscription($id)
    {
        return WarehouseSubscription::find($id);
    }

    public function getWarehouseSubscriptionByWarehouseId($id)
    {
        if ($id != null) {
            return WarehouseSubscription::where('warehouse_id', $id)->get();
        }
    }

    public function getWarehouseSubscriptionByWheres(array $wheres)
    {
        $query = self::getAllWarehouseSubscriptions();

        foreach ($wheres as $key => $value) {
            $query->where($key, $value);
        }

        return $query->get();
    }

    public function getWarehouseSubscriptionByShortestMonthDuration($warehouse_id)
    {
        // return WarehouseSubscription::orderBy('subscriptions.month_duration', 'ASC')->where('warehouse_id', $warehouse_id)->first();
    }

    public function createWarehouseSubscription()
    {
        $warehouse_subscription = $this->warehouseSubscriptionCartRepository->getFirstWarehouseSubscriptionCart();

        if (count(self::getWarehouseSubscriptionByWheres(['warehouse_id' => $warehouse_subscription->warehouse_id, 'subscription_id' => $warehouse_subscription->subscription_id])) > 0) {
            return false;
        }

        if ($warehouse_subscription) {
            WarehouseSubscription::create([
                'id' => Uuid::uuid4()->toString(),
                'warehouse_id' => $warehouse_subscription->warehouse_id,
                'subscription_id' => $warehouse_subscription->subscription_id,
                'price_rate' => $warehouse_subscription->price_rate,
                'total_price' => $warehouse_subscription->total_price
            ]);

            $this->warehouseSubscriptionCartRepository->deleteWarehouseSubscriptionCart($warehouse_subscription->id);

            return true;
        }
    }

    public function updateWarehouseSubscription($id)
    {
        $warehouse_subscription_cart = $this->warehouseSubscriptionCartRepository->getFirstWarehouseSubscriptionCart();

        if ($warehouse_subscription_cart) {
            self::getWarehouseSubscription($id)->update([
                'warehouse_id' => $warehouse_subscription_cart->warehouse_id,
                'subscription_id' => $warehouse_subscription_cart->subscription_id,
                'price_rate' => $warehouse_subscription_cart->price_rate,
                'total_price' => $warehouse_subscription_cart->total_price
            ]);
    
            $this->warehouseSubscriptionCartRepository->resetWarehouseSubscriptionCart($warehouse_subscription_cart->id);
    
            return true;
        }
    }
}