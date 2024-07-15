<?php 

namespace App\Repositories;

use App\Mail\PaymentMail;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Repositories\BillingRepository;
use App\Repositories\TransactionRepository;

class CheckoutRepository
{
    protected $transactionRepository, $detailTransactionRepository, $billingRepository, $warehouseRepository;

    public function __construct(TransactionRepository $transactionRepository, DetailTransactionRepository $detailTransactionRepository, BillingRepository $billingRepository, WarehouseRepository $warehouseRepository)
    {
        $this->transactionRepository = $transactionRepository;
        $this->detailTransactionRepository = $detailTransactionRepository;
        $this->billingRepository = $billingRepository;
        $this->warehouseRepository = $warehouseRepository;
    }

    public function storeTransaction($data, $transaction_id)
    {
        $transaction = $this->transactionRepository->getTransactionById($transaction_id);

        if ($transaction->status == 'confirmed') {
            return false;
        }

        $items = array();

        foreach ($transaction->detail_transaction as $item) {
            $items[] = array(
                'id' => $item->warehouse_subscription->warehouse_id,
                'price' => $item->subtotal,
                'quantity' => 1,
                'name' => $item->warehouse_subscription->warehouse->name,
                'subscription' => $item->warehouse_subscription->subscription->name." (".\App\Helpers\Helpers::convertMonthsToYearsAndMonths($item->warehouse_subscription->subscription->month_duration).")"
            );
        }

        $params = array(
            'transaction_details' => array(
                'order_id' => $transaction_id,
                'gross_amount' => $transaction->grand_total,
                'tax_amount' => $transaction->tax->value
            ),
            'customer_details' => array(
                'first_name' => $transaction->tenant->name,
                'email' => $transaction->tenant->email,
                'phone' => $transaction->tenant->phone,
                'billing_address' => $transaction->tenant->address
            ),
            'item_details' => $items
        );

        Mail::to(auth()->user()->tenant->email)->send(new PaymentMail($params['transaction_details'], 'confirmed', $params['customer_details'], $params['item_details']));

        DB::transaction(function () use ($data, $transaction) {

            $transaction->update([
                // 'bank_id' => $this->billingRepository->getPrimaryBilling()->id,
                'status' => 'confirmed'
            ]);

            // if ($data->hasFile('transaction_image')) {
            //     $transaction->addMediaFromRequest('transaction_image')->withResponsiveImages()->toMediaCollection('transaction_images');
            // }
        });

        $this->transactionRepository->updateTransactionStatus($transaction_id);

        foreach ($this->detailTransactionRepository->getDetailTransactionByTransactionId($transaction_id) as $key => $detail_transaction) {
            $this->warehouseRepository->updateStatusWarehouse($detail_transaction->warehouse_subscription->warehouse_id, 'rented');
        }

        return true;
    }

}