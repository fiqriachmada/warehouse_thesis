@extends('layouts.admin')

@section('section-admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row invoice-preview">

      <div class="col-xl-12 col-md-12 col-12 mb-md-0 mb-4">
        <div class="card invoice-preview-card">
          <div class="card-body">
            <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">
              <div class="mb-xl-0 mb-4">
                <p class="mb-2">Jl. Merdeka No. 17A, Jakarta</p>
                <p class="mb-2">DKI Jakarta, 12345, Indonesia</p>
                <p class="mb-0">+62 1234 5678</p>
              </div>
              <div>
                <h4 class="fw-semibold mb-2 text-uppercase">INVOICE #{{ head(explode('-', $transaction->id)) }}</h4>
                <div class="mb-2 pt-1">
                  <span>Date Issues:</span>
                  <span class="fw-semibold">{{ \Carbon\Carbon::parse($transaction->created_at)->format('d/m/Y H:i:s') }}</span>
                </div>
                @if ($transaction->status == 'payment')
                <div class="pt-1">
                    <span>Date Due:</span>
                    <span class="fw-semibold">{{ \Carbon\Carbon::parse($transaction->payment_due)->format('d/m/Y H:i:s') }}</span>
                </div>
                @endif
              </div>
            </div>
          </div>
          <hr class="my-0">
          <div class="card-body">
            <div class="row p-sm-3 p-0">
              <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
                <h6 class="mb-3">Invoice To:</h6>
                <p class="mb-1 text-capitalize">{{ $transaction->tenant->name }}</p>
                <p class="mb-1">{{ $transaction->tenant->phone }}</p>
                <p class="mb-1">{{ $transaction->tenant->email }}</p>
                <p class="mb-0">{{ $transaction->tenant->address }}</p>
              </div>
              {{-- <div class="col-xl-6 col-md-12 col-sm-7 col-12">
                <h6 class="mb-4">Bill To:</h6>
                <table>
                  <tbody>
                    <tr>
                      <td class="pe-4">Total Due:</td>
                      <td><strong>@rupiah($transaction->grand_total)</strong></td>
                    </tr>
                    <tr>
                      <td class="pe-4">Bank name:</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td class="pe-4">Country:</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td class="pe-4">BAN:</td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
              </div> --}}
            </div>
          </div>
          <div class="table-responsive border-top">
            <table class="table m-0">
              <thead>
                <tr>
                  <th>Item</th>
                  <th>Subscription</th>
                  <th>Price Rate</th>
                  <th>Month Duration</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($transaction->detail_transaction as $item)
                <tr>
                    <td class="text-nowrap">{{ $item->warehouse_subscription->warehouse->name }}</td>
                    <td class="text-nowrap">{{ $item->warehouse_subscription->subscription->name }}</td>
                    <td>@rupiah($item->warehouse_subscription->price_rate)</td>
                    <td>@convertMonthsToYearsAndMonths($item->warehouse_subscription->subscription->month_duration)</td>
                    <td>@rupiah($item->subtotal)</td>
                </tr>
                @endforeach
                <tr>
                    <td colspan="3" class="align-top px-4 py-4">
                      {{-- <span class="ms-3">Thanks for your purchase</span> --}}
                    </td>
                    <td class="text-end pe-3 py-4">
                      <p class="mb-2 pt-3">Subtotal:</p>
                      <p class="mb-2">Tax:</p>
                      <p class="mb-0 pb-3">Grand Total:</p>
                    </td>
                    <td class="ps-2 py-4">
                      <p class="fw-semibold mb-2 pt-3">@rupiah($transaction->detail_transaction->sum('subtotal'))</p>
                      <p class="fw-semibold mb-2">@rupiah($transaction->detail_transaction->sum('subtotal') * $transaction->tax->value / 100)</p>
                      <p class="fw-semibold mb-0 pb-3">@rupiah($transaction->grand_total)</p>
                    </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      {{-- <div class="col-xl-3 col-md-4 col-12 invoice-actions">
        <div class="card">
          <div class="card-body">
            <img src="{{ $transaction->getFirstMediaUrl('transaction_images') }}" class="img-fluid">
          </div>
        </div>
      </div> --}}
    </div>

</div>
@endsection