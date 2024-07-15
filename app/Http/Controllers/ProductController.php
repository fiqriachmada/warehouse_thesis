<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Repositories\RackRepository;
use App\Repositories\ProductRepository;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Repositories\ProductCategoryRepository;

class ProductController extends Controller
{
    protected $productCategoryRepository, $rackRepository, $productRepository;

    public function __construct(ProductCategoryRepository $productCategoryRepository, RackRepository $rackRepository, ProductRepository $productRepository)
    {
        $this->productCategoryRepository = $productCategoryRepository;
        $this->rackRepository = $rackRepository;
        $this->productRepository = $productRepository;
    }

    public function warehouse_product_index(Warehouse $warehouse)
    {
        return view('pages.warehouse.master.product.index', [
            'warehouse' => $warehouse
        ]);
    }

    public function warehouse_product_create(Warehouse $warehouse)
    {
        return view('pages.warehouse.master.product.add', [
            'warehouse' => $warehouse,
            'categories' => $this->productCategoryRepository->getAllProductCategoryByWarehouseIdAndTenantId($warehouse->id),
            'racks' => $this->rackRepository->getAllRackByWarehouseIdAndTenantId($warehouse->id)
        ]);
    }

    public function warehouse_product_store(ProductStoreRequest $request, Warehouse $warehouse)
    {
        try {
            if ($this->productRepository->createProduct($request, $warehouse)) {
                return redirect()->back()->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Create Product Success!'
                ]);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function warehouse_product_edit(Warehouse $warehouse, Product $product)
    {
        return view('pages.warehouse.master.product.edit', [
            'warehouse' => $warehouse,
            'product' => $product,
            'categories' => $this->productCategoryRepository->getAllProductCategoryByWarehouseIdAndTenantId($warehouse->id),
            'racks' => $this->rackRepository->getAllRackByWarehouseIdAndTenantId($warehouse->id)
        ]);
    }

    public function warehouse_product_update(ProductUpdateRequest $request, Warehouse $warehouse, Product $product)
    {
        try {
            if ($this->productRepository->updateProduct($request, $warehouse, $product)) {
                return redirect()->back()->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Update Product Success!'
                ]);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function warehouse_product_delete(Warehouse $warehouse, Product $product)
    {
        if ($this->productRepository->deleteProduct($warehouse, $product)) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Product has been deleted!'
            ]);
        }
    }
}
