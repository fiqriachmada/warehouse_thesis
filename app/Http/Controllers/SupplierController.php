<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Repositories\SupplierRepository;
use App\Http\Requests\SupplierStoreRequest;
use App\Http\Requests\SupplierUpdateRequest;
use App\Models\Supplier;

class SupplierController extends Controller
{
    protected $supplierRepository;

    public function __construct(SupplierRepository $supplierRepository)
    {
        $this->supplierRepository = $supplierRepository;
    }

    public function warehouse_supplier_index(Warehouse $warehouse)
    {
        return view('pages.warehouse.master.supplier.index', [
            'warehouse' => $warehouse
        ]);
    }

    public function warehouse_supplier_store(SupplierStoreRequest $request, Warehouse $warehouse)
    {
        try {
            if ($this->supplierRepository->createSupplier($request, $warehouse)) {
                return redirect()->back()->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Create Supplier Success!'
                ]);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function warehouse_supplier_update(SupplierUpdateRequest $request, Supplier $supplier)
    {
        try {
            if ($this->supplierRepository->updateSupplier($request, $supplier)) {
                return redirect()->back()->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Update Supplier Success!'
                ]);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function warehouse_supplier_delete(Warehouse $warehouse, Supplier $supplier)
    {
        try {
            if ($this->supplierRepository->deleteSupplier($warehouse, $supplier)) {
                return redirect()->back()->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Delete Supplier Success!'
                ]);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
