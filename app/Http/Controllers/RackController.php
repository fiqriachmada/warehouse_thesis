<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Repositories\RackRepository;
use App\Http\Requests\RackStoreRequest;
use App\Http\Requests\RackUpdateRequest;
use App\Models\Rack;

class RackController extends Controller
{
    protected $rackRepository;

    public function __construct(RackRepository $rackRepository)
    {
        $this->rackRepository = $rackRepository;
    }

    public function warehouse_rack_index(Warehouse $warehouse)
    {
        return view('pages.warehouse.master.rack.index', [
            'warehouse' => $warehouse
        ]);
    }

    public function warehouse_rack_store(Warehouse $warehouse, RackStoreRequest $request)
    {
        try {
            if ($this->rackRepository->createRack($warehouse, $request)) {
                return redirect()->back()->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Create Rack Success!'
                ]);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function warehouse_rack_update(RackUpdateRequest $request, Rack $rack)
    {
        try {
            if ($this->rackRepository->updateRack($request, $rack)) {
                return redirect()->back()->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Update Rack Success!'
                ]);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function warehouse_rack_show(Warehouse $warehouse, Rack $rack)
    {
        return view('pages.warehouse.master.rack.show', [
            'warehouse' => $warehouse,
            'rack' => $rack
        ]);
    }

    public function warehouse_rack_delete(Warehouse $warehouse, Rack $rack)
    {
        try {
            if ($this->rackRepository->deleteRack($warehouse, $rack)) {
                return redirect()->back()->with([
                    'flash-type' => 'sweetalert',
                    'case' => 'default',
                    'position' => 'center',
                    'type' => 'success',
                    'message' => 'Delete Rack Success!'
                ]);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
