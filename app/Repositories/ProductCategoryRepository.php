<?php

namespace App\Repositories;

use Ramsey\Uuid\Uuid;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;

class ProductCategoryRepository
{
    public function getAllProductCategories()
    {
        return ProductCategory::all();
    }

    public function getProductCategory($id)
    {
        return ProductCategory::find($id);
    }

    public function getAllProductCategoryByWarehouseIdAndTenantId($warehouse_id)
    {
        return ProductCategory::where('warehouse_id', $warehouse_id)->where('tenant_id', auth()->user()->tenant->id)->get();
    }

    public function createProductCategory($warehouse, $request)
    {
        return ProductCategory::create([
            'id' => Uuid::uuid4()->toString(),
            'warehouse_id' => $warehouse->id,
            'tenant_id' => auth()->user()->tenant->id,
            'subscription_id' => $warehouse->rented->warehouse_subscription->subscription_id,
            'name' => $request->name
        ]);
    }

    public function updateProductCategory($request, $category)
    {
        return $category->update([
            'name' => $request->name
        ]);
    }

    public function deleteProductCategory($warehouse, $category)
    {
        return DB::transaction(function () use ($warehouse, $category) {
            if ($category->trashed()) {
                return $category->forceDelete();
            } else {
                return $category->delete();
            }
        });
    }
}