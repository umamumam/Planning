<!doctype html>

<html lang="en" class="layout-menu-fixed layout-compact" data-assets-path="../assets/"
    data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <meta name="robots" content="noindex, nofollow" />

    <title>Dashboard</title>

    <meta name="description" content="" />

    <link rel="icon" type="image/x-icon" href="{{ asset('materio/assets/img/backgrounds/wed.png') }}" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('materio/assets/vendor/fonts/iconify-icons.css') }}" />

    <link rel="stylesheet" href="{{ asset('materio/assets/vendor/libs/node-waves/node-waves.css') }}" />

    <link rel="stylesheet" href="{{ asset('materio/assets/vendor/css/core.css') }}" />
    <link rel="stylesheet" href="{{ asset('materio/assets/css/demo.css') }}" />

    <link rel="stylesheet" href="{{ asset('materio/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('materio/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <script src="{{ asset('materio/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('materio/assets/js/config.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    {{-- Aset Vite Anda --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->

            @include('layouts.sidebar')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                @include('layouts.navbar')

                <!-- / Navbar -->

                <!-- Content wrapper -->
                <main>
                    {{ $slot }}
                </main>

                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->

    {{-- <div class="buy-now">
        <a href="https://themeselection.com/item/materio-dashboard-pro-bootstrap/" target="_blank"
            class="btn btn-danger btn-buy-now">Upgrade to Pro</a>
    </div> --}}

    <!-- Core JS -->

    <script src="{{ asset('materio/assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('materio/assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('materio/assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('materio/assets/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('materio/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('materio/assets/vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('materio/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <script src="{{ asset('materio/assets/js/main.js') }}"></script>

    <script src="{{ asset('materio/assets/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag before closing body tag for github widget button. -->
    <script async="async" defer="defer" src="https://buttons.github.io/buttons.js"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>


    <script>
        $(document).ready(function () {
            $('#res-config').DataTable();
        });
    </script>
</body>

</html>
