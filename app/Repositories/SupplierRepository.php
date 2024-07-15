<?php

namespace App\Repositories;

use Ramsey\Uuid\Uuid;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;

class SupplierRepository
{
    public function getAllSuppliers()
    {
        return Supplier::all();
    }

    public function getSupplier($id)
    {
        return Supplier::find($id);
    }

    public function getAllSupplierByWarehouseIdAndTenantId($warehouse_id)
    {
        return Supplier::where('warehouse_id', $warehouse_id)->where('tenant_id', auth()->user()->tenant->id)->get();
    }

    public function createSupplier($data, $warehouse)
    {
        $supplier_id = Uuid::uuid4()->toString();

        DB::transaction(function () use ($data, $warehouse, $supplier_id) {
            Supplier::create([
                'id' => $supplier_id,
                'tenant_id' => auth()->user()->tenant->id,
                'warehouse_id' => $warehouse->id,
                'subscription_id' => $warehouse->rented->warehouse_subscription->subscription_id,
                'name' => $data->name,
                'address' => $data->address,
                'phone' => $data->phone,
                'email' => $data->email
            ]);
        });

        return true;
    }

    public function updateSupplier($request, $supplier)
    {
        return $supplier->update([
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email
        ]);
    }

    public function deleteSupplier($warehouse, $supplier)
    {
        return DB::transaction(function () use ($warehouse, $supplier) {
            if ($supplier->trashed()) {
                return $supplier->forceDelete();
            } else {
                return $supplier->delete();
            }
        });
    }

    public function getAllSupplierWithJoinBatch($warehouse)
    {
        return Supplier::join('batches', 'suppliers.id', '=', 'batches.supplier_id')
                        ->select('suppliers.id', 'suppliers.name as supplier_name', DB::raw('SUM(batches.on_hand) as on_hand'))
                        ->where('suppliers.warehouse_id', $warehouse->id)
                        ->where('suppliers.tenant_id', auth()->user()->tenant->id)
                        ->groupBy('suppliers.id')
                        ->get();
    }

    public function getAllSupplierWithJoinProduct()
    {
        return Supplier::join('batches', 'suppliers.id', '=', 'batches.supplier_id')
                        ->join('products', 'batches.product_id', '=', 'products.id')
                        ->get();
    }
}