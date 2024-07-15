<!DOCTYPE html>

<html
  lang="en"
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../../../assets/"
  data-template="vertical-menu-template">
  <head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title')</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo-icon.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/dropzone/dropzone.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/tagify/tagify.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />

    @guest
        <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
    @endguest

    <!-- Page CSS -->
    @auth
        @if (\App\Models\Rented::where('tenant_id', auth()->user()->tenant->id)->where('warehouse_id', $warehouse->id)->count() == 0)
            <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-misc.css') }}" />
        @endif

        {{-- @if (request()->is('master/admin/*', 'master/tenant/*'))
            <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-user-view.css') }}" />
        @elseif (request()->is('master/warehouse/*'))
            <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/ui-carousel.css') }}" />
        @elseif (request()->is('admin/profile', 'admin/teams'))
            <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-profile.css') }}" />
        @endif --}}
    @else
        <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />
    @endauth

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script>
    <script src="{{ asset('assets/js/config.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
  </head>

  <body>

    @if (\App\Models\Rented::where('tenant_id', auth()->user()->tenant->id)->where('warehouse_id', $warehouse->id)->count() == 0)
        @include('components.error.page-not-found')
    @else
        @include('components.flasher.flasher')

        @include('components.modal.modal')

        @if (request()->is('warehouse/*/outbound-print/*', 'warehouse/*/sales-print-daily/*', 'warehouse/*/sales-print-monthly/*', 'warehouse/*/sales-print-yearly/*'))
            @yield('section-print')

            <script>
                window.print();
            </script>
        @else
            <div class="layout-wrapper layout-content-navbar">
                <div class="layout-container">

                @include('partials.warehouse.sidebar')

                    <div class="layout-page">
                    
                        @include('partials.warehouse.navbar')

                        <div class="content-wrapper">

                        @yield('section-warehouse')

                        <div class="content-backdrop fade"></div>
                            <footer class="content-footer footer bg-footer-theme">
                                <div class="container-xxl">
                                    <div class="footer-container d-flex align-items-center justify-content-center py-2 flex-md-row flex-column font-weight-bold">
                                        <span>Remaining Rental Time :</span>
                                        <span class="text-primary">@calculateRemainingTime(\Carbon\Carbon::parse(\Carbon\Carbon::now())->format('Y-m-d') , $warehouse->rented->ended_at)</span>
                                    </div>
                                </div>
                            </footer>
                        </div>
                    </div>
                </div>

                <div class="layout-overlay layout-menu-toggle"></div>

                <div class="drag-target"></div>
            </div>
        @endif
    @endif

    <!-- Core JS -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>

    <script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

    <!-- Vendors JS -->
    @auth
        <script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/tagify/tagify.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
    @else
        <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
        <script src="{{ asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
    @endauth
    <script src="{{ asset('assets/js/extended-ui-sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/prev-image.js') }}"></script>
    <script src="{{ asset('assets/js/script-warehouse.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->
    @if (request()->is('dashboard/*'))
        <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
        <script src="{{ asset('assets/js/dashboards-crm.js') }}"></script>
    @elseif (request()->is('warehouse/*/products', 'warehouse/*/products/*'))
        <script src="{{ asset('assets/js/app-warehouse-product-list.js') }}"></script>
        <script src="{{ asset('assets/js/wizard-ex-product-listing.js') }}"></script>
    @elseif (request()->is('warehouse/*/categories'))
        <script src="{{ asset('assets/js/app-warehouse-product-category-list.js') }}"></script>
    @elseif (request()->is('warehouse/*/racks'))
        <script src="{{ asset('assets/js/app-warehouse-rack-list.js') }}"></script>
    @elseif (request()->is('warehouse/*/suppliers'))
        <script src="{{ asset('assets/js/app-warehouse-supplier-list.js') }}"></script>
    @elseif (request()->is('warehouse/*/customers'))
        <script src="{{ asset('assets/js/app-warehouse-customer-list.js') }}"></script>
    @elseif (request()->is('warehouse/*/inbounds', 'warehouse/*/inbounds/*'))
        <script src="{{ asset('assets/js/app-warehouse-inbound-list.js') }}"></script>
        <script src="{{ asset('assets/js/wizard-ex-inbound-listing.js') }}"></script>
    @elseif (request()->is('warehouse/*/inventory', 'warehouse/*/inventory/*'))
        <script src="{{ asset('assets/js/app-warehouse-inventory-list.js') }}"></script>
    @elseif (request()->is('warehouse/*/outbounds'))
        <script src="{{ asset('assets/js/app-warehouse-outbound-list.js') }}"></script>
    @elseif (request()->is('warehouse/*/outbounds/add'))
        <script src="{{ asset('assets/js/app-warehouse-customer-outbound-list.js') }}"></script>
        <script src="{{ asset('assets/js/app-warehouse-product-outbound-list.js') }}"></script>
    @elseif (request()->is('warehouse/*/performance/supplier'))
        <script src="{{ asset('assets/js/app-warehouse-supplier-performance-list.js') }}"></script>
    @elseif (request()->is('warehouse/*/performance/product'))
        <script src="{{ asset('assets/js/app-warehouse-product-performance-list.js') }}"></script>
    @elseif (request()->is('warehouse/*/performance/customer'))
        <script src="{{ asset('assets/js/app-warehouse-customer-performance-list.js') }}"></script>
    @elseif (request()->is('warehouse/*/reporting-sales/daily'))
        <script src="{{ asset('assets/js/app-daily-sales-report-warehouse-list.js') }}"></script>
    @elseif (request()->is('warehouse/*/reporting-sales/monthly'))
        <script src="{{ asset('assets/js/app-monthly-sales-report-warehouse-list.js') }}"></script>
    @elseif (request()->is('warehouse/*/reporting-sales/yearly'))
        <script src="{{ asset('assets/js/app-yearly-sales-report-warehouse-list.js') }}"></script>
    @endif
    
    @stack('scripts')
  </body>
</html>
