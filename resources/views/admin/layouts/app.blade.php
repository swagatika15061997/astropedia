<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">
<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('backend/assets/images/favicon.ico')}}">
    @stack('css_or_js')
    <!-- Sweet Alert css-->
    <link href="{{asset('backend/assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- jsvectormap css -->
    <link href="{{asset('backend/assets/libs/jsvectormap/css/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />

    <!--Swiper slider css-->
    <link href="{{asset('backend/assets/libs/swiper/swiper-bundle.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Layout config Js -->
    <script src="{{asset('backend/assets/js/layout.js')}}"></script>
    <!-- Bootstrap Css -->
    <link href="{{asset('backend/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('backend/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('backend/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="{{asset('backend/assets/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">
       @include('admin.layouts.back-end.header')
       @include('admin.layouts.back-end.side-bar') 
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            @yield('content')
            <!-- End Page-content -->

            @include('admin.layouts.back-end.footer')     
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>


    <!-- JAVASCRIPT -->
    <script src="{{asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('backend/assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('backend/assets/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{asset('backend/assets/libs/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
    <script src="{{asset('backend/assets/js/plugins.js')}}"></script>
    <!-- apexcharts -->
    <script src="{{asset('backend/assets/libs/apexcharts/apexcharts.min.js')}}"></script>
    <!-- Vector map-->
    <script src="{{asset('backend/assets/libs/jsvectormap/js/jsvectormap.min.js')}}"></script>
    <script src="{{asset('backend/assets/libs/jsvectormap/maps/world-merc.js')}}"></script>
    <!--Swiper slider js-->
    <script src="{{asset('backend/assets/libs/swiper/swiper-bundle.min.js')}}"></script>
    <!-- Dashboard init -->
    <script src="{{asset('backend/assets/js/pages/dashboard-ecommerce.init.js')}}"></script>
    <!-- App js -->
    <script src="{{asset('backend/assets/js/app.js')}}"></script>
    <script src="{{asset('backend/assets/js/pages/profile-setting.init.js')}}"></script>
    <!-- list.js min js -->
    <script src="{{asset('backend/assets/libs/list.js/list.min.js')}}"></script>
    <script src="{{asset('backend/assets/libs/list.pagination.js/list.pagination.min.js')}}"></script>
    <!--ecommerce-customer init js -->
    <script src="{{asset('backend/assets/js/pages/ecommerce-customer-list.init.js')}}"></script>
    <!-- Sweet Alerts js -->
    <script src="{{asset('backend/assets/libs/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    @stack('script')
    <script>
       @if(Session::has('success'))  
        toastr.success("{{ Session::get('success') }}");  
       @endif  
       @if(Session::has('info'))  
             toastr.info("{{ Session::get('info') }}");  
       @endif  
       @if(Session::has('warning'))  
             toastr.warning("{{ Session::get('warning') }}");  
       @endif
       @if(Session::has('error'))  
        toastr.error("{{ Session::get('error') }}");  
       @endif   
       @if(Session::has('errors'))  
         @foreach($errors->all() as $error)
             toastr.error("{{ $error }}");
         @endforeach
             // toastr.error("{{ Session::get('error') }}");  
       @endif  
    </script>
</body>
</html>

