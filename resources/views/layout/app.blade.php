<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="author" content="YOGYAGROUP">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="YoResellAdmin">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="YoResellAdmin">
    <meta name="csrf-token" content="">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicon/apple-icon-152x152.png') }}">
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('favicon/android-icon-192x192.png') }}">
    <link rel="manifest" href="{{ url('manifest.json') }}">
    <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
    <title>{{$title}} | YoResellAdmin</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('content/uploads/favicon.png') }}">
    <link href="{{ asset('app-assets/css/google-font/google-fonts.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/sweetalert2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/fonts/font-awesome/css/font-awesome.min.css')}}">
    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/bordered-layout.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link href="{{ asset('app-assets/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>.brand-text-head {font-size: 1em;color: #7367F0;white-space: normal;margin-left: 1.7mm}.home-font{font-size:5em}.home-title{ color: #636363; }.text-align-right{text-align: right;}.fontme{font-size:1.3em}.text-align-center{text-align: center}.uppercased {text-transform: uppercase; }</style>
    @yield('styles')
    @section('title', 'Home')
</head>
<body class="vertical-layout vertical-menu-modern navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="">
    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <ul class="nav navbar-nav d-xl-none">
                    <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon" data-feather="menu"></i></a></li>
                </ul>
                <ul class="nav navbar-nav">
                    @include('layout.breadcrumb')
                </ul>
            </div>
            <ul class="nav navbar-nav align-items-center ml-auto">
                <li class="nav-item dropdown dropdown-user">
                    <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none">
                            <span class="user-name font-weight-bolder">{{Auth::user()->username}}</span>
                            <span class="user-status">Kepatihan</span>
                        </div>
                        <span class="avatar">
                            <img class="round" id="avatar_picture" src="{{ asset('pictures/users/default.png') }}" onerror="this.src='{{ asset('app-assets/images/avatars/default.png')}}';" alt="avatar" height="40" width="40">
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                        {{-- @if(Auth::user()->can('stores-change'))
                        <a class="dropdown-item" href="javascript:void();" data-toggle="modal" data-target="#modalChangeStore"><i class="fas fa-store mr-50"></i> Change Store</a>
                        <div class="dropdown-divider"></div>
                        @endcan --}}
                        <a class="dropdown-item" href="{{ url('/users/edit/profile') }}"><i class="mr-50" data-feather="user"></i> Profile</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"><i class="mr-50" data-feather="power"></i> Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- BEGIN: Main Menu-->
    @include('layout.sidemenu')
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <div class="row">
                    <div class="col-12">
                        @yield('content') 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>
    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; {{ date('Y') }} YOGYAGROUP</span></span><span class="float-md-right d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span></p>
    </footer>
    {{-- @if(Auth::user()->can('stores-change'))
    <!-- Modal add Change Store-->
    @include('store.store')
    @endif --}}
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- BEGIN: Vendor JS-->
    <form id="logout-form" action="" method="POST" style="display: none;">
        @csrf
    </form>
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js')}}"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js')}}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js')}}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js')}}"></script>
    <script src="{{ asset('app-assets/select2/js/select2.min.js') }}"></script>
    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
    <!-- BEGIN: Page JS-->
    @yield('scripts')
    <script>
        $(document).ready(function() {
            $('.select-data, #select-data-1, #select-data-2').select2({
            placeholder: '-- Select Option --',
            allowClear: true,
            width: '100%'
            });
        });

        $("select").closest("form").on("reset",function(ev){
            var targetJQForm = $(ev.target);
            setTimeout((function(){
                this.find("select").trigger("change");
            }).bind(targetJQForm),0);
        });
        $(".numeric").keypress(function (e) {
            if (e.which != 8 && e.which != 0 &&  e.which != 32 && (e.which < 48 || e.which > 57)) {
                $("#errmsg").html("Number Only").show().fadeOut(3000);
                return false;
            }
        })
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
        $(document).on('keydown','#form-field > tbody tr .qty',function (e) {
            if (e.which === 38) {
                $(this).parents("tr").prev("tr").find('.qty').focus();
            }
            if (e.which === 40) {
                $(this).parents("tr").next("tr").find('.qty').focus();
            }
        });
    </script>
</body>
</html>