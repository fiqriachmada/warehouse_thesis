@php
    foreach ($model->transaction as $key => $transaction) {
        $amount[] = ($transaction->detail_transaction->sum('subtotal') / 100) * $model->value;
    }
@endphp

@rupiah(array_sum($amount))