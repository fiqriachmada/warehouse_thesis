<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  
    <div class="app-brand demo">
      <a href="/" class="app-brand-link">
        <span class="app-brand-text demo menu-text fw-bold">ADMIN</span>
        <span class="app-brand-text badge rounded-pill bg-primary">{{ auth()->user()->attribute == 'core' ? 'CORE' : 'DEFAULT' }}</span>
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

      <!-- MASTER -->
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">MASTER</span>
      </li>
      <li class="menu-item {{ request()->is('master/admin', 'master/admin/*', 'master/tenant', 'master/tenant/*') ? 'open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons ti ti-users"></i>
          <div data-i18n="User">User</div>
          <div class="badge bg-label-primary rounded-pill ms-auto" id="label-total-brand-influencer-new-count"></div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{ request()->is('master/admin', 'master/admin/*') ? 'active' : '' }}">
            <a href="{{ route('master.admin') }}" class="menu-link">
              <div data-i18n="Admin">Admin</div>
              <div class="badge bg-label-primary rounded-pill ms-auto" id="label-brand-new-count"></div>
            </a>
          </li>
          <li class="menu-item {{ request()->is('master/tenant', 'master/tenant/*') ? 'active' : '' }}">
            <a href="{{ route('master.tenant') }}" class="menu-link">
              <div data-i18n="Tenant">Tenant</div>
              <div class="badge bg-label-primary rounded-pill ms-auto" id="label-influencer-new-count"></div>
            </a>
          </li>
        </ul>
      </li>
      <li class="menu-item {{ request()->is('master/warehouse', 'master/warehouse/*', 'master/category', 'master/category/*') ? 'open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons ti ti-building-warehouse"></i>
          <div data-i18n="Property">Property</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{ request()->is('master/warehouse', 'master/warehouse/*') ? 'active' : '' }}">
            <a href="{{ route('master.warehouse') }}" class="menu-link">
              <div data-i18n="Warehouse">Warehouse</div>
            </a>
          </li>
          <li class="menu-item {{ request()->is('master/category', 'master/category/*') ? 'active' : '' }}">
            <a href="{{ route('master.warehouse.category') }}" class="menu-link">
              <div data-i18n="Category">Category</div>
            </a>
          </li>
        </ul>
      </li>
      @if (auth()->user()->attribute == 'core')
      <li class="menu-item {{ request()->is('master/subscription', 'master/subscription/*') ? 'active' : '' }}">
        <a href="{{ route('master.subscription') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-assembly"></i>
          <div data-i18n="Subscription">Subscription</div>
          <div class="badge bg-label-primary rounded-pill ms-auto" id="label-brand-new-count"></div>
        </a>
      </li>
      <li class="menu-item {{ request()->is('master/taxes', 'master/taxes/*') ? 'active' : '' }}">
        <a href="{{ route('master.taxes') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-receipt-tax"></i>
          <div data-i18n="Taxes">Taxes</div>
          <div class="badge bg-label-primary rounded-pill ms-auto" id="label-brand-new-count"></div>
        </a>
      </li>
      @endif

      @if (auth()->user()->attribute == 'core')
      <!-- PERHITUNGAN HARGA RENTAL -->
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">CALCULATION</span>
      </li>
      <li class="menu-item {{ request()->is('calculation/rental-price', 'calculation/rental-price/*', 'calculation/rental-price/*') ? 'active' : '' }}">
        <a href="{{ route('calculation.rental.price') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-zoom-money"></i>
          <div data-i18n="Rental Price">Rental Price</div>
          <div class="badge bg-label-primary rounded-pill ms-auto" id="label-brand-new-count"></div>
        </a>
      </li>
      @endif

      <!-- TRANSAKSI MASUK -->
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">PURCHASE</span>
      </li>
      <li class="menu-item {{ request()->is('purchase/*') ? 'active' : '' }}">
        <a href="{{ route('purchase.index', 'payment') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-zoom-money"></i>
          <div data-i18n="Purchases">Purchases</div>
          <div class="badge bg-label-primary rounded-pill ms-auto" id="label-new-purchase-count"></div>
        </a>
      </li>

      <!-- SPESIAL -->
      {{-- <li class="menu-header small text-uppercase">
        <span class="menu-header-text">SPECIAL</span>
      </li>
      <li class="menu-item {{ request()->is('billing') ? 'active' : '' }}">
        <a href="{{ route('admin.settings.billing') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-credit-card"></i>
          <div data-i18n="Billing">Billing</div>
        </a>
      </li> --}}

      <!-- LAPORAN -->
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">REPORTING</span>
      </li>
      <li class="menu-item {{ request()->is('report/daily-sales', 'report/monthly-sales', 'report/yearly-sales') ? 'open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons ti ti-checkup-list"></i>
          <div data-i18n="Sales">Sales</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{ request()->is('report/daily-sales') ? 'active' : '' }}">
            <a href="{{ route('report.daily.sales') }}" class="menu-link">
              <div data-i18n="Daily">Daily</div>
            </a>
          </li>
          <li class="menu-item {{ request()->is('report/monthly-sales') ? 'active' : '' }}">
            <a href="{{ route('report.monthly.sales') }}" class="menu-link">
              <div data-i18n="Monthly">Monthly</div>
            </a>
          </li>
          <li class="menu-item {{ request()->is('report/yearly-sales') ? 'active' : '' }}">
            <a href="{{ route('report.yearly.sales') }}" class="menu-link">
              <div data-i18n="Yearly">Yearly</div>
            </a>
          </li>
        </ul>
      </li>
      <li class="menu-item {{ request()->is('report/taxes') ? 'active' : '' }}">
        <a href="{{ route('report.taxes') }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-checkup-list"></i>
          <div data-i18n="Taxes">Taxes</div>
        </a>
      </li>
    </ul>

</aside>