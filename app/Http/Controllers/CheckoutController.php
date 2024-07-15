<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Repositories\BillingRepository;
use App\Repositories\CheckoutRepository;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    protected $checkoutRepository, $billingRepository;

    public function __construct(CheckoutRepository $checkoutRepository, BillingRepository $billingRepository)
    {
        $this->checkoutRepository = $checkoutRepository;
        $this->billingRepository = $billingRepository;
    }

    public function transaction_index($status)
    {
        return view('pages.tenant.transaction.index', [
            'status' => $status
        ]);
    }

    public function transaction_show(Transaction $transaction)
    {
        return view('pages.tenant.transaction.invoice.index', [
            'transaction' => $transaction,
            // 'bank' => $this->billingRepository->getPrimaryBilling()
        ]);
    }

    public function transaction_store(Request $request, Transaction $transaction)
    {
        if ($this->checkoutRepository->storeTransaction($request, $transaction->id)) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => 'Checkout Success!'
            ]);
        } else {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'error',
                'message' => 'Checkout Failed!'
            ]);
        }
    }
}
