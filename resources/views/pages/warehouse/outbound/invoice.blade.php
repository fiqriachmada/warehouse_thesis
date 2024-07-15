@extends('layouts.warehouse')

@section('title')
    Outbound - Invoice
@endsection

@section('section-warehouse')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row invoice-preview">

      <div class="col-xl-9 col-md-8 col-12 mb-md-0 mb-4">
        <div class="card invoice-preview-card">
          <div class="card-body">
            <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">
              <div class="mb-xl-0 mb-4">
                <p class="mb-2">{{ $outbound->warehouse->name }}</p>
                <p class="mb-2">{{ $outbound->tenant->email }} - {{ $outbound->tenant->phone }}</p>
                <p class="mb-0">{{ $outbound->warehouse->address }}</p>
              </div>
              <div>
                <h4 class="fw-semibold mb-2 text-uppercase">INVOICE #{{ head(explode('-', $outbound->id)) }}</h4>
                <div class="mb-2 pt-1">
                  <span>Date Issues:</span>
                  <span class="fw-semibold">{{ \Carbon\Carbon::parse($outbound->created_at)->format('d/m/Y H:i:s') }}</span>
                </div>
                {{-- @if ($transaction->status == 'payment')
                <div class="pt-1">
                    <span>Date Due:</span>
                    <span class="fw-semibold">{{ \Carbon\Carbon::parse($transaction->payment_due)->format('d/m/Y H:i:s') }}</span>
                </div>
                @endif --}}
              </div>
            </div>
          </div>
          <hr class="my-0">
          <div class="card-body">
            <div class="row p-sm-3 p-0">
              <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
                <h6 class="mb-3">Invoice To:</h6>
                <p class="mb-1 text-capitalize">{{ $outbound->customer->name }}</p>
                <p class="mb-1">{{ $outbound->customer->phone }}</p>
                <p class="mb-1">{{ $outbound->customer->email }}</p>
                <p class="mb-0">{{ $outbound->customer->address }}</p>
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
                      <td>{{ $bank->bank_name }}</td>
                    </tr>
                    <tr>
                      <td class="pe-4">Account Holder Name:</td>
                      <td>{{ $bank->account_holder_name }}</td>
                    </tr>
                    <tr>
                      <td class="pe-4">BAN:</td>
                      <td>{{ $bank->bank_account_number }}</td>
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
                    <td colspan="3" class="align-top px-4 py-4">
                      <span class="ms-3">Thanks for your purchase</span>
                    </td>
                    <td class="text-end pe-3 py-4">
                      <p class="mb-2 pt-3">Item Total:</p>
                      <p class="mb-0 pb-3">Grand Total:</p>
                    </td>
                    <td class="ps-2 py-4">
                      <p class="fw-semibold mb-2 pt-3">{{ $outbound->amount_total }}</p>
                      <p class="fw-semibold mb-0 pb-3">@rupiah($outbound->grand_total)</p>
                    </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-4 col-12 invoice-actions">
        <div class="card">
          <div class="card-body">
            <a href="{{ route('warehouse.outbound.invoice.print', ['warehouse' => $warehouse->id, 'outbound' => $outbound->id]) }}" class="btn btn-primary d-grid w-100 waves-effect waves-light" id="pay-button" target="_blank">
              <span class="d-flex align-items-center justify-content-center text-nowrap"><i class="ti ti-printer ti-xs me-1"></i>Print</span>
            </a>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection