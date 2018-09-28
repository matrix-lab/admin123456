<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/favicon.png">
    <title>@yield('title')</title>
    <link rel="stylesheet" type="text/css" href="/assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css"/>
    <link rel="stylesheet" type="text/css" href="/assets/extra-libs/multicheck/multicheck.css"/>
    <link rel="stylesheet" type="text/css" href="/assets/libs/toastr/build/toastr.min.css"/>
    <link href="/css/style.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <![endif]-->
    <!--<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>-->
    <!--<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>-->
    <style>
        table th{
            font-size: 14px;
        }
        table td{
            font-size: 13px;
        }
    </style>
</head>
<body>
{{--<div class="preloader">--}}
{{--<div class="lds-ripple">--}}
{{--<div class="lds-pos"></div>--}}
{{--<div class="lds-pos"></div>--}}
{{--</div>--}}
{{--</div>--}}
<div id="main-wrapper">
    @include('layout.header')
    @include('layout.aside')
    <div class="page-wrapper">
        @yield('content')
        @include('layout.footer')
    </div>
</div>
<script src="/assets/libs/jquery/dist/jquery.min.js"></script>
<!--Menu sidebar -->
<script src="/js/sidebarmenu.js"></script>
<!-- Bootstrap tether Core JavaScript -->
<script src="/assets/libs/popper.js/dist/umd/popper.min.js"></script>
<script src="/assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
<!--DataTable-->
<script src="/assets/extra-libs/DataTables/datatables.min.js"></script>
<script src="/assets/libs/toastr/build/toastr.min.js"></script>
<script src="/assets/libs/axios/axios.min.js"></script>
<script src="/assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!--Custom JavaScript -->
<script src="/js/custom.min.js"></script>
@yield('scripts')
</body>
</html>
