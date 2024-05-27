@extends('admin.layouts.app')
@section('title','Horoscope')
@push('css_or_js')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endpush
@section('content')
<div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                                <h4 class="mb-sm-0">Edit horoscope</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Edit Horoscope</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                  <form method="POST" action="{{route('horoscope.update')}}" class="tablelist-form" autocomplete="off">
                                    @csrf
                                    <div class="col-lg-12">
                                        <label for="ticket-status" class="form-label">Zodiac Sign</label>
                                        <select class="form-select mb-3" id="ticket-status" name="zodiacSignId">
                                           <option disabled selected>--Select Sign--</option>
                                           @foreach ($signs as $sign)
                                                <option {{ $zodiacSignId == $sign->id ? 'selected' : '' }}
                                                    id="productCategoryId" value={{ $sign->id }}>
                                                    {{ $sign->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <!--end col-->
                                    <h4>Weekly</h4>
                                    <div class="col-lg-12">
                                        <div>
                                            <input type="hidden" name="oldSignId" value={{$zodiacSignId}}>
                                            <input type="text" id="tasksTitle-field" name="title" class="form-control" placeholder="Title" value="{{ $horo['weeklytitle'] }}" required />
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-lg-12">
                                        <div>
                                            <textarea name="weeklydesc" id="" class="form-control ckeditor" cols="20" rows="10">{{ $horo['weeklydesc'] }}</textarea>
                                        </div>
                                    </div>
                                    <h4>Monthly</h4>
                                    <div class="col-lg-12">
                                        <div>
                                            <input type="text" id="tasksTitle-field" class="form-control" name="monthlytitle" placeholder="Title" value="{{ $horo['monthlytitle'] }}" required />
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-lg-12">
                                        <div>
                                            <textarea name="monthlydesc" id="" class="form-control ckeditor" cols="20" rows="10">{{ $horo['monthlydesc'] }}</textarea>
                                        </div>
                                    </div>
                                    <h4>Yearly</h4>
                                    <div class="col-lg-12">
                                        <div>
                                            <input type="text" id="tasksTitle-field" class="form-control" name="yearlytitle" placeholder="Title" value="{{ $horo['yearlytitle'] }}" required />
                                        </div>
                                    </div>
                                    <br>
                                    <div class="col-lg-12">
                                        <div>
                                            <textarea name="yearlydesc" id="" class="form-control ckeditor" cols="20" rows="10">{{ $horo['yearlydesc'] }}</textarea>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="text-end mb-4">
                                        <button type="submit" class="btn btn-success w-sm">Update</button>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            
                            <!-- end card -->
                            
                        </div>
                        <!-- end col -->
                        
                    </div>
                    <!-- end row -->

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content --> 
@endsection
@push('script')
<script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
    <script>
      CKEDITOR.replace('editor', {
      skin: 'moono',
      enterMode: CKEDITOR.ENTER_BR,
      shiftEnterMode:CKEDITOR.ENTER_P,
      toolbar: [{ name: 'basicstyles', groups: [ 'basicstyles' ], items: [ 'Bold', 'Italic', 'Underline', "-", 'TextColor', 'BGColor' ] },
                 { name: 'styles', items: [ 'Format', 'Font', 'FontSize' ] },
             { name: 'scripts', items: [ 'Subscript', 'Superscript' ] },
             { name: 'justify', groups: [ 'blocks', 'align' ], items: [ 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
             { name: 'paragraph', groups: [ 'list', 'indent' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent'] },
             { name: 'links', items: [ 'Link', 'Unlink' ] },
             { name: 'insert', items: [ 'Image'] },
             { name: 'spell', items: [ 'jQuerySpellChecker' ] },
             { name: 'table', items: [ 'Table' ] }
             ],
         });
    </script>
@endpush

