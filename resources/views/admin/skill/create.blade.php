@extends('admin.layouts.app')

@section('title','Skill')

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
                        <h4 class="mb-sm-0">Skill</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('admin_dashboard')}}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Skill</li>
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
                              @if(session('success'))
                                 <div class="alert alert-success">{{ session('success') }}</div>
                              @endif
                                <form action="{{ route('category.update', $category->id) }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row gy-4">
                                        <div class="col-xxl-12 col-md-12">
                                            <div>
                                                <label for="basiInput" class="form-label">Category Name</label>
                                                <input type="text" class="form-control" id="basiInput" name="name" placeholder="Enter category name" value="{{$category->name}}">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-lg-12">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="submit" class="btn btn-primary">update</button>
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