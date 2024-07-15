<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Repositories\BillingRepository;
use Illuminate\Http\Request;
use App\Repositories\TaxRepository;
use App\Repositories\RentedRepository;
use App\Repositories\TempTransactionRepository;

class CartController extends Controller
{
    protected $tempTransactionRepository, $taxRepository, $rentedRepository, $billingRepository;

    public function __construct(TempTransactionRepository $tempTransactionRepository, TaxRepository $taxRepository, RentedRepository $rentedRepository, BillingRepository $billingRepository)
    {
        $this->tempTransactionRepository = $tempTransactionRepository;
        $this->taxRepository = $taxRepository;
        $this->rentedRepository = $rentedRepository;
        $this->billingRepository = $billingRepository;
    }

    public function cart_index()
    {
        $carts = $this->tempTransactionRepository->getTempTransactionByTenantId()->get();
        $tax = $this->taxRepository->getTaxByStatus('active')->first();

        $warehouse_ids = array();

        foreach ($carts as $key => $cart) {
            $warehouse_ids[] = $cart->warehouse->id;
        }

        return view('pages.tenant.cart.index', compact('carts', 'tax', 'warehouse_ids'));
    }

    public function cart_store()
    {
        if ($this->rentedRepository->checkIfRentedExistFromTempTransaction()->count()) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'warning',
                'message' => 'You Already Rented!'
            ]);
        }

        $storeToTransaction = $this->tempTransactionRepository->storeToTransaction();

        if ($storeToTransaction) {
            return redirect()->route('shopping.cart.payment', $storeToTransaction)->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Checkout Success!'
            ]);
        }
    }

    public function cart_payment(Transaction $transaction)
    {
        return view('pages.tenant.cart.payment', [
            'transaction' => $transaction,
            'bank' => $this->billingRepository->getBillingStatusUserCore()
        ]);
    }
}
