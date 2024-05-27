@extends('admin.layouts.app')
@section('title','Horoscope')
@push('css_or_js')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .horo {
    overflow-y: auto;
    height: 82vh;
}
</style>
@endpush
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                        <h4 class="mb-sm-0">Horoscope</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Horoscope</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card" id="orderList">
                        <div class="card-header border-0">
                            <div class="row align-items-center gy-3">
                                <div class="col-lg-6">
                                  @if (count($horoscope) > 0)
                                    <div class="d-flex gap-1 flex-wrap">
                                        <a href="{{ route('horoscope.edit', ['zodiacSignId' => $selectedId]) }}"><button type="button" class="btn btn-success add-btn" id="create-btn"><i class="ri-pencil-fill align-bottom me-1"></i>Edit</button></a>
                                        <a  data-bs-toggle="modal" href="#deleteRecordModal"><button type="button" class="btn btn-info"><i class="ri-delete-bin-2-line align-bottom me-1"></i> Delete</button></a>
                                        <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
                                           <div class="modal-dialog modal-dialog-centered">
                                               <div class="modal-content">
                                                   <div class="modal-header">
                                                       <button type="button" class="btn-close" id="deleteRecord-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                                                   </div>
                                                   <div class="modal-body">
                                                       <div class="mt-2 text-center">
                                                           <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                                                           <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                                               <h4>Are you sure ?</h4>
                                                               <p class="text-muted mx-4 mb-0">Are you sure you want to remove this record ?</p>
                                                           </div>
                                                       </div>
                                                       <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                                                           <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                                                           <form action="{{ route('horoscope.destroy') }}" method="POST">
                                                               @csrf
                                                               @method('DELETE')
                                                               <input type="hidden" id="del_id" name="del_id" value="{{$selectedId}}">
                                                               <button type="submit" class="btn w-sm btn-danger" id="delete-record">Yes, Delete It!</button>
                                                            </form>
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                                        </div>
                                    </div>
                                  @endif
                                </div>
                                <div class="col-lg-3">
                                    <div class="d-flex gap-1 flex-wrap">
                                        <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i>Add Horoscope</button>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    
                                <form action="{{ route('horoscope.view') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-xxl-6 col-lg-6 col-sm-2">
                                        <div>
                                            <select class="form-select" name="filterSign" data-choices data-choices-search-false name="choices-single-default" id="idStatus">
                                              @foreach ($signs as $sign)
                                                  <option id="signId" @if ($sign['id'] == $selectedId) selected @endif value={{ $sign['id'] }}>
                                                      {{ $sign['name'] }}</option>
                                              @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    
                                    <!--end col-->
                                    <div class="col-xxl-6 col-lg-6 col-sm-2">
                                        <div>
                                            <button type="submit" class="btn btn-primary w-100"> <i class="ri-equalizer-fill me-1 align-bottom"></i>
                                                Filters
                                            </button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    
                                </div>
                                <!--end row-->
                            </form>
                                </div>
                            </div>
                        </div>
                        <div class="container">

                            <div class="row">
                                @foreach ($horoscope as $horo)
                                    <div class="col-xxl-12 col-lg-12">
                                        
                                        <div class="card border p-5 mt-5">
                                            <h3>{{ $horo->horoscopeType }}</h3>
                                            <h4 class="card-title">{{ $horo->title }}</h4>
                                            <p class="card-text text-muted">{!! $horo->description !!}</p>
                                        </div>
                                    </div><!-- end col -->
                                @endforeach
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            
                        <div class="modal fade zoomIn" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content border-0 horo">
                                <div class="modal-header p-3 bg-info-subtle">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Horoscope</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                </div>
                                <form method="POST" action="{{route('horoscope.store')}}" class="tablelist-form" autocomplete="off">
                                    @csrf
                                    <div class="modal-body">
                                        <input type="hidden" id="tasksId" />
                                        <div class="row g-3">
                                            <div class="col-lg-12">
                                                <label for="ticket-status" class="form-label">Zodiac Sign</label>
                                                <select class="form-select mb-3" id="ticket-status" name="zodiacSignId">
                                                   <option disabled selected>--Select Sign--</option>
                                                   @foreach ($signs as $sign)
                                                   <option id="productCategoryId" value={{ $sign['id'] }}>
                                                      {{ $sign['name'] }}
                                                   </option>
                                                   @endforeach
                                                </select>
                                            </div>
                                            <!--end col-->
                                            <h4>Weekly</h4>
                                            <div class="col-lg-12">
                                                <div>
                                                    <input type="text" id="tasksTitle-field" name="title" class="form-control" placeholder="Title" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div>
                                                    <textarea name="weeklydesc" id="" class="form-control ckeditor" cols="20" rows="10"></textarea>
                                                </div>
                                            </div>
                                            <h4>Monthly</h4>
                                            <div class="col-lg-12">
                                                <div>
                                                    <input type="text" id="tasksTitle-field" class="form-control" name="monthlytitle" placeholder="Title" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div>
                                                    <textarea name="monthlydesc" id="" class="form-control ckeditor" cols="20" rows="10"></textarea>
                                                </div>
                                            </div>
                                            <h4>Yearly</h4>
                                            <div class="col-lg-12">
                                                <div>
                                                    <input type="text" id="tasksTitle-field" class="form-control" name="yearlytitle" placeholder="Title" required />
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div>
                                                    <textarea name="yearlydesc" id="" class="form-control ckeditor" cols="20" rows="10"></textarea>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <!--end row-->
                                    </div>
                                    <div class="modal-footer">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="button" class="btn btn-light" id="close-modal" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success" id="add-btn">Save</button>
                                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update Task</button> -->
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!--end modal-->
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->
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

