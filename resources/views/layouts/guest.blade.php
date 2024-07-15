<!DOCTYPE html>
<head>

    <meta charset="utf-8">
    <title>@yield('title')</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    
    <!-- GOOGLE FONTS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/themify/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/magnific-popup/magnific-popup.css') }}">

    <!-- VENDOR CSS STYLE -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/slick/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/bs-stepper/bs-stepper.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" />

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style-guest.css') }}">
    
    <!-- FAVICON -->
    <link rel="icon" href="{{ asset('assets/images/favicon.png') }}" type="image/x-icon">

</head>

<body>

    @include('partials.guest.navbar')

    @include('partials.guest.header')

    @yield('section-guest')

    @include('partials.guest.footer')

    @include('partials.guest.scroll')

    <!-- VENDOR JS -->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/magnific-popup/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/slick/slick.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/counterup/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/counterup/jquery.counterup.min.js') }}"></script>

    <!-- MAIN JS -->
    <script src="{{ asset('assets/js/script-guest.js') }}"></script>

    @stack('scripts')
</body>

</html>
