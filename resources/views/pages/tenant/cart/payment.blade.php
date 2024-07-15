@extends('layouts.tenant')

@section('title')
    Payment - Page
@endsection

@section('section-tenant')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row invoice-preview">

      <div class="{{ $transaction->status === 'payment' ? 'col-xl-9 col-md-8' : 'col-xl-12 col-md-12' }} col-12 mb-md-0 mb-4">
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
                      <span class="ms-3">{{ $transaction->status == 'payment' ? 'Please do your payment' : 'Thanks for your purchase' }}</span>
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

      @if ($transaction->status === 'payment')
      <div class="col-xl-3 col-md-4 col-12 invoice-actions">
        <div class="card">
          <div class="card-body">
            {{-- <button class="btn btn-primary d-grid w-100 waves-effect waves-light" data-bs-toggle="offcanvas" data-bs-target="#addPaymentOffcanvas"> --}}
            <button class="btn btn-primary d-grid w-100 waves-effect waves-light" id="pay-button">
              <span class="d-flex align-items-center justify-content-center text-nowrap"><i class="ti ti-currency-dollar ti-xs me-1"></i>Add Payment</span>
            </button>
          </div>
        </div>
      </div>

      <form action="{{ route('tenant.transaction.store', $transaction->id) }}" method="POST" id="payment-form">
        @csrf
      </form>
      @endif
    </div>

    {{-- <div class="offcanvas offcanvas-end" id="addPaymentOffcanvas" aria-hidden="true">
      <div class="offcanvas-header mb-3">
        <h5 class="offcanvas-title">Add Payment</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body flex-grow-1">
        <div class="d-flex justify-content-between bg-lighter p-2 mb-3">
          <p class="mb-0">Invoice Payment:</p>
          <p class="fw-bold mb-0">@rupiah($transaction->grand_total)</p>
        </div>
        <form action="{{ route('tenant.transaction.store', $transaction->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label" for="image">Proof of Payment</label>
                <input type="file" name="transaction_image" id="image" class="form-control" onchange="previewImage()">
                <img class="img-fluid img-preview w-100 mt-3">
            </div>
            <div class="mb-3 d-flex flex-wrap">
                <button type="submit" class="btn btn-primary me-3 waves-effect waves-light" data-bs-dismiss="offcanvas">Send</button>
                <button type="button" class="btn btn-label-secondary waves-effect" data-bs-dismiss="offcanvas">Cancel</button>
            </div>
        </form>
      </div>
    </div> --}}
</div>

@push('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script type="text/javascript">
  document.getElementById('pay-button').onclick = function(){
    // SnapToken acquired from previous step
    snap.pay('{{ $transaction->snap_token }}', {
      // Optional
      onSuccess: function(result){
        document.getElementById('payment-form').submit();
      },
      // Optional
      onPending: function(result){
        // /* You may add your own js here, this is just example */ document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
        console.log(result);
      },
      // Optional
      onError: function(result){
        Swal.fire({
          position: 'center',
          icon: 'failed',
          title: 'Checkout Failed',
          showConfirmButton: false,
          timer: 2500
        })
      }
    });
  };
</script>
@endpush
@endsection