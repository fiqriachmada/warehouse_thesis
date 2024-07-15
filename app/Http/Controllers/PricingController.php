<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Repositories\RentedRepository;
use App\Repositories\WarehouseRepository;
use App\Repositories\TempTransactionRepository;
use App\Repositories\WarehouseCategoryRepository;

class PricingController extends Controller
{
    protected $warehouseRepository, $tempTransactionRepository, $warehouseCategoryRepository, $rentedRepository;

    public function __construct(WarehouseRepository $warehouseRepository, TempTransactionRepository $tempTransactionRepository, WarehouseCategoryRepository $warehouseCategoryRepository, RentedRepository $rentedRepository)
    {
        $this->warehouseRepository = $warehouseRepository;
        $this->tempTransactionRepository = $tempTransactionRepository;
        $this->warehouseCategoryRepository = $warehouseCategoryRepository;
        $this->rentedRepository = $rentedRepository;
    }

    public function pricing_index($warehouse_category)
    {
        $warehouse_categories = $this->warehouseCategoryRepository->getAllWarehouseCategories();

        if ($warehouse_category == 'all') {
            $warehouses = empty($this->warehouseCategoryRepository->getAllWarehouseCategoriesExistingInWarehouse()->first()->id) ? $this->warehouseRepository->getAllWarehouses() : $this->warehouseRepository->getAllWarehouses()->where('warehouse_category_id' ,$this->warehouseCategoryRepository->getAllWarehouseCategoriesExistingInWarehouse()->first()->id);

            $warehouse_ids = array();

            foreach ($warehouses as $warehouse) {
                $warehouse_ids[] = $warehouse->id;
            }
        } else {
            $warehouses = $this->warehouseRepository->getAllWarehouses()->where('warehouse_category_id', $warehouse_category);

            $warehouse_ids = array();

            foreach ($warehouses as $warehouse) {
                $warehouse_ids[] = $warehouse->id;
            }
        }

        $category = null;

        $warehouse_categories_exist = empty($this->warehouseCategoryRepository->getAllWarehouseCategoriesExistingInWarehouse()->first()->id) ? '' : $this->warehouseCategoryRepository->getAllWarehouseCategoriesExistingInWarehouse()->first()->id;

        $warehouse_categories_non_exist = empty($this->warehouseCategoryRepository->getWarehouseCategory($warehouse_category)->id) ? '' : $this->warehouseCategoryRepository->getWarehouseCategory($warehouse_category)->id;

        $category = $warehouse_category == 'all' ? $warehouse_categories_exist : $warehouse_categories_non_exist;

        return view('pages.tenant.pricing.index', compact('warehouses', 'category', 'warehouse_categories', 'warehouse_ids'));
    }

    public function pricing_store_cart(Warehouse $warehouse)
    {
        if ($this->rentedRepository->getRentedByWarehouseId($warehouse->id, 'count')) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'warning',
                'message' => 'Warehouse has been rented'
            ]);
        }

        if ($this->tempTransactionRepository->getTempTransactionByWarehouseId($warehouse->id)) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'warning',
                'message' => 'Warehouse is already in cart'
            ]);
        }
        
        if ($this->tempTransactionRepository->createTempTransaction($warehouse)) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Warehouse added to cart'
            ]);
        }
    }

    public function pricing_show(Warehouse $warehouse)
    {
        return view('pages.tenant.pricing.show', compact('warehouse'));
    }
}
