<!DOCTYPE html>
<html class="loading bordered-layout" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="author" content="KelolaTekno">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ getSetting('web_name') }} - @yield('title')</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('content/uploads/'.getSetting('favicon')) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/fonts/font-awesome/css/font-awesome.min.css')}}">
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/bordered-layout.css')}}">
    <link href="{{ asset('app-assets/select2/css/select2.min.css') }}" rel="stylesheet">
    <style>.home-title{ color: #636363; }.text-align-right{text-align: right;}.fontme{font-size:1.3em}.text-align-center{text-align: center}.uppercased {text-transform: uppercase; }</style>
    @yield('styles')
</head>
<body class="vertical-layout vertical-menu-modern" data-open="click" data-menu="vertical-menu-modern" data-col="">
    <div class="row">
        <div class="col-12">
            @yield('content')
        </div>
    </div>
</body>
</html>