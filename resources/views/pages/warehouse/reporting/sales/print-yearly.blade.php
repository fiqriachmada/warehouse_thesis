@extends('layouts.warehouse')

@section('title')
    Reporting - Print Sales - Yearly
@endsection

@section('section-print')
<table class="table m-0">
    <thead class="table-light">
        <tr>
            <th>No</th>
            <th>Product</th>
            <th>Category</th>
            <th>Rack</th>
            <th>Sales Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($outbounds as $item)
        <tr>
            <td class="text-nowrap">{{ $loop->iteration }}</td>
            <td class="text-nowrap text-capitalize">{{ $item->name }}</td>
            <td class="text-nowrap">{{ $item->category_name }}</td>
            <td class="text-capitalize">{{ $item->rack_name }}</td>
            <td>@rupiah($item->sale_price)</td>
            <td>{{ $item->quantity }}</td>
            <td class="text-nowrap">@rupiah($item->subtotal)</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="5" class="align-top px-4 py-3"></td>
            <td class="text-start">
                <p class="mb-0 pb-3">Item Total:</p>
                <p class="mb-0 pb-3">Grand Total:</p>
            </td>
            <td>
                <p class="fw-semibold mb-0 pb-3">{{ $outbounds->sum('amount_total') }}</p>
                <p class="fw-semibold mb-0 pb-3">@rupiah($outbounds->sum('grand_total'))</p>

            </td>
        </tr>
    </tbody>
</table>
@endsection