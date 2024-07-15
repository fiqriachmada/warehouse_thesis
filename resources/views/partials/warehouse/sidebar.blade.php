<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
  
    <div class="app-brand demo">
      <a href="{{ route('warehouse.index', $warehouse->id) }}" class="app-brand-link">
        <span class="app-brand-text demo menu-text fw-bold text-uppercase">Tenant</span>
      <span class="app-brand-text badge rounded-pill bg-{{ $warehouse->rented->status == 'active' ? 'success' : 'danger' }} text-capitalize"></span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
        <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
        <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
      </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
      <!-- Dashboards -->
      <li class="menu-item {{ request()->is('warehouse/'.$warehouse->id.'/dashboard') ? 'open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons ti ti-smart-home"></i>
          <div data-i18n="Dashboards">Dashboards</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{ request()->is('warehouse/'.$warehouse->id.'/dashboard') ? 'active' : '' }}">
            <a href="{{ route('warehouse.index', $warehouse->id) }}" class="menu-link">
              <div data-i18n="Analitik">Analitik</div>
            </a>
          </li>
        </ul>
      </li>

      <!-- MASTER -->
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">MASTER</span>
      </li>
      <li class="menu-item {{ request()->is('warehouse/*/products', 'warehouse/*/products/*') ? 'active' : '' }}">
        <a href="{{ route('warehouse.products.index', $warehouse->id) }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-box"></i>
          <div data-i18n="Products">Products</div>
        </a>
      </li>
      <li class="menu-item {{ request()->is('warehouse/*/categories', 'warehouse/*/categories/*') ? 'active' : '' }}">
        <a href="{{ route('warehouse.product.categories.index', $warehouse->id) }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-truck-loading"></i>
          <div data-i18n="Categories">Categories</div>
        </a>
      </li>
      <li class="menu-item {{ request()->is('warehouse/*/racks', 'warehouse/*/racks/*') ? 'active' : '' }}">
        <a href="{{ route('warehouse.racks.index', $warehouse->id) }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-forklift"></i>
          <div data-i18n="Racks">Racks</div>
        </a>
      </li>
      <li class="menu-item {{ request()->is('warehouse/*/suppliers', 'warehouse/*/suppliers/*') ? 'active' : '' }}">
        <a href="{{ route('warehouse.suppliers.index', $warehouse->id) }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-truck"></i>
          <div data-i18n="Suppliers">Suppliers</div>
        </a>
      </li>
      {{-- <li class="menu-item {{ request()->is('warehouse/*/customers', 'warehouse/*/customers/*') ? 'active' : '' }}">
        <a href="{{ route('warehouse.customers.index', $warehouse->id) }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-users"></i>
          <div data-i18n="Customers">Customers</div>
        </a>
      </li> --}}

      <!-- Tools -->
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">TOOLS</span>
      </li>
      <li class="menu-item {{ request()->is('warehouse/*/inbounds', 'warehouse/*/inbounds/*') ? 'active' : '' }}">
        <a href="{{ route('warehouse.inbound.index', $warehouse->id) }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-plane-arrival"></i>
          <div data-i18n="Inbound">Inbound</div>
        </a>
      </li>
      <li class="menu-item {{ request()->is('warehouse/*/inventory', 'warehouse/*/inventory/*') ? 'active' : '' }}">
        <a href="{{ route('warehouse.inventory.index', $warehouse->id) }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-assembly"></i>
          <div data-i18n="Inventory">Inventory</div>
        </a>
      </li>
      <li class="menu-item {{ request()->is('warehouse/*/outbounds', 'warehouse/*/outbounds/*', 'warehouse/*/outbound/*') ? 'active' : '' }}">
        <a href="{{ route('warehouse.outbound.index', $warehouse->id) }}" class="menu-link">
          <i class="menu-icon tf-icons ti ti-outbound"></i>
          <div data-i18n="Outbound">Outbound</div>
        </a>
      </li>

      <!-- LAPORAN -->
      <li class="menu-header small text-uppercase">
        <span class="menu-header-text">REPORT</span>
      </li>
      <li class="menu-item {{ request()->is('warehouse/*/reporting-sales/*') ? 'open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons ti ti-clipboard-list"></i>
          <div data-i18n="Sales">Sales</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{ request()->is('warehouse/*/reporting-sales/daily') ? 'active' : '' }}">
            <a href="{{ route('reporting.periodic.warehouse.sales.index', ['warehouse' => $warehouse->id, 'period' => 'daily']) }}" class="menu-link">
              <div data-i18n="Daily">Daily</div>
            </a>
          </li>
          <li class="menu-item {{ request()->is('warehouse/*/reporting-sales/monthly') ? 'active' : '' }}">
            <a href="{{ route('reporting.periodic.warehouse.sales.index', ['warehouse' => $warehouse->id, 'period' => 'monthly']) }}" class="menu-link">
              <div data-i18n="Monthly">Monthly</div>
            </a>
          </li>
          <li class="menu-item {{ request()->is('warehouse/*/reporting-sales/yearly') ? 'active' : '' }}">
            <a href="{{ route('reporting.periodic.warehouse.sales.index', ['warehouse' => $warehouse->id, 'period' => 'yearly']) }}" class="menu-link">
              <div data-i18n="Yearly">Yearly</div>
            </a>
          </li>
        </ul>
      </li>
      <li class="menu-item {{ request()->is('warehouse/*/performance/*') ? 'open' : '' }}">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
          <i class="menu-icon tf-icons ti ti-clipboard-list"></i>
          <div data-i18n="Performance">Performance</div>
        </a>
        <ul class="menu-sub">
          <li class="menu-item {{ request()->is('warehouse/*/performance/product') ? 'active' : '' }}">
            <a href="{{ route('warehouse.performance.index', ['warehouse' => $warehouse->id, 'type' => 'product']) }}" class="menu-link">
              <i class="menu-icon tf-icons ti ti-clipboard-list"></i>
              <div data-i18n="Product">Product</div>
            </a>
          </li>
          <li class="menu-item {{ request()->is('warehouse/*/performance/supplier') ? 'active' : '' }}">
            <a href="{{ route('warehouse.performance.index', ['warehouse' => $warehouse->id, 'type' => 'supplier']) }}" class="menu-link">
              <i class="menu-icon tf-icons ti ti-clipboard-list"></i>
              <div data-i18n="Supplier">Supplier</div>
            </a>
          </li>
          <li class="menu-item {{ request()->is('warehouse/*/performance/customer') ? 'active' : '' }}">
            <a href="{{ route('warehouse.performance.index', ['warehouse' => $warehouse->id, 'type' => 'customer']) }}" class="menu-link">
              <i class="menu-icon tf-icons ti ti-clipboard-list"></i>
              <div data-i18n="Customer">Customer</div>
            </a>
          </li>
        </ul>
      </li>

      {{-- <li class="menu-item {{ request()->is('report/sales', 'report/sales/*', 'report/performance', 'report/performance/*') ? 'open' : '' }}">
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