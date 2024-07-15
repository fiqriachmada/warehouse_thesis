<?php

namespace App\Repositories;

use App\Models\Rack;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;

class RackRepository
{
    public function getAllRacks()
    {
        return Rack::all();
    }

    public function getRack($id)
    {
        return Rack::find($id);
    }

    public function getAllRackByWarehouseIdAndTenantId($warehouse_id)
    {
        return Rack::where('warehouse_id', $warehouse_id)->where('tenant_id', auth()->user()->tenant->id)->get();
    }

    public function createRack($warehouse, $request)
    {
        return Rack::create([
            'id' => Uuid::uuid4()->toString(),
            'warehouse_id' => $warehouse->id,
            'tenant_id' => auth()->user()->tenant->id,
            'subscription_id' => $warehouse->rented->warehouse_subscription->subscription_id,
            'name' => $request->name
        ]);
    }

    public function updateRack($request, $rack)
    {
        return $rack->update([
            'name' => $request->name
        ]);
    }

    public function deleteRack($warehouse, $rack)
    {
        return DB::transaction(function () use ($warehouse, $rack) {
            if ($rack->trashed()) {
                return $rack->forceDelete();
            } else {
                return $rack->delete();
            }
        });
    }
}