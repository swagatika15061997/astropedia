<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- stylesheet -->
    @stack('css_or_js')
    <link rel="stylesheet" href="{{asset('frontend/assets/css/bootstrap.css')}}">
    <link href="{{asset('frontend/assets/css/font.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/js/plugin/slick/slick.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/js/plugin/select2/select2.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/js/plugin/airdatepicker/datepicker.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/assets/css/style.css')}}"/>
    <!-- favicon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="shortcut icon" href="{{asset('frontend/assets/images/favicon.png')}}" type="image/x-icon">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">

</head>
<body>
    <div class="as_loader">
        <img src="{{asset('frontend/assets/images/loader.png')}}" alt="" class="img-responsive">
    </div> 
    <div class="as_main_wrapper">
        @include('layouts.frontend.partial.header')
        @yield('content')
        @include('layouts.frontend.partial.footer')
          
        
        
    </div>
    

    <!-- Modal -->
    <div id="as_login" class="modal fade" role="dialog">
        <div class="modal-dialog">
    
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Login</h4>
                </div>
                <div class="modal-body">
                    <div class="as_login_box active">
                        <form action="#">
                            <div class="form-group">
                                <input type="text" name="" placeholder="Enter email" class="form-control" id="">
                            </div>
                            <div class="form-group">
                                <input type="text" name="" placeholder="Enter password here" class="form-control" id="">
                            </div>
                            <div class="form-group">
                                <div class="as_login_data">
                                    <label>Remember me
                                         <input type="checkbox" name="as_remember_me" value="">
                                         <span class="checkmark"></span>
                                    </label>
                                    <a href="#">Forgot password ?</a>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="javascript:;" class="as_btn">login</a>
                            </div>
                        </form>
                        <p class="text-center as_margin0 as_padderTop20">Create An Account ? <a href="javascript:;" class="as_orange as_signup">SignUp</a></p>
                    </div>
                    <div class="as_signup_box">
                        <form action="#">
                            <div class="form-group">
                                <input type="text" name="" placeholder="Enter name" class="form-control" id="">
                            </div>
                            <div class="form-group">
                                <input type="text" name="" placeholder="Enter email" class="form-control" id="">
                            </div>
                            <div class="form-group">
                                <input type="text" name="" placeholder="Enter password here" class="form-control" id="">
                            </div>
                            <div class="form-group">
                                <input type="text" name="" placeholder="Enter mobile number" class="form-control" id="">
                            </div>
                            <div class="form-group">
                                <select name="" class="form-control" id="">
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                            <div class="text-center">
                                <a href="javascript:;" class="as_btn">Sign Up</a>
                            </div>
                        </form>
                        <p class="text-center as_margin0 as_padderTop20">Have An Account ? <a href="javascript:;" class="as_orange as_login">Login</a></p>
                    </div> 
                </div>
            </div>
    
        </div>
    </div>

    <!-- javascript -->
    <script src="{{asset('frontend/assets/js/jquery.js')}}"></script>
    <script src="{{asset('frontend/assets/js/bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/assets/js/plugin/slick/slick.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/assets/js/plugin/select2/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/assets/js/plugin/countto/jquery.countTo.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/assets/js/plugin/airdatepicker/datepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/assets/js/plugin/airdatepicker/i18n/datepicker.en.js')}}"></script>
    <script src="{{asset('frontend/assets/js/custom.js')}}"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

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
    </script>
<script>
    $(".update-cart").change(function (e) {
        e.preventDefault();
  
        var ele = $(this);
  
        $.ajax({
            url: '{{ route('update.cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}', 
                id: ele.parents("tr").attr("data-id"), 
                quantity: ele.parents("tr").find(".quantity").val()
            },
            success: function (response) {
               window.location.reload();
            }
        });
    });

    // Event delegation for "Remove" button click
    $(".remove-from-cart").click(function (e) {
        e.preventDefault();
  
        var ele = $(this);
  
        if(confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ route('remove.from.cart') }}',
                method: "DELETE",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("li").attr("data-id")
                    
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });

    $(".remove-cart-item").click(function (e) {
        e.preventDefault();
  
        var ele = $(this);
  
        if(confirm("Are you sure want to remove?")) {
            $.ajax({
                url: '{{ route('remove.cart') }}',
                method: "GET",
                data: {
                    _token: '{{ csrf_token() }}', 
                    id: ele.parents("li").attr("data-id")
                    
                },
                success: function (response) {
                    window.location.reload();
                }
            });
        }
    });
</script>
<!-- Include Axios and SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function showNotification(message) {
                Swal.fire({
                    title: 'Notification',
                    text: message,
                    icon: 'info',
                    confirmButtonText: 'OK'
                });
            }

            function fetchNotifications() {
                axios.get('/schedulling-notifications')
                    .then(function(response) {
                        response.data.forEach(notification => {
                            showNotification(notification.message);
                        });
                    })
                    .catch(function(error) {
                        console.error('Error fetching notifications:', error);
                    });
            }

            // Poll the server every 1 minute (60000 ms)
            setInterval(fetchNotifications, 60000);

            // Fetch notifications on page load
            fetchNotifications();
        });
    </script>
</body>
</html>