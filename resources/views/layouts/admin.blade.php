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
        @if (request()->is('master/admin/*', 'master/tenant/*'))
            <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-user-view.css') }}" />
        @elseif (request()->is('master/warehouse/*'))
            <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/ui-carousel.css') }}" />
        @elseif (request()->is('master/category/*'))
            <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/ui-carousel.css') }}" />
        @elseif (request()->is('admin/profile', 'admin/teams'))
            <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-profile.css') }}" />
        @elseif (request()->is('/'))
            <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/cards-advance.css') }}" />
        @endif
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

    @include('components.flasher.flasher')

    @include('components.modal.modal')

    @auth
        @if (request()->is('report/daily-sales/*/print', 'report/monthly-sales/*/print', 'report/yearly-sales/*/print'))
            @yield('section-print')

            <script>
                window.print();
            </script>
        @else
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
    
            @include('partials.admin.sidebar')
    
            <div class="layout-page">
            
                @include('partials.admin.navbar')
    
                <div class="content-wrapper">
    
                @yield('section-admin')
    
                <div class="content-backdrop fade"></div>
                </div>
            </div>
            </div>
    
            <div class="layout-overlay layout-menu-toggle"></div>
    
            <div class="drag-target"></div>
        </div>
        @endif
    @else
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">

                @yield('section-admin-authentication')

            </div>
        </div>
    @endauth

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
    <script src="{{ asset('assets/js/script-admin.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

    <!-- Page JS -->
    @auth
        @if (request()->is('dashboard/*'))
            <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
            <script src="{{ asset('assets/js/dashboards-crm.js') }}"></script>
        @elseif (request()->is('master/admin', 'master/admin/*'))
            <script src="{{ asset('assets/js/app-admin-list.js') }}"></script>
        @elseif (request()->is('master/tenant', 'master/tenant/*'))
            <script src="{{ asset('assets/js/app-tenant-list.js') }}"></script>
        @elseif (request()->is('master/warehouse'))
            <script src="{{ asset('assets/js/app-warehouse-list.js') }}"></script>
        @elseif (request()->is('master/warehouse/*'))
            <script src="{{ asset('assets/js/ui-carousel.js') }}"></script>
            <script src="{{ asset('assets/js/wizard-ex-property-listing.js') }}"></script>
        @elseif (request()->is('master/category', 'master/category/*'))
            <script src="{{ asset('assets/js/ui-carousel.js') }}"></script>
            <script src="{{ asset('assets/js/app-category-list.js') }}"></script>
        @elseif (request()->is('master/subscription', 'master/subscription/*'))
            <script src="{{ asset('assets/js/app-subscription-list.js') }}"></script>
            <script src="{{ asset('assets/js/app-detail-subscription-list.js') }}"></script>
        @elseif (request()->is('master/taxes', 'master/taxes/*'))
            <script src="{{ asset('assets/js/app-taxes-list.js') }}"></script>
        @elseif (request()->is('purchase/payment'))
            <script src="{{ asset('assets/js/app-purchase-pending-list.js') }}"></script>
        @elseif (request()->is('purchase/confirmed'))
            <script src="{{ asset('assets/js/app-purchase-confirmed-list.js') }}"></script>
        {{-- @elseif (request()->is('purchase/declined'))
            <script src="{{ asset('assets/js/app-purchase-declined-list.js') }}"></script> --}}
        @elseif (request()->is('calculation/rental-price', 'calculation/rental-price/*'))
            <script src="{{ asset('assets/js/app-rental-price-calculation-list.js') }}"></script>
            <script src="{{ asset('assets/js/app-warehouse-subscription-list.js') }}"></script>
        @elseif (request()->is('settings/*'))
            <script src="{{ asset('assets/js/pages-account-settings-security.js') }}"></script>
            <script src="{{ asset('assets/js/pages-account-settings-billing.js') }}"></script>
        @elseif (request()->is('billing'))
            <script src="{{ asset('assets/js/app-bills-history-list.js') }}"></script>
        @elseif (request()->is('report/daily-sales'))
            <script src="{{ asset('assets/js/app-daily-sales-report-list.js') }}"></script>
        @elseif (request()->is('report/monthly-sales'))
            <script src="{{ asset('assets/js/app-monthly-sales-report-list.js') }}"></script>
        @elseif (request()->is('report/yearly-sales'))
            <script src="{{ asset('assets/js/app-yearly-sales-report-list.js') }}"></script>
        @elseif (request()->is('report/taxes'))
            <script src="{{ asset('assets/js/app-report-taxes-list.js') }}"></script>
        @elseif (request()->is('/'))
            <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
            <script src="{{ asset('assets/js/dashboards-crm.js') }}"></script>
        @endif
    @else
        <script src="{{ asset('assets/js/pages-auth.js') }}"></script>
    @endauth
    
    @stack('scripts')
  </body>
</html>