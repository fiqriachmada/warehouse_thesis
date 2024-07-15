@extends('layouts.warehouse')

@section('title')
    Outbound - Print
@endsection

@section('section-print')
<table class="table m-0">
    <thead class="table-light">
        <tr>
            <th>No</th>
            <th>Item</th>
            <th>Category</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($outbound->detail_outbound as $item)
        <tr>
            <td class="text-nowrap">{{ $loop->iteration }}</td>
            <td class="text-nowrap">{{ $item->product->name }}</td>
            <td class="text-nowrap">{{ $item->product->product_category->name }}</td>
            <td>@rupiah($item->product->sale_price)</td>
            <td>{{ $item->quantity }}</td>
            <td>@rupiah($item->subtotal)</td>
        </tr>
        @endforeach
        <tr>
            <td colspan="4" class="align-top px-4 py-3"></td>
            <td class="text-start">
                <p class="mb-0 pb-3">Item Total:</p>
                <p class="mb-0 pb-3">Grand Total:</p>
            </td>
            <td>
                <p class="fw-semibold mb-0 pb-3">{{ $outbound->amount_total }}</p>
                <p class="fw-semibold mb-0 pb-3">@rupiah($outbound->grand_total)</p>

            </td>
        </tr>
    </tbody>
</table>
@endsection