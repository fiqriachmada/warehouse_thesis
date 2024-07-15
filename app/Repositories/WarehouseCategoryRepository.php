<?php

namespace App\Repositories;

use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use App\Models\WarehouseCategory;
use Illuminate\Support\Collection;

class WarehouseCategoryRepository
{
    public function getAllWarehouseCategories()
    {
        return WarehouseCategory::orderBy('category', 'ASC')->get();
    }

    public function getAllWarehouseCategoriesExistingInWarehouse()
    {
        return WarehouseCategory::join('warehouses', 'warehouse_categories.id', '=', 'warehouses.warehouse_category_id')
                                ->select('warehouse_categories.*');
    }

    public function getWarehouseCategory($id)
    {
        return WarehouseCategory::find($id);
    }

    public function createWarehouseCategory($data)
    {
        return WarehouseCategory::create([
            'id' => Uuid::uuid4()->toString(),
            'category' => $data['category']
        ]);
    }

    public function updateWarehouseCategory($data, $id)
    {
        return self::getWarehouseCategory($id)->update([
            'category' => $data['category']
        ]);
    }

    public function deleteWarehouseCategory($id)
    {
        return self::getWarehouseCategory($id)->delete();
    }
}