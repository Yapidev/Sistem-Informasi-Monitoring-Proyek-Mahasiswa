<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Title --}}
    <title>{{ config('app.name', 'MiPens') }}</title>
    {{-- Title --}}

    {{-- Import CSS File --}}
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/libs/owl.carousel/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/sweetalert2/dist/sweetalert2.min.css') }}">
    <link id="themeColors" rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}" />
    {{-- Import CSS File --}}

    {{-- Stack style --}}
    @stack('style')
    {{-- Stack style --}}

</head>

<body>
    {{-- Yield Content --}}
    @yield('content')

    {{-- Stack Script --}}
    @stack('script')

    <!--  Import Js Files -->
    <script src="{{ asset('assets/libs/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script data-navigate-once src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script data-navigate-once src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.init.js') }}"></script>
    <script src="{{ asset('assets/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script data-navigate-once src="{{ asset('assets/libs/owl.carousel/dist/owl.carousel.min.js') }}"></script>
    <script data-navigate-once src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script data-navigate-once src="{{ asset('assets/js/dashboard.js') }}"></script>
    <!--  Import Js Files -->

    {{-- Sweet Alert JS for Sessions --}}
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Sukses',
                text: "{{ session('success') }}",
                timer: 2000,
                showConfirmButton: false,
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: "{{ session('error') }}",
                timer: 2000,
                showConfirmButton: false,
            });
        </script>
    @endif
    {{-- Sweet Alert JS for Sessions --}}

</body>

</html>
