<?php

namespace App\Repositories;

use Ramsey\Uuid\Uuid;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Repositories\TempOutboundRepository;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductRepository
{
    protected $tempOutboundRepository;

    public function __construct(TempOutboundRepository $tempOutboundRepository)
    {
        $this->tempOutboundRepository = $tempOutboundRepository;
    }

    public function getAllProducts()
    {
        return Product::all();
    }

    public function getProduct($id)
    {
        return Product::find($id);
    }

    public function getAllProductByWarehouseIdAndTenantId($warehouse_id)
    {
        return Product::where('warehouse_id', $warehouse_id)->where('tenant_id', auth()->user()->tenant->id)->get();
    }
    public function getAllProductByWarehouseIdAndTenantIdWithActualStockNoZero($warehouse)
    {
        $check_products_outbound = $this->tempOutboundRepository->getProductsTempOutbounds($warehouse);

        $products = array();
        foreach ($check_products_outbound as $key => $product) {
            $products[] = $product->product_id;
        }

        // return Product::join('batches', 'products.id', '=', 'batches.product_id')
        //             ->select('products.*', DB::raw('sum(batches.available) as available'))
        //             ->where('available', '>', 0)
        //             ->where('products.warehouse_id', $warehouse->id)
        //             ->where('products.tenant_id', auth()->user()->tenant->id)
        //             ->whereNotIn('products.id', $products)
        //             ->groupBy('products.id')
        //             ->get();

        return Product::join('batches', 'products.id', '=', 'batches.product_id')
            ->select('products.*')
            ->where('batches.available', '>', 0)
            ->where('products.warehouse_id', $warehouse->id)
            ->whereNotIn('products.id', $products)
            ->get();
    }

    public function createProduct($data, $warehouse)
    {
        $product_id = Uuid::uuid4()->toString();

        DB::transaction(function () use ($data, $warehouse, $product_id) {
            $product = Product::create([
                'id' => $product_id,
                'tenant_id' => auth()->user()->tenant->id,
                'warehouse_id' => $warehouse->id,
                'subscription_id' => $warehouse->rented->warehouse_subscription->subscription_id,
                'product_category_id' => $data->product_category_id,
                'rack_id' => $data->rack_id,
                'name' => $data->name,
                'sale_price' => intval(preg_replace("/[^0-9]/", "", $data->sale_price)),
                'weight' => $data->weight,
                'length' => $data->length ?? null,
                'width' => $data->width ?? null,
                'height' => $data->height ?? null,
                'expired_date' => $data->expired_date ?? null,
                'description' => $data->description ?? null
            ]);

            if ($data->hasFile('product_image')) {
                foreach ($data->file('product_image') as $key => $file) {
                    $media = $warehouse->addMedia($file)
                        ->withResponsiveImages()
                        ->toMediaCollection('product_images');

                    $media->update([
                        'model_id' => $product_id,
                        'model_type' => Product::class,
                    ]);
                }
            }
        });

        return true;
    }

    public function updateProduct($data, $warehouse, $product)
    {
        DB::transaction(function () use ($data, $warehouse, $product) {
            $product->update([
                'tenant_id' => auth()->user()->tenant->id,
                'warehouse_id' => $warehouse->id,
                'subscription_id' => $warehouse->rented->warehouse_subscription->subscription_id,
                'product_category_id' => $data->product_category_id,
                'rack_id' => $data->rack_id,
                'name' => $data->name,
                'sale_price' => intval(preg_replace("/[^0-9]/", "", $data->sale_price)),
                'weight' => $data->weight,
                'length' => $data->length ?? null,
                'width' => $data->width ?? null,
                'height' => $data->height ?? null,
                'expired_date' => $data->expired_date ?? null,
                'description' => $data->description ?? null
            ]);

            if (!empty($data->product_image_uuid)) {
                foreach ($data->product_image_uuid as $key => $uuid) {
                    Media::where('uuid', $uuid)->where('model_type', Product::class)->delete();
                }
            }

            if ($data->hasFile('product_image_one')) {
                $media = $product->addMedia($data->file('product_image_one'))
                    ->withResponsiveImages()
                    ->toMediaCollection('product_images');

                $media->update([
                    'model_id' => $product->id,
                    'model_type' => Product::class,
                ]);
            }

            if ($data->hasFile('product_image_two')) {
                $media = $product->addMedia($data->file('product_image_two'))
                    ->withResponsiveImages()
                    ->toMediaCollection('product_images');

                $media->update([
                    'model_id' => $product->id,
                    'model_type' => Product::class,
                ]);
            }

            if ($data->hasFile('product_image_three')) {
                $media = $product->addMedia($data->file('product_image_three'))
                    ->withResponsiveImages()
                    ->toMediaCollection('product_images');

                $media->update([
                    'model_id' => $product->id,
                    'model_type' => Product::class,
                ]);
            }

            if ($data->hasFile('product_image_four')) {
                $media = $product->addMedia($data->file('product_image_four'))
                    ->withResponsiveImages()
                    ->toMediaCollection('product_images');

                $media->update([
                    'model_id' => $product->id,
                    'model_type' => Product::class,
                ]);
            }

            if ($data->hasFile('product_image_five')) {
                $media = $product->addMedia($data->file('product_image_five'))
                    ->withResponsiveImages()
                    ->toMediaCollection('product_images');

                $media->update([
                    'model_id' => $product->id,
                    'model_type' => Product::class,
                ]);
            }
        });

        return true;
    }

    public function deleteProduct($warehouse, $product)
    {
        return DB::transaction(function () use ($warehouse, $product) {
            $product->clearMediaCollection('product_images');

            if ($product->trashed()) {
                return $product->forceDelete();
            } else {
                return $product->delete();
            }
        });
    }

    public function getAllProductWithJoinDetailOutbound($warehouse)
    {
        return Product::join('detail_outbounds', 'products.id', '=', 'detail_outbounds.product_id')
            ->select('products.id', 'products.name as product_name', DB::raw('SUM(detail_outbounds.quantity) as quantity'), DB::raw('SUM(detail_outbounds.subtotal) as subtotal'))
            ->where('products.warehouse_id', $warehouse->id)
            ->where('products.tenant_id', auth()->user()->tenant->id)
            ->groupBy('products.id')
            ->get();
    }

    public function getAllOfTimeRents()
    {
        return Product::join('tenants', 'tenants.id', '=', 'products.tenant_id')
            ->get();
    }
}
