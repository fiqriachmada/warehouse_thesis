<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductCategoryStoreRequest;
use App\Http\Requests\ProductCategoryUpdateRequest;
use App\Models\ProductCategory;
use App\Models\Warehouse;
use App\Repositories\ProductCategoryRepository;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    protected $productCategoryRepository;

    public function __construct(ProductCategoryRepository $productCategoryRepository)
    {
        $this->productCategoryRepository = $productCategoryRepository;
    }

    public function warehouse_category_index(Warehouse $warehouse)
    {
        return view('pages.warehouse.master.category.index', [
            'warehouse' => $warehouse
        ]);
    }

    public function warehouse_category_store(Warehouse $warehouse, ProductCategoryStoreRequest $request)
    {
        try {
            if ($this->productCategoryRepository->createProductCategory($warehouse, $request)) {
                return redirect()->back()->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Create Category Success!'
                ]);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function warehouse_category_update(ProductCategoryUpdateRequest $request,ProductCategory $category)
    {
        try {
            if ($this->productCategoryRepository->updateProductCategory($request, $category)) {
                return redirect()->back()->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Update Category Success!'
                ]);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function warehouse_category_show(Warehouse $warehouse, ProductCategory $category)
    {
        return view('pages.warehouse.master.category.show', [
            'warehouse' => $warehouse,
            'category' => $category
        ]);
    }

    public function warehouse_category_delete(Warehouse $warehouse, ProductCategory $category)
    {
        if ($this->productCategoryRepository->deleteProductCategory($warehouse, $category)) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Category has been deleted!'
            ]);
        }
    }
}
