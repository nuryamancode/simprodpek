<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/image/mareca.png') }}">
    <title>{{ $title ?? config('app.name') }} - Simprodpek</title>
    <link href="{{ asset('humanresources/vendor/c3/c3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('humanresources/vendor/chartist/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('humanresources/vendor/jvector/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <link href="{{ asset('humanresources/vendor/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('humanresources/css/style.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/4.3.0/css/fixedColumns.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.0.2/css/buttons.dataTables.css">
    <style>
        table.dataTable thead tr>.dtfc-fixed-right {
            background-color: #1C2D41;
        }

        .verifikasi-not,
        .status-reject {
            padding: 7px;
            background-color: #FA896B;
            border-radius: 12px;
            color: #fff;
        }

        .verifikasi-done,
        .status-done {
            padding: 7px;
            background-color: #13DEB9;
            border-radius: 12px;
            color: #fff;
        }

        .status-review {
            padding: 7px;
            border-radius: 12px;
            background-color: #5D87FF;
            color: #fff;
        }

        .status-waiting {
            padding: 7px;
            border-radius: 12px;
            background-color: #FFAE1F;
            color: #fff;
        }
    </style>


</head>

<body>
    {{-- PreLoader --}}
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    {{-- PreLoader --}}
    <!-- Main wrapper -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- Topbar navbar -->
        @include('hr.layouts.hr-navbar')
        <!-- End Topbar navbar -->
        <!-- Sidebar  -->
        @include('hr.layouts.hr-sidebar')
        <!-- End Sidebar  -->
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            @yield('content-hr')
        </div>
        @include('components.footer-hr')
        <!-- End Page wrapper  -->
    </div>
    @include('vendor.sweetalert.alert')
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="{{ asset('humanresources/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('humanresources/js/feather.min.js') }}"></script>
    <script src="{{ asset('humanresources/vendor/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('humanresources/js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('humanresources/js/custom.min.js') }}"></script>
    <script src="{{ asset('humanresources/vendor/c3/d3.min.js') }}"></script>
    <script src="{{ asset('humanresources/vendor/c3/c3.min.js') }}"></script>
    <script src="{{ asset('humanresources/vendor/chartist/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('humanresources/vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    @yield('js')
</body>

</html>
