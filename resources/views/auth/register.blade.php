<!DOCTYPE html>
<html class="loading bordered-layout" lang="en" data-layout="bordered-layout" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Description">
    <meta name="author" content="KelolaTekno">
    <title>Daftar Akun - YoResellAdmin</title>
    <link rel="apple-touch-icon" href="{{ asset('app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('content/uploads/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/bordered-layout.min.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-wizard.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/forms/form-validation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/authentication.css') }}">
</head>
<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-cover">
                    <div class="auth-inner row m-0">
                        <!-- Brand logo-->
                        <a class="brand-logo" href="index.html">
                            <img width="60" src="{{ asset('content/uploads/logo.png') }}">&nbsp;&nbsp;
                            <h2 class="brand-text text-primary ms-1">YoResellAdmin</h2>
                        </a>
                        <!-- /Brand logo-->

                        <!-- Left Text-->
                        <div class="col-lg-3 d-none d-lg-flex align-items-center p-0">
                            <div class="w-100 d-lg-flex align-items-center justify-content-center">
                                <img class="img-fluid w-100" src="{{ asset('app-assets/images/illustration/create-account.svg') }}" alt="YoResellAdmin" />
                            </div>
                        </div>
                        <!-- /Left Text-->

                        <!-- Register-->
                        <div class="col-lg-9 d-flex align-items-center auth-bg px-2 px-sm-3 px-lg-5 pt-3">
                            <div class="width-700 mx-auto">
                                <div class="shadow-none">
                                    <div class="bs-stepper-content px-0 mt-4">
                                        <div class="content">
                                            <div class="content-header mb-2">
                                                <h2 class="fw-bolder mb-75">Register Akun</h2>
                                            </div>
                                            <form method="post" action="register.php" class="auth-register-form mt-2">
                                                <div class="alert alert-danger d-none" id="error-list">
                                                    <ul></ul>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 mb-1">
                                                        <label class="form-label" for="username">Username</label>
                                                        <input type="text" class="form-control" name="username" required autocomplete="username" placeholder="Username">
                                                        <span class="invalid-feedback d-none" role="alert">
                                                            <strong></strong>
                                                        </span>
                                                    </div>
                                                    <div class="col-md-8 mb-1">
                                                        <label class="form-label" for="full_name">Full Name</label>
                                                        <input type="text" class="form-control" name="full_name" id="full_name" placeholder="Full Name">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 mb-1">
                                                        <label class="form-label" for="email">Email</label>
                                                        <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                                                    </div>
                                                    <div class="col-md-8 mb-1">
                                                        <label class="form-label" for="confirm-password">Password</label>
                                                        <div class="input-group input-group-merge form-password-toggle">
                                                            <input id="confirm-password" type="password" class="form-control" name="password" required autocomplete="new-password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                                                            <div class="input-group-append"><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 mb-1">
                                                        <label class="form-label" for="phone">No Handphone</label>
                                                        <input type="text" class="form-control numeric" name="telp" required autocomplete="telp" placeholder="Nomor HP">
                                                        <span class="invalid-feedback d-none" role="alert">
                                                            <strong></strong>
                                                        </span>
                                                    </div>
                                                    <div class="col-md-8 mb-1">
                                                        <label class="form-label" for="roles">Roles</label>
                                                        <select class="form-control" name="roles" required>
                                                            <option hidden>Select role</option>
                                                            <option value="administrator">Administrator</option>
                                                            <option value="cso">CSO</option>
                                                            <option value="user">User</option>
                                                        </select>
                                                        <span class="invalid-feedback d-none" role="alert">
                                                            <strong></strong>
                                                        </span>
                                                    </div>                                                    
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4 mb-1">
                                                        <div id="captcha"></div>
                                                        <span class="invalid-feedback d-none" role="alert">
                                                            <strong></strong>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between mt-2">
                                                    <button type="submit" class="btn btn-success btn-submit">
                                                        <i data-feather="check" class="align-middle me-sm-25 me-0"></i>
                                                        <span class="align-middle d-sm-inline-block d-none">Daftar</span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.min.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/pages/auth-register.min.js') }}"></script>
    <script>
        $(".numeric").keypress(function (e) {
            if (e.which != 8 && e.which != 0 &&  e.which != 32 && (e.which < 48 || e.which > 57)) {
                $("#errmsg").html("Digits Only").show().fadeOut(3000);
                return false;
            }
        });
    </script>
    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        });
    </script>
</body>
</html>
