<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Repositories\TransactionRepository;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function purchase_index($status)
    {
        return view('pages.admin.purchase.index', [
            'status' => $status
        ]);
    }

    public function purchase_show(Transaction $transaction)
    {
        return view('pages.admin.purchase.invoice.index', compact('transaction'));
    }

    public function purchase_update(Transaction $transaction, $status)
    {
        if ($this->transactionRepository->updateTransactionStatus($transaction->id, $status)) {
            return redirect()->back()->with([
                'flash-type' => 'sweetalert',
                'case' => 'default',
                'position' => 'center',
                'type' => 'success',
                'message' => $status == 'success' ? 'Purchase Confirmed' : 'Purchase Declined'
            ]);
        }
    }
}
