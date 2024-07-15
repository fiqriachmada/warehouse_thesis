<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Mail;
use App\Repositories\WarehouseRepository;
use App\Repositories\TransactionRepository;

class GuestController extends Controller
{
    protected $warehouseRepository, $transactionRepository, $userRepository;

    public function __construct(WarehouseRepository $warehouseRepository, TransactionRepository $transactionRepository, UserRepository $userRepository)
    {
        $this->warehouseRepository = $warehouseRepository;
        $this->transactionRepository = $transactionRepository;
        $this->userRepository = $userRepository;
    }

    public function about()
    {
        return view('pages.guest.about.index', [
            'transactions' => $this->transactionRepository->getTransactionByStatus('confirmed')->count(),
            'warehouses' => $this->warehouseRepository->getAllWarehouses()->count(),
            'users' => $this->userRepository->getAllUserTenant()->count(),
        ]);
    }

    public function service()
    {
        return view('pages.guest.service.index');
    }

    public function properties()
    {
        return view('pages.guest.properties.index', [
            'warehouses' => $this->warehouseRepository->getAllWarehouses(),
        ]);
    }

    public function properties_detail(Warehouse $warehouse)
    {
        return view('pages.guest.properties.show', [
            'warehouse' => $warehouse,
            'warehouses' => $this->warehouseRepository->getWarehousesExceptThisWarehouse($warehouse->id)
        ]);
    }

    public function contact()
    {
        return view('pages.guest.contact.index');
    }

    public function contact_send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        $data = $request->only('name', 'email', 'message');
        
        Mail::send([], [], function ($message) use ($data) {
            $message->from($data['email'], $data['name'])
                    ->to('rehanfarras76@gmail.com')
                    ->subject('Contact For Support')
                    ->html('<p>Name: ' . $data['name'] . '</p><p>Email: ' . $data['email'] . '</p><p>Message: ' . $data['message'] . '</p>'); // Set as HTML
        });

        return redirect()->back()->with([
            'flash-type' => 'sweetalert',
            'case' => 'default',
            'position' => 'center',
            'type' => 'success',
            'message' => 'Berhasil Masuk!'
        ]);
    }
}
