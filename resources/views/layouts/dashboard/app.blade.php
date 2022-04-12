<!DOCTYPE html>
<html dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 3 | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if (app()->getLocale() == 'ar')
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('/')}}/dashboardFiles/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet"
        href="{{url('/')}}/dashboardFiles/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{url('/')}}/dashboardFiles/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{url('/')}}/dashboardFiles/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('/')}}/dashboardFiles/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{url('/')}}/dashboardFiles/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{url('/')}}/dashboardFiles/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{url('/')}}/dashboardFiles/plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Bootstrap 4 RTL -->
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
    <!-- Custom style for RTL -->
    <link rel="stylesheet" href="{{url('/')}}/dashboardFiles/dist/css/custom.css">
    <link href="https://fonts.googleapis.com/css?family=Cairo:400,700" rel="stylesheet">
    <style>
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Cairo', sans-serif !important;
        }
    </style>
    @else
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{url('/')}}/dashboardFiles/pluginsLTR/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{url('/')}}/dashboardFiles/pluginsLTR/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{url('/')}}/dashboardFiles/pluginsLTR/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{url('/')}}/dashboardFiles/pluginsLTR/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('/')}}/dashboardFiles/distLTR/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet"
        href="{{url('/')}}/dashboardFiles/pluginsLTR/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{url('/')}}/dashboardFiles/pluginsLTR/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{url('/')}}/dashboardFiles/pluginsLTR/summernote/summernote-bs4.min.css">
    @endif
    @toastr_css
    <style>
        .mr-2 {
            margin-right: 5px;
        }

        .loader {
            border: 5px solid #f3f3f3;
            border-radius: 50%;
            border-top: 5px solid #367FA9;
            width: 60px;
            height: 60px;
            -webkit-animation: spin 1s linear infinite;
            /* Safari */
            animation: spin 1s linear infinite;
        }

        /* Safari */
        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
            }

            100% {
                -webkit-transform: rotate(360deg);
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><i
                            class="fa fa-flag-o"></i>@lang('site.Change_Language')</a>
                    <ul class="dropdown-menu">
                        <li>
                            <ul class="menu">
                                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <li>
                                    <a class="nav-link" rel="alternate" hreflang="{{ $localeCode }}"
                                        href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                        {{ $properties['native'] }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </li>
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        {{-- <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown"> --}}
                            <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                {{-- {{ __('Logout') }} --}}@lang('site.logout')
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        {{-- </div> --}}
                    </li>
                @endguest
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('dashboard.home') }}" class="nav-link">@lang('site.dashboard')</a>
                </li>
            </ul>
            <!-- SEARCH FORM -->
            <form class="form-inline ml-3">
                <div class="input-group input-group-sm">
                    <input class="form-control form-control-navbar" type="search" placeholder="Search"
                        aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-navbar" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>

            <!-- Right navbar links -->
            <ul class="navbar-nav mr-auto-navbav">
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        <span class="badge badge-danger navbar-badge">3</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{url('/')}}/dashboardFiles/dist/img/user1-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 mr-3 img-circle">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Brad Diesel
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">Call me whenever you can...</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{url('/')}}/dashboardFiles/dist/img/user8-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        John Pierce
                                        <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">I got your message bro</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                <img src="{{url('/')}}/dashboardFiles/dist/img/user3-128x128.jpg" alt="User Avatar"
                                    class="img-size-50 img-circle mr-3">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Nora Silvester
                                        <span class="float-right text-sm text-warning"><i
                                                class="fas fa-star"></i></span>
                                    </h3>
                                    <p class="text-sm">The subject goes here</p>
                                    <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
                    </div>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">15</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">15 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 4 new messages
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 8 friend requests
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 3 new reports
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('layouts.dashboard._aside')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')

            @include('partials._session')

        </div>

        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.0.0-rc.1
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    {{-- @if (app()->getLocale() == 'ar')
    <!-- jQuery -->
    <script src="{{url('/')}}/dashboardFiles/plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{url('/')}}/dashboardFiles/plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    ckeditor standard
    <script src="{{ asset('dashboardFiles/plugins/ckeditor/ckeditor.js') }}"></script>
    <!-- Bootstrap 4 rtl -->
    <script src="https://cdn.rtlcss.com/bootstrap/v4.2.1/js/bootstrap.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{url('/')}}/dashboardFiles/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="{{url('/')}}/dashboardFiles/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="{{url('/')}}/dashboardFiles/plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="{{url('/')}}/dashboardFiles/plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="{{url('/')}}/dashboardFiles/plugins/jqvmap/maps/jquery.vmap.world.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{url('/')}}/dashboardFiles/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="{{url('/')}}/dashboardFiles/plugins/moment/moment.min.js"></script>
    <script src="{{url('/')}}/dashboardFiles/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{url('/')}}/dashboardFiles/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
    </script>
    <!-- Summernote -->
    <script src="{{url('/')}}/dashboardFiles/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{url('/')}}/dashboardFiles/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{url('/')}}/dashboardFiles/dist/js/adminlte.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{url('/')}}/dashboardFiles/dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{url('/')}}/dashboardFiles/dist/js/demo.js"></script>
    <script src="jquery.min.js"></script>
    @else --}}
    <!-- jQuery -->
    <script src="{{url('/')}}/dashboardFiles/pluginsLTR/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{url('/')}}/dashboardFiles/pluginsLTR/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    {{--ckeditor standard--}}
    <script src="{{ asset('dashboardFiles/pluginsLTR/ckeditor/ckeditor.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{url('/')}}/dashboardFiles/pluginsLTR/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="{{url('/')}}/dashboardFiles/pluginsLTR/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="{{url('/')}}/dashboardFiles/pluginsLTR/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="{{url('/')}}/dashboardFiles/pluginsLTR/jqvmap/jquery.vmap.min.js"></script>
    <script src="{{url('/')}}/dashboardFiles/pluginsLTR/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{url('/')}}/dashboardFiles/pluginsLTR/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="{{url('/')}}/dashboardFiles/pluginsLTR/moment/moment.min.js"></script>
    <script src="{{url('/')}}/dashboardFiles/pluginsLTR/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{url('/')}}/dashboardFiles/pluginsLTR/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
    </script>
    <!-- Summernote -->
    <script src="{{url('/')}}/dashboardFiles/pluginsLTR/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="{{url('/')}}/dashboardFiles/pluginsLTR/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{url('/')}}/dashboardFiles/distLTR/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{url('/')}}/dashboardFiles/distLTR/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{url('/')}}/dashboardFiles/distLTR/js/pages/dashboard.js"></script>
    <script src="jquery.min.js"></script>
    {{-- @endif --}}
    @jquery
    @toastr_js
    @toastr_render
    {{--custom js--}}
    <script src="{{url('/')}}/dashboardFiles/js/custom/image_preview.js"></script>
    <script src="{{url('/')}}/dashboardFiles/js/custom/order.js"></script>
    {{-- jquery number --}}
    <script src="{{url('/')}}/dashboardFiles/js/custom/jquery.number.min.js"></script>
    {{--print this--}}
    <script src="{{ asset('dashboardFiles/js/custom/printThis.js') }}"></script>
    <script>
        $(document).ready(function () {

            // $('.sidebar-menu').tree();

            //icheck
            // $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            //     checkboxClass: 'icheckbox_minimal-blue',
            //     radioClass: 'iradio_minimal-blue'
            // });

            //delete
            // $('.delete').click(function (e) {

            //     var that = $(this)

            //     e.preventDefault();

            //     var n = new Toast({
            //         text: "@lang('site.confirm_delete')",
            //         type: "warning",
            //         killer: true,
            //         buttons: [
            //             toastr.button("@lang('site.yes')", 'btn btn-success mr-2', function () {
            //                 that.closest('form').submit();
            //             }),

            //             toastr.button("@lang('site.no')", 'btn btn-primary mr-2', function () {
            //                 n.close();
            //             })
            //         ]
            //     });

            //     n.show();

            // });//end of delete

            // // image preview
            // $(".image").change(function () {

            //     if (this.files && this.files[0]) {
            //         var reader = new FileReader();

            //         reader.onload = function (e) {
            //             $('.image-preview').attr('src', e.target.result);
            //         }

            //         reader.readAsDataURL(this.files[0]);
            //     }

            // });

            CKEDITOR.config.language =  "{{ app()->getLocale() }}";

        });//end of ready

    </script>
</body>

</html>
