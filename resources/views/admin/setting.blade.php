@extends('admin.layouts.app')

@section('title','settings')

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
     <!-- Filepond css -->
     
@endpush
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Settings</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Settings</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Add values</h4>   
                        </div><!-- end card header -->
                        <div class="card-body">
                            <div class="live-preview">
                                <form action="{{route('setting_save')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row gy-4">
                                        <div class="col-xxl-4 col-md-4">
                                            <div>
                                                <label for="basiInput" class="form-label">Company Name</label>
                                                <input type="text" class="form-control" id="basiInput" name="company_name" placeholder="Enter company name" value="{{ old('company_name', $settings->company_name) }}">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-4 col-md-4">
                                            <div>
                                                <label for="labelInput" class="form-label">Phone</label>
                                                <input type="text" class="form-control" id="labelInput" name="phone" placeholder="Enter phone no." value="{{ old('phone', $settings->phone) }}">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-4 col-md-4">
                                            <div>
                                                <label for="placeholderInput" class="form-label">Email</label>
                                                <div class="form-icon">
                                                    <input type="email" class="form-control form-control-icon" id="iconInput" name="email" placeholder="Enter email address" value="{{ old('email', $settings->email) }}">
                                                    <i class="ri-mail-unread-line"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-12 col-md-12">
                                            <div>
                                                <label for="exampleFormControlTextarea5" class="form-label">Company Address</label>
                                                <textarea class="form-control" id="exampleFormControlTextarea5" rows="3" name="company_address">{{ old('company_address', $settings->company_address) }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-md-4">
                                            <div>
                                                <label for="valueInput" class="form-label">Header Logo</label>
                                                <input type="file" name="header_logo" id="logo" class="form-control" accept="image/*">
                                                <img id="logo-preview" src="{{asset('images/setting/'.$settings->header_logo) }}" onerror="this.src='{{asset('backend/assets/images/demo/def.jpg')}}'" alt="Logo Preview" style="max-width: 100px; margin-top: 10px;">
                                                
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-md-4">
                                            <div>
                                                <label for="valueInput" class="form-label">Footer Logo</label><br>
                                                <input type="file" name="footer_logo" id="footer-logo" class="form-control" accept="image/*">
                                                <img id="footer-logo-preview" src="{{asset('images/setting/'.$settings->footer_logo) }}" onerror="this.src='{{asset('backend/assets/images/demo/def.jpg')}}'"  alt="Logo Preview" style="max-width: 100px; margin-top: 10px;">
                                            </div>
                                        </div>
                                        <div class="col-xxl-4 col-md-4">
                                            <div>
                                                <label for="valueInput" class="form-label">Favicon</label><br>
                                                <input type="file" name="favicon" id="favicon-logo" class="form-control" accept="image/*">
                                                <img id="favicon-preview" src="{{asset('images/setting/'.$settings->favicon) }}" onerror="this.src='{{asset('backend/assets/images/demo/def.jpg')}}'" alt="Logo Preview" style="max-width: 100px; margin-top: 10px;">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-12 col-md-12">
                                            <div>
                                                <label for="labelInput" class="form-label">Commission</label>
                                                <input type="text" class="form-control" id="labelInput" name="commission" placeholder="Enter commission percentage" value="{{ old('commission', $settings->commission) }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                    <button type="button" class="btn btn-soft-success">Cancel</button>
                                                </div>
                                        </div>
                                        <!--end col-->   
                                    </div>
                                </form>    
                                <!--end row-->
                            </div>
                        </div>    
                    </div>
                </div>    
            </div>
            <!--end row-->
        </div> <!-- container-fluid -->
    </div><!-- End Page-content -->
    
@endsection
@push('script')
<script>
        // Preview image before uploading
        document.getElementById('logo').onchange = function (event) {
            var reader = new FileReader();
            reader.onload = function(){
                var output = document.getElementById('logo-preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        };
        document.getElementById('footer-logo').onchange = function (event) {
            var reader1 = new FileReader();
            reader1.onload = function(){
                var output1 = document.getElementById('footer-logo-preview');
                output1.src = reader1.result;
            };
            reader1.readAsDataURL(event.target.files[0]);
        };
        document.getElementById('favicon-logo').onchange = function (event) {
            var reader2 = new FileReader();
            reader2.onload = function(){
                var output2 = document.getElementById('favicon-preview');
                output2.src = reader2.result;
            };
            reader2.readAsDataURL(event.target.files[0]);
        };
    </script>
@endpush