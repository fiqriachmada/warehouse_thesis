@extends('layouts.admin')

@section('title')
    Dashboard - Admin
@endsection

@section('section-admin')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">

      <div class="col-xl-4 mb-4 col-lg-5 col-12">
        <div class="card">
          <div class="d-flex align-items-end row">
            <div class="col-7">
              <div class="card-body text-nowrap">
                <h5 class="card-title mb-0 text-capitalize">Congratulations {{ auth()->user()->level }}! 🎉</h5>
                <p class="mb-2">Highest Income This Year</p>
                <h4 class="text-primary mb-1">@rupiah($transactions_year[0]->subtotal ?? 0)</h4>
                <a href="{{ route('report.yearly.sales') }}" class="btn btn-primary waves-effect waves-light">View Sales</a>
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
                    <h5 class="mb-0">@formatRupiah($transactions_month[0]->subtotal ?? 0)</h5>
                    <small>Sales</small>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-6">
                <div class="d-flex align-items-center">
                  <div class="badge rounded-pill bg-label-info me-3 p-2">
                    <i class="ti ti-users ti-sm"></i>
                  </div>
                  <div class="card-info">
                    <h5 class="mb-0">@formatNumberShort($tenants)</h5>
                    <small>Tenants</small>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-6">
                <div class="d-flex align-items-center">
                  <div class="badge rounded-pill bg-label-primary me-3 p-2">
                    <i class="ti ti-shopping-cart ti-sm"></i>
                  </div>
                  <div class="card-info">
                    <h5 class="mb-0">@formatNumberShort($orders[0]->amount ?? 0)</h5>
                    <small>Orders</small>
                  </div>
                </div>
              </div>
              <div class="col-md-3 col-6">
                <div class="d-flex align-items-center">
                  <div class="badge rounded-pill bg-label-success me-3 p-2">
                    <i class="ti ti-car ti-sm"></i>
                  </div>
                  <div class="card-info">
                    <h5 class="mb-0">@formatNumberShort($customers)</h5>
                    <small>Customer</small>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-sm-6 mb-4">
        <div class="card">
          <div class="card-header">
            <div class="d-flex justify-content-between">
              <small class="d-block mb-1 text-muted">Tenants Overview</small>
              <p class="card-text text-{{ $tenant_growth_percentage >= 0 ? 'success' : 'danger' }}">{{ $tenant_growth_percentage >= 0 ? '+' : '-' }}{{ $tenant_growth_percentage }}%</p>
            </div>
            <h4 class="card-title mb-1">{{ $tenants }}</h4>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-4">
                <div class="d-flex gap-2 align-items-center mb-2">
                  <span class="badge bg-label-info p-1 rounded"><i class="ti ti-shopping-cart ti-xs"></i></span>
                  <p class="mb-0">Rents</p>
                </div>
                <h5 class="mb-0 pt-1 text-nowrap">{{ $tenant_overview_statistics['with_transactions'] }}%</h5>
                <small class="text-muted">{{ $tenant_overview_statistics['with_transactions_count'] }}</small>
              </div>
              <div class="col-4">
                <div class="divider divider-vertical">
                  <div class="divider-text">
                    <span class="badge-divider-bg bg-label-secondary">VS</span>
                  </div>
                </div>
              </div>
              <div class="col-4 text-end">
                <div class="d-flex gap-2 justify-content-end align-items-center mb-2">
                  <p class="mb-0">Visits</p>
                  <span class="badge bg-label-primary p-1 rounded"><i class="ti ti-link ti-xs"></i></span>
                </div>
                <h5 class="mb-0 pt-1 text-nowrap ms-lg-n3 ms-xl-0">{{ $tenant_overview_statistics['without_transactions'] }}%</h5>
                <small class="text-muted">{{ $tenant_overview_statistics['without_transactions_count'] }}</small>
              </div>
            </div>
            <div class="d-flex align-items-center mt-4">
              <div class="progress w-100" style="height: 8px">
                <div class="progress-bar bg-info" style="width: {{ $tenant_overview_statistics['with_transactions'] }}%" role="progressbar" aria-valuenow="{{ $tenant_overview_statistics['with_transactions'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $tenant_overview_statistics['without_transactions'] }}%" aria-valuenow="{{ $tenant_overview_statistics['without_transactions'] }}" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-xl-3 col-md-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <div class="d-flex flex-column">
                <div class="card-title mb-auto">
                  <h5 class="mb-1 text-nowrap">Revenue Growth</h5>
                  <small>Weekly Report</small>
                </div>
                <div class="chart-statistics">
                  <h3 class="card-title mb-1">@rupiah($revenue_growth_weekly_transaction_report->grand_total)</h3>
                  <span class="badge bg-label-{{ $revenue_growth_weekly_transaction_report_percentage >= 0 ? 'success' : 'danger' }}">{{ $revenue_growth_weekly_transaction_report_percentage >= 0 ? '+' : '-' }}{{ $revenue_growth_weekly_transaction_report_percentage }}%</span>
                </div>
              </div>
              <div id="revenueGrowth"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6 mb-4">
        <div
          class="swiper-container swiper-container-horizontal swiper swiper-card-advance-bg"
          id="swiper-with-pagination-cards">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="row">
                <div class="col-12">
                  <h5 class="text-white mb-0 mt-2">Warehouse Analytics</h5>
                  <small>Total Data Across Time</small>
                </div>
                <div class="row">
                  <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1">
                    <h6 class="text-white mt-0 mt-md-3 mb-3">Latest Value</h6>
                    <div class="row">
                      <div class="col-6">
                        <ul class="list-unstyled mb-0">
                          <li class="d-flex mb-4 align-items-center">
                            <p class="mb-0 fw-semibold me-2 website-analytics-text-bg">@formatNumberShort($total_rented_warehouse)</p>
                            <p class="mb-0">Rented</p>
                          </li>
                          <li class="d-flex align-items-center mb-2">
                            <p class="mb-0 fw-semibold me-2 website-analytics-text-bg">@formatNumberShort($total_warehouse_units)</p>
                            <p class="mb-0">Units</p>
                          </li>
                        </ul>
                      </div>
                      <div class="col-6">
                        <ul class="list-unstyled mb-0">
                          <li class="d-flex mb-4 align-items-center">
                            <p class="mb-0 fw-semibold me-2 website-analytics-text-bg">@formatRupiah($total_all_of_time_transactions_income->grand_total)</p>
                            <p class="mb-0">Total Income</p>
                          </li>
                          <li class="d-flex align-items-center mb-2">
                            <p class="mb-0 fw-semibold me-2 website-analytics-text-bg">{{ $warehouse_active_percentage }}%</p>
                            <p class="mb-0">Active</p>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
                    <img
                      src="{{ asset('assets/img/illustrations/card-website-analytics-1.png') }}"
                      alt="Website Analytics"
                      width="170"
                      class="card-website-analytics-img" />
                  </div>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="row">
                <div class="col-12">
                  <h5 class="text-white mb-0 mt-2">Tenant Analytics</h5>
                  <small>Total Data Across Time</small>
                </div>
                <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1">
                  <h6 class="text-white mt-0 mt-md-3 mb-3">Latest Value</h6>
                  <div class="row">
                    <div class="col-6">
                      <ul class="list-unstyled mb-0">
                        <li class="d-flex mb-4 align-items-center">
                          <p class="mb-0 fw-semibold me-2 website-analytics-text-bg">@formatRupiah($total_all_of_time_tenants_spend->grand_total)</p>
                          <p class="mb-0">Spend</p>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                          <p class="mb-0 fw-semibold me-2 website-analytics-text-bg">@formatNumberShort($total_all_of_time_tenants_order->total_order)</p>
                          <p class="mb-0">Order</p>
                        </li>
                      </ul>
                    </div>
                    <div class="col-6">
                      <ul class="list-unstyled mb-0">
                        <li class="d-flex mb-4 align-items-center">
                          <p class="mb-0 fw-semibold me-2 website-analytics-text-bg">@formatNumberShort($total_all_of_time_tenants_rent)</p>
                          <p class="mb-0">Rents</p>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                          <p class="mb-0 fw-semibold me-2 website-analytics-text-bg">@formatNumberShort($total_all_of_time_tenants_items)</p>
                          <p class="mb-0">Items</p>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
                  <img
                    src="{{ asset('assets/img/illustrations/card-website-analytics-2.png') }}"
                    alt="Website Analytics"
                    width="170"
                    class="card-website-analytics-img" />
                </div>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="row">
                <div class="col-12">
                  <h5 class="text-white mb-0 mt-2">Product Analytics</h5>
                  <small>Total Data Across Time</small>
                </div>
                <div class="col-lg-7 col-md-9 col-12 order-2 order-md-1">
                  <h6 class="text-white mt-0 mt-md-3 mb-3">Latest Value</h6>
                  <div class="row">
                    <div class="col-6">
                      <ul class="list-unstyled mb-0">
                        <li class="d-flex mb-4 align-items-center">
                          <p class="mb-0 fw-semibold me-2 website-analytics-text-bg">@formatNumberShort($total_all_of_time_product_items)</p>
                          <p class="mb-0">Items</p>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                          <p class="mb-0 fw-semibold me-2 website-analytics-text-bg">@formatNumberShort($total_all_of_time_product_racks)</p>
                          <p class="mb-0">Racks</p>
                        </li>
                      </ul>
                    </div>
                    <div class="col-6">
                      <ul class="list-unstyled mb-0">
                        <li class="d-flex mb-4 align-items-center">
                          <p class="mb-0 fw-semibold me-2 website-analytics-text-bg">@formatNumberShort($total_all_of_time_product_categories)</p>
                          <p class="mb-0">Categories</p>
                        </li>
                        <li class="d-flex align-items-center mb-2">
                          <p class="mb-0 fw-semibold me-2 website-analytics-text-bg">@formatNumberShort($total_all_of_time_product_supplier)</p>
                          <p class="mb-0">Suppliers</p>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="col-lg-5 col-md-3 col-12 order-1 order-md-2 my-4 my-md-0 text-center">
                  <img
                    src="{{ asset('assets/img/illustrations/card-website-analytics-3.png') }}"
                    alt="Website Analytics"
                    width="170"
                    class="card-website-analytics-img" />
                </div>
              </div>
            </div>
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>

    </div>
</div>

@endsection