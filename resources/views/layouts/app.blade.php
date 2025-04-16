<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- CSRF Token -->

    {{-- Title --}}
    <title>{{ config('app.name', 'MiPens') }}</title>
    {{-- Title --}}

    {{-- Import CSS File --}}
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/libs/owl.carousel/dist/assets/owl.carousel.min.css') }}">
    <link id="themeColors" rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main/app-layouts.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/sweetalert2/dist/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/owl.carousel/dist/assets/owl.carousel.min.css') }}">
    {{-- Import CSS File --}}

    {{-- STACK STYLE --}}
    @stack('style')
    {{-- STACK STYLE --}}

    {{-- Custom CSS --}}
    <style>
        img {
            object-fit: cover;
        }
    </style>
    {{-- Custom CSS --}}
</head>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/favicon.ico"
            alt="loader" class="lds-ripple img-fluid" />
    </div>
    <div class="preloader">
        <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/favicon.ico"
            alt="loader" class="lds-ripple img-fluid" />
    </div>
    <!-- Preloader -->

    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-theme="blue_theme" data-layout="vertical"
        data-sidebartype="mini-sidebar" data-sidebar-position="fixed" data-header-position="fixed">

        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <livewire:components.sidebar />
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->

        <!--  Main wrapper -->
        <div class="body-wrapper">

            <!--  Header Start -->
            <livewire:components.navbar />
            <!--  Header End -->

            {{-- Content --}}
            <div class="container-fluid">
                @yield('content')
            </div>
            {{-- Content --}}

        </div>
    </div>
    <!--  Body Wrapper -->

    {{-- Import JS File --}}
    <script data-navigate-once src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script data-navigate-once src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.init.js') }}"></script>
    <script src="{{ asset('assets/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/libs/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script data-navigate-once src="{{ asset('assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
    <script data-navigate-once src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script data-navigate-once src="{{ asset('assets/js/apex-chart/apex.area.init.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    {{-- Import JS File --}}

    {{-- STACK SCRIPT --}}
    @stack('script')
    {{-- STACK SCRIPT --}}

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
