<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function warehouse_inventory_index(Warehouse $warehouse)
    {
        return view('pages.warehouse.inventory.index', [
            'warehouse' => $warehouse
        ]);
    }
}
