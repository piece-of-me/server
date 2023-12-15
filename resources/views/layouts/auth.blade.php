<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard 2</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
{{--    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">--}}
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    <style>
        body {
            height: 100%;
            min-height: 100%;
        }
        .content-wrapper {
            margin-left: 0 !important;
            margin-top: 2em;
        }
        .content .row {
            justify-content: center;
        }
    </style>
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                @yield('content')
            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
{{--<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>--}}
<!-- overlayScrollbars -->
{{--<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>--}}
<!-- AdminLTE App -->
{{--<script src="{{ asset('dist/js/adminlte.js') }}"></script>--}}

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
{{--<script src="{{ asset('plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>--}}
{{--<script src="{{ asset('plugins/raphael/raphael.min.js') }}"></script>--}}
{{--<script src="{{ asset('plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>--}}
{{--<script src="{{ asset('plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>--}}
{{--<!-- ChartJS -->--}}
{{--<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>--}}

{{--<!-- AdminLTE dashboard demo (This is only for demo purposes) -->--}}
{{--<script src="{{ asset('dist/js/pages/dashboard2.js') }}"></script>--}}
</body>
</html>
