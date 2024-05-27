<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">
<head>
    <meta charset="utf-8" />
    <title>Sign up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('backend/assets/images/favicon.ico')}}">
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" defer/>

</head>

<body>

    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="index.html" class="d-inline-block auth-logo">
                                    <img src="{{asset('backend/assets/images/logo-light.png')}}" alt="" height="20">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-lg-10 col-md-8 col-lg-6 col-xl-8">
                        <div class="card mt-4 card-bg-fill">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Welcome Back !</h5>
                                    <p class="text-muted">Create New Account</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <!-- @if($errors->any())
                                      @foreach($errors->all() as $error)
                                         <p>{{ $error }}</p>
                                      @endforeach
                                    @endif
                                    @if(Session::has('error'))
                                        <p>{{ Session::get('error') }}</p>
                                    @endif
                                    @if(Session::has('success'))
                                        <p>{{ Session::get('success') }}</p>
                                    @endif -->
                                    <?php
                                      $services = \App\Models\Service::where('status',1)->orderBy('id','DESC')->get();
                                      $skills = \App\Models\Skill::where('status',1)->orderBy('id','DESC')->get();
                                    ?>
                                    <form action="{{route('astrologer.register_submit')}}" method="post" id="register-form" onsubmit="return validateForm()">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-6">
                                              <div class="mb-3">
                                                  <label for="username" class="form-label">Name</label>
                                                  <input type="text" class="form-control" id="username" name="name" placeholder="Enter name">
                                              </div>
                                            </div>
                                            <div class="col-lg-6">
                                               <div class="mb-3">
                                                    <label for="username" class="form-label">Email</label>
                                                    <input type="text" class="form-control" id="username" name="email" placeholder="Enter email">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                               <div class="mb-3">
                                                  <label class="form-label" for="password-input">Password</label>
                                                  <div class="position-relative auth-pass-inputgroup mb-3">
                                                      <input type="password" name="password" id="password" class="form-control pe-5 password-input" placeholder="Enter password">
                                                      <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon material-shadow-none" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                  </div>
                                                  <div id="password-error" class="invalid-feedback"></div>
                                              </div>
                                            </div>
                                            <div class="col-lg-6">
                                              <div class="mb-3">
                                                  <label class="form-label" for="password-input">Confirm Password</label>
                                                  <div class="position-relative auth-pass-inputgroup mb-3">
                                                      <input type="password" name="password_confirmation" id="confirm_password" class="form-control pe-5 password-input" placeholder="Confirm password">
                                                      <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon material-shadow-none" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                  </div>
                                                  <div id="confirm-password-error" class="invalid-feedback"></div>
                                              </div>
                                            </div>
                                            <div class="col-lg-6">
                                               <div class="mb-3">
                                                    <label for="username" class="form-label">Phone</label>
                                                    <input type="text" class="form-control" id="username" name="phone" placeholder="Enter phone no.">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Gender</label>
                                                    <select name="gender" class="form-control" id="">
                                                        <option value="Female">Female</option>
                                                        <option value="Male">Male</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                               <div class="mb-3">
                                                    <label for="username" class="form-label">Date of birth</label>
                                                    <input type="date" class="form-control" id="username" name="dob" placeholder="Enter phone no.">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Service Category</label>
                                                    <select name="serviceCategory" class="form-control" id="">
                                                        @foreach($services as $service)
                                                        <option value="{{$service->id}}">{{$service->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Skills</label>
                                                    <select name="skill[]" class="form-control select2 all" multiple
                                                     data-placeholder="Choose Your Skills">
                                                        @foreach($skills as $skill)
                                                        <option value="{{$skill->id}}">{{$skill->name}}</option>
                                                        @endforeach
                                                        <!-- Add more options if needed -->
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Add Charge(As per Minute)</label>
                                                    <input type="number" class="form-control" name="charge" placeholder="Enter your charge(As per Minute)">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Experience In Years</label>
                                                    <input type="text" class="form-control" name="experience" placeholder="Enter your charge(As per Minute)">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">How many hours you can contribute daily?</label>
                                                    <input type="text" class="form-control" name="dailyContribution" placeholder="How many hours you can contribute daily?">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Address</label>
                                                    <textarea class="form-control" name="address" placeholder="Enter your address"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">What are some good qualities of perfect astrologer?</label>
                                                    <textarea class="form-control" name="goodQuality" placeholder="What are some good qualities of perfect astrologer?"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">What was the biggest challenge you faced and how did you overcome it?</label>
                                                    <textarea class="form-control" name="biggestChallenge" placeholder="What was the biggest challenge you faced and how did you overcome it?"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">A customer is asking the same question repeatedly: what will you do?</label>
                                                    <textarea class="form-control" name="whatwillDo" placeholder="A customer is asking the same question repeatedly: what will you do?"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        

                                        
                                        
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="auth-remember-check">
                                            <label class="form-check-label" for="auth-remember-check">Remember me</label>
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit">Sign up</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->

                        <div class="mt-4 text-center">
                            <p class="mb-0">Already have an account ? <a href="{{route('astrologer.login')}}" class="fw-semibold text-primary text-decoration-underline"> Signin </a> </p>
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <p class="mb-0 text-muted">&copy;
                                <script>document.write(new Date().getFullYear())</script> Velzon. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesbrand
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->
    </div>
    <!-- end auth-page-wrapper -->

    <!-- JAVASCRIPT -->

To create multi-value select boxes using Select2, you can follow these steps:

Include Select2 Library: As before, include the Select2 library in your HTML. You can either download it and include it locally or use a CDN.
html
Copy code
<!-- Include Select2 CSS -->

<!-- Include jQuery -->
<!-- Include jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
    <script>
        // Ensure jQuery is loaded before executing this script
        $(document).ready(function() {
            // Ensure Select2 is loaded before executing this script
            if ($.fn.select2) {
                $('.select2').select2();
            } else {
                console.error('Select2 is not loaded properly.');
            }
        });
    </script>
    <script src="{{asset('backend/assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('backend/assets/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{asset('backend/assets/libs/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
    <script src="{{asset('backend/assets/js/plugins.js')}}"></script>

    <!-- particles js -->
    <script src="{{asset('backend/assets/libs/particles.js/particles.js')}}"></script>
    <!-- particles app js -->
    <script src="{{asset('backend/assets/js/pages/particles.app.js')}}"></script>
    <!-- password-addon init -->
    <script src="{{asset('backend/assets/js/pages/password-addon.init.js')}}"></script>


    <script>

    function validateForm() {
        let password = document.getElementById('password').value;
        let confirm_password = document.getElementById('confirm_password').value;

        if (password !== confirm_password) {
            document.getElementById('password-error').innerText = 'Passwords do not match';
            document.getElementById('confirm-password-error').innerText = 'Passwords do not match';
            document.getElementById('password-error').style.display = 'block'; // Display error message
            document.getElementById('confirm-password-error').style.display = 'block'; // Display error message
            return false;
        } else {
            document.getElementById('password-error').innerText = '';
            document.getElementById('confirm-password-error').innerText = '';
            document.getElementById('password-error').style.display = 'none'; // Hide error message
            document.getElementById('confirm-password-error').style.display = 'none'; // Hide error message
            return true;
        }
    }
</script>

</body>
</html>
