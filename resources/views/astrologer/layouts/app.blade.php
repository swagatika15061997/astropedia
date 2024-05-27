<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">
<head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user-id" content="{{ Auth::id() }}">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('backend/assets/images/favicon.ico')}}">
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
    @stack('css_or_js')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script> -->
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>

    Pusher.logToConsole = true;

    var pusher = new Pusher('8f11cb635d4cb5037966', {
      cluster: 'ap2'
    });

    var channel = pusher.subscribe('popup-channel');
    channel.bind('user-registered_{{auth('astrologer')->user()->id}}', function(data) {
      // alert(JSON.stringify(data));
      var audio = new Audio("{{ asset('backend/assets/sound/notification.mp3') }}");
      // Play the audio
      audio.onerror = function() {
        console.error("Audio file could not be loaded.");
      };

      // Play the audio
      audio.play().catch(function(error) {
        console.error("Audio playback failed: ", error);
      });

      // Insert the dynamic content
      document.getElementById('modalBodyContent').innerText = data.name + ' sent you a chat request.';
      
      // Show the modal
      $('#chatRequestModal').modal('show');
      $('#notification-container').load(location.href + ' #notification-container');
    });
  </script>
</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">
       @include('astrologer.layouts.back-end.header')
       @include('astrologer.layouts.back-end.side-bar') 
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            @yield('content')
            <!-- End Page-content -->

            @include('astrologer.layouts.back-end.footer')     
            <!-- modal -->
            <div class="modal fade" id="chatRequestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New Chat Request</h5>
         
        </div>
        <div class="modal-body" id="modalBodyContent">
          <!-- Dynamic content will be inserted here -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal"><a class="text-white" href="{{route('astrologer.chat.chat-requests')}}">View</a></button>
        </div>
      </div>
    </div>
  </div>
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
        document.addEventListener('DOMContentLoaded', function() {
    const userId = document.querySelector('meta[name="user-id"]').getAttribute('content');

    window.Echo.private('astrologer.' + userId)
        .notification((notification) => {
            appendNotificationToUI(notification);
            new Audio({{asset('backend/assets/sound/notification.mp3')}}).play(); // Play a sound
        });
});

function appendNotificationToUI(notification) {
    const notificationsWrapper = document.getElementById('layout-wrapper'); // Update with your actual wrapper ID

    const notificationItem = `
        <div class="text-reset notification-item d-block dropdown-item">
            <div class="d-flex">
                <img onerror="this.src='{{asset('backend/assets/images/demo/def.jpg')}}'" src="{{asset('images/profile/${notification.user_image}')}}" class="me-3 rounded-circle avatar-xs" alt="user-pic">
                <div class="flex-grow-1">
                    <a href="#!" class="stretched-link">
                        <h6 class="mt-0 mb-1 fs-13 fw-semibold">${notification.user_name}</h6>
                    </a>
                    <div class="fs-13 text-muted">
                        <p class="mb-1">${notification.message}</p>
                    </div>
                    <p class="mb-0 fs-11 fw-medium text-uppercase text-muted">
                        <span><i class="mdi mdi-clock-outline"></i> Just now</span>
                    </p>
                </div>
                <div class="px-2 fs-15">
                    <div class="form-check notification-check">
                        <input class="form-check-input" type="checkbox" value="" id="messages-notification-check">
                        <label class="form-check-label" for="messages-notification-check"></label>
                    </div>
                </div>
            </div>
        </div>
    `;

    notificationsWrapper.insertAdjacentHTML('afterbegin', notificationItem);
}
    </script>
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
  @if(Session::has('errors'))  
    @foreach($errors->all() as $error)
        toastr.error("{{ $error }}");
    @endforeach
        // toastr.error("{{ Session::get('error') }}");  
  @endif  
    </script>
</body>
</html>

