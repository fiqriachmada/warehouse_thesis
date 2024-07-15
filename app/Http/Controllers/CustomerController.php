<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use App\Repositories\CustomerRepository;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function warehouse_customer_index(Warehouse $warehouse)
    {
        return view('pages.warehouse.master.customer.index', [
            'warehouse' => $warehouse
        ]);
    }  
    
    public function warehouse_customer_store(Request $request, Warehouse $warehouse)
    {
        if ($this->customerRepository->createCustomer($request, $warehouse)) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Customer has been added!'
            ]);
        }
    }
}
