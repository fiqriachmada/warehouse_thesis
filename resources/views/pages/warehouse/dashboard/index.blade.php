@extends('layouts.warehouse')

@section('title')
    Dashboard - {{ $warehouse->name }}
@endsection

@section('section-warehouse')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">

      <div class="col-xl-4 mb-4 col-lg-5 col-12">
        <div class="card">
          <div class="d-flex align-items-end row">
            <div class="col-7">
              <div class="card-body text-nowrap">
                <h5 class="card-title mb-0 text-capitalize">Congratulations @getFirstWord($warehouse->name)! 🎉</h5>
                <p class="mb-2">Highest Income This Year</p>
                <h4 class="text-primary mb-1">@rupiah($outbounds_year[0]->grand_total ?? 0)</h4>
              </div>
            </div>
            <div class="col-5 text-center text-sm-left">
              <div class="card-body pb-0 px-0 px-md-4">
                <img src="{{ asset('assets/img/illustrations/card-advance-sale.png') }}" height="140" alt="view sales">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-8 mb-4 col-lg-7 col-12">
        <div class="card h-100">
          <div class="card-header">
            <div class="d-flex justify-content-between mb-3">
              <h5 class="card-title mb-0">Statistics</h5>
              <small class="text-muted">On This {{ now()->format('F') }}</small>
            </div>
          </div>
          <div class="card-body">
            <div class="row gy-3">
              <div class="col-md-3 col-6">
                <div class="d-flex align-items-center">
                  <div class="badge rounded-pill bg-label-success me-3 p-2">
                    <i class="ti ti-currency-dollar ti-sm"></i>
                  </div>
                  <div class="card-info">
                    <h5 class="mb-0">@formatRupiah($outbounds_month[0]->grand_total ?? 0)</h5>
                    <small>Sales</small>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-6">
                <div class="d-flex align-items-center">
                  <div class="badge rounded-pill bg-label-info me-3 p-2">
                    <i class="ti ti-plane-inflight ti-sm"></i>
                  </div>
                  <div class="card-info">
                    <h5 class="mb-0">@formatRupiah($total_inbound_price_month[0]->price ?? 0)</h5>
                    <small>Inbound</small>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-6">
                <div class="d-flex align-items-center">
                  <div class="badge rounded-pill bg-label-primary me-3 p-2">
                    <i class="ti ti-plane-departure ti-sm"></i>
                  </div>
                  <div class="card-info">
                    <h5 class="mb-0">@formatNumberShort($total_outbound_amount_month[0]->amount_total ?? 0)</h5>
                    <small>Outbound</small>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-6">
                <div class="d-flex align-items-center">
                  <div class="badge rounded-pill bg-label-success me-3 p-2">
                    <i class="ti ti-car ti-sm"></i>
                  </div>
                  <div class="card-info">
                    <h5 class="mb-0">@formatNumberShort($total_customer_amount_month[0]->total_customer ?? 0)</h5>
                    <small>Customer</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
</div>
@endsection