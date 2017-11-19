<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    {{--<link rel="stylesheet" href="../../bower_components/bootstrap/dist/css/bootstrap.min.css">--}}
    <link rel="stylesheet" href="{{ URL::asset('plugins/new_look/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
          integrity="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
          crossorigin="anonymous">
    <!-- Ionicons -->
    {{--<link rel="stylesheet" href="../../bower_components/Ionicons/css/ionicons.min.css">--}}
    <link rel="stylesheet" href="{{ URL::asset('plugins/new_look/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    {{--<link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">--}}
    <link rel="stylesheet" href="{{ URL::asset('plugins/new_look/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    {{--<link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">--}}
    <link rel="stylesheet" href="{{ URL::asset('plugins/new_look/css/skins/_all-skins.min.css') }}">

    @yield('stylesheets')
    <link rel="stylesheet" href="{{ URL::asset('plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
    <link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon">
</head>
<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->
<body class="fixed sidebar-mini sidebar-mini-expand-feature skin-blue">
<!-- Site wrapper -->
<div class="wrapper">
    @include('partials._nav-sidebar')
    @yield('content')
    @include('partials._footer')
</div>
<!-- ./wrapper -->
<div id="loader"></div>
<!-- jQuery 3 -->
{{--<script src="../../bower_components/jquery/dist/jquery.min.js"></script>--}}
<script src="{{ asset('plugins/new_look/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
{{--<script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>--}}
<script src="{{ asset('plugins/new_look/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
{{--<script src="../../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>--}}
<script src="{{ asset('plugins/new_look/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
{{--<script src="../../bower_components/fastclick/lib/fastclick.js"></script>--}}
<script src="{{ asset('plugins/new_look/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
{{--<script src="../../dist/js/adminlte.min.js"></script>--}}
<script src="{{ asset('plugins/new_look/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
{{--<script src="../../dist/js/demo.js"></script>--}}
<script src="{{ asset('plugins/new_look/js/demo.js') }}"></script>
@yield('javascripts')
<script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>
<script>
    var loading = $('#loader');
    $(document)
        .ajaxStart(function () {
            loading.show();
        })
        .ajaxStop(function () {
            loading.hide();
        });
    $(window).on("load", function () {
        loading.fadeOut("slow");
    })
</script>
</body>
</html>
