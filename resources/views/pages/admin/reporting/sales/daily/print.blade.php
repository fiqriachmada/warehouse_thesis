@extends('layouts.admin')

@section('title')
    Reporting - Print Sales - Daily
@endsection

@section('section-print')
<table class="table m-0">
    <thead class="table-light">
        <tr>
            <th>No</th>
            <th>Tenant</th>
            <th>Tax Amount</th>
            <th>Warehouse</th>
            <th>Subscription</th>
            <th>Status</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $tax = 0;
        ?>
        @foreach ($transactions as $item)
        <tr>
            <td class="text-nowrap">{{ $loop->iteration }}</td>
            <td class="text-nowrap text-capitalize">{{ $item->tenant_name }}</td>
            <td class="text-nowrap">{{ $item->value }}%</td>
            <td class="text-capitalize">{{ $item->warehouse_name }}</td>
            <td class="text-capitalize">{{ $item->subscription_name }}</td>
            <td class="text-capitalize">{{ $item->status }}</td>
            <td class="text-nowrap">@rupiah($item->subtotal)</td>
        </tr>
        <?php
            $tax += $item->subtotal * ($item->value / 100);
        ?>
        @endforeach
        <tr>
            <td colspan="5" class="align-top px-4 py-3"></td>
            <td class="text-start">
                <p class="mb-0 pb-3">Subtotal:</p>
            </td>
            <td>
                <p class="fw-semibold mb-0 pb-3">@rupiah($transactions->sum('subtotal'))</p>
            </td>
        </tr>
        <tr>
            <td colspan="5" class="align-top px-4 py-3"></td>
            <td class="text-start">
                <p class="mb-0 pb-3">Tax:</p>
            </td>
            <td>
                <p class="fw-semibold mb-0 pb-3">@rupiah($tax)</p>
            </td>
        </tr>
        <tr>
            <td colspan="5" class="align-top px-4 py-3"></td>
            <td class="text-start">
                <p class="mb-0 pb-3">Grand Total:</p>
            </td>
            <td>
                <p class="fw-semibold mb-0 pb-3">@rupiah($transactions->sum('subtotal') + $tax)</p>
            </td>
        </tr>
    </tbody>
</table>
@endsection