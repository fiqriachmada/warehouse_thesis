<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  
    <div class="app-brand demo">
      <a href="/" class="app-brand-link">
        <span class="app-brand-text demo menu-text fw-bold">TENANT</span>
        <span class="app-brand-text badge rounded-pill bg-primary text-capitalize">{{ auth()->user()->tenant->rank }}</span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
        <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
        <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- Dashboards -->
      <li class="menu-item {{ request()->is('/', 'dashboard/crm') ? 'open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons ti ti-smart-home"></i>
          <div data-i18n="Dashboards">Dashboards</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{ request()->is('/') ? 'active' : '' }}">
            <a href="/" class="menu-link">
              <div data-i18n="Analitik">Analitik</div>
            </a>
          </li>
        </ul>
      </li>

      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">MAIN</span>
      </li>
      <li class="menu-item {{ request()->is('pricing/*', 'pricing/*/cart') ? 'active' : '' }}">
        <a href="{{ route('pricing.index', 'all') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-currency-dollar"></i>
          <div data-i18n="Pricing">Pricing</div>
        </a>
      </li>
      <li class="menu-item {{ request()->is('transaction/*', 'transaction/*/detail') ? 'active' : '' }}">
        <a href="{{ route('tenant.transaction.index', 'payment') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-cash"></i>
          <div data-i18n="Transaction">Transaction</div>
          <div class="badge bg-label-primary rounded-pill ms-auto" id="label-total-new-payment-count"></div>
        </a>
      </li>

      <!-- WAREHOUSE -->
      @if (auth()->user()->tenant->rented()->where('status', 'active')->count() > 0)
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">WAREHOUSE</span>
      </li>
      @foreach (auth()->user()->tenant->rented->where('status', 'active') as $item)
      <li class="menu-item">
        <a href="{{ route('warehouse.index', $item->warehouse->id) }}" class="menu-link" target="_blank">
          <i class="menu-icon tf-icons ti ti-building-warehouse"></i>
          <div data-i18n="{{ $item->warehouse->name }}">{{ $item->warehouse->name }}</div>
        </a>
      </li>
      @endforeach
      @endif
      
      @php 
        $transactions = \App\Models\Transaction::where('tenant_id', auth()->user()->tenant->id)->where('status', 'confirmed')->get();

        if ($transactions->count() != 0) {
          foreach ($transactions as $key => $transaction) {
            $detail_transaction_ids = $transaction->detail_transaction->pluck('id')->toArray();
          }
          
          $detail_transactions = \App\Models\DetailTransaction::whereIn('id', $detail_transaction_ids)->get();
        }
      @endphp

      @if ($transactions->count() > 0)
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">REPORTING</span>
      </li>
        @foreach ($detail_transactions as $detail_transaction)
        <li class="menu-item {{ request()->is('reporting/*/sales/*', 'reporting/*/performance/*', 'history/*/*') ? 'open' : '' }}">
          <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-clipboard-list"></i>
            <div data-i18n="{{ $detail_transaction->warehouse_subscription->warehouse->name }}">{{ $detail_transaction->warehouse_subscription->warehouse->name }}</div>
          </a>
          <ul class="menu-sub">
            <li class="menu-item {{ request()->is('reporting/*/sales/*') ? 'open' : '' }}">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <div data-i18n="Sales">Sales</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item {{ request()->is('reporting/*/sales/daily') ? 'active' : '' }}">
                  <a href="{{ route('reporting.periodic.sales.index', ['warehouse' => $detail_transaction->warehouse_subscription->warehouse->id, 'period' => 'daily']) }}" class="menu-link">
                    <div data-i18n="Daily">Daily</div>
                  </a>
                </li>
                <li class="menu-item {{ request()->is('reporting/*/sales/monthly') ? 'active' : '' }}">
                  <a href="{{ route('reporting.periodic.sales.index', ['warehouse' => $detail_transaction->warehouse_subscription->warehouse->id, 'period' => 'monthly']) }}" class="menu-link">
                    <div data-i18n="Monthly">Monthly</div>
                  </a>
                </li>
                <li class="menu-item {{ request()->is('reporting/*/sales/yearly') ? 'active' : '' }}">
                  <a href="{{ route('reporting.periodic.sales.index', ['warehouse' => $detail_transaction->warehouse_subscription->warehouse->id, 'period' => 'yearly']) }}" class="menu-link">
                    <div data-i18n="Yearly">Yearly</div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="menu-item {{ request()->is('reporting/*/performance/*') ? 'open' : '' }}">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <div data-i18n="Performance">Performance</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item {{ request()->is('reporting/*/performance/product') ? 'active' : '' }}">
                  <a href="{{ route('reporting.performance.index', ['warehouse' => $detail_transaction->warehouse_subscription->warehouse->id, 'type' => 'product']) }}" class="menu-link">
                    <div data-i18n="Product">Product</div>
                  </a>
                </li>
                <li class="menu-item {{ request()->is('reporting/*/performance/supplier') ? 'active' : '' }}">
                  <a href="{{ route('reporting.performance.index', ['warehouse' => $detail_transaction->warehouse_subscription->warehouse->id, 'type' => 'supplier']) }}" class="menu-link">
                    <div data-i18n="Supplier">Supplier</div>
                  </a>
                </li>
                <li class="menu-item {{ request()->is('reporting/*/performance/customer') ? 'active' : '' }}">
                  <a href="{{ route('reporting.performance.index', ['warehouse' => $detail_transaction->warehouse_subscription->warehouse->id, 'type' => 'customer']) }}" class="menu-link">
                    <div data-i18n="Customer">Customer</div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="menu-item {{ request()->is('history/*/*') ? 'open' : '' }}">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <div data-i18n="History">History</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item {{ request()->is('history/*/rent') ? 'active' : '' }}">
                  <a href="{{ route('reporting.history.index', ['warehouse' => $detail_transaction->warehouse_subscription->warehouse->id, 'type' => 'rent']) }}" class="menu-link">
                    <div data-i18n="Rent">Rent</div>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        @endforeach
      @endif

      <!-- LAPORAN -->
      {{-- <li class="menu-header small text-uppercase">
        <span class="menu-header-text">REPORT</span>
      </li>
      <li class="menu-item {{ request()->is('report/sales', 'report/sales/*', 'report/performance', 'report/performance/*') ? 'open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons ti ti-checkup-list"></i>
          <div data-i18n="Reporting">Reporting</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{ request()->is('report/sales', 'report/sales/*') ? 'active' : '' }}">
            <a href="{{ route('report.sales') }}" class="menu-link">
              <div data-i18n="Sales">Sales</div>
            </a>
          </li>
          <li class="menu-item {{ request()->is('report/performance', 'report/performance/*') ? 'active' : '' }}">
            <a href="{{ route('report.performance') }}" class="menu-link">
              <div data-i18n="Performance">Performance</div>
            </a>
          </li>
        </ul>
      </li> --}}
    </ul>

</aside>