@extends('admin.layouts.app')
@section('title','Daily Horoscope')
@push('css_or_js')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .horo {
    overflow-y: auto;
    height: 82vh;
}
.inline-item {
    display: inline-block !important;
    margin: 8px;
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
                        <h4 class="mb-sm-0">Daily Horoscope</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Daily Horoscope</li>
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
                                <div class="col-lg-3">
                                   @if (count($dailyHoroscope) > 0 || count($dailyHoroscopeStatics) > 0)
                                    <div class="d-flex gap-1 flex-wrap">
                                        <a href="{{ route('horoscope.edit_daily', ['zodiacSignId' => $selectedId, 'horoscopeDate' => $filterDate]) }}"><button type="button" class="btn btn-success add-btn" id="create-btn"><i class="ri-pencil-fill align-bottom me-1"></i>Edit</button></a>
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
                                                           <form action="{{ route('horoscope.destroy-daily') }}" method="POST">
                                                               @csrf
                                                               @method('DELETE')
                                                               <input type="hidden" id="del_id" name="del_id" value="{{$selectedId}}">
                                                               <input type="hidden" id="horoscope_date" name="horoscope_date" value="{{$filterDate}}">
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
                                        <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i>Add Daily Horoscope</button>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                  <form action="{{ route('horoscope.dailyHoroscope') }}" method="POST" enctype="multipart/form-data">
                                   @csrf
                                    <div class="row g-3">
                                        <div class="col-xxl-4 col-lg-4 col-sm-2">
                                            <div>
                                            <input type="date" id="filterDate" name="filterDate" class="datepicker form-control pl-12"
                                                data-single-mode="true" value={{ $filterDate }}>
                                                
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-xxl-4 col-lg-4 col-sm-2">
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
                                        <div class="col-xxl-4 col-lg-4 col-sm-2">
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
                                 <div class="col-xxl-12 col-lg-12">
                                   @if (count($dailyHoroscopeStatics) > 0)
                                   <div class="col-lg-12">
                                      <div class="card border p-5 mt-5">
                                        <div class="row">
                                        <div class="col-lg-2">
                                            <h6><b> Lucky Colour</b></h6>
                                            <h6
                                                style="background-color:{{ $dailyHoroscopeStatics[0]->luckyColor }};color:{{ $dailyHoroscopeStatics[0]->luckyColor }}
                                                ">
                                                {{ $dailyHoroscopeStatics[0]->luckyColor }}
                                            </h6>
                                        </div>
                                        <div class="col-lg-2">
                                            <h6><b> Lucky Time</b></h6>
                                            <h6>{{ $dailyHoroscopeStatics[0]->luckyTime }}</h6>
                                        </div>
                                        <div class="col-lg-2">
                                            <h6><b> Lucky Number</b></h6>
                                            <h6>{{ $dailyHoroscopeStatics[0]->luckyNumber }}</h6>
                                        </div>
                                        </div>
                                      </div>
                                    </div>

                                   @endif
    
                                <div class="grid-cols-12 mt-5 daily" style="width:100%">
                                    @foreach ($dailyHoroscope as $horoscope)
                                        <div class="card border p-5 mt-5">
                                            <h2 style="font-size: 20px;font-weight:600;display:inline-block">
                                                {{ $horoscope->category }}({{ $horoscope->percentage }}%)
                                            </h2>
                                            <h6 class="mt-2">{!! $horoscope->description !!}</h6>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div><!-- end col -->
                        
                        <div class="card-body pt-0">   
                          <div class="modal fade zoomIn" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                             <div class="modal-dialog modal-dialog-centered modal-lg">
                                 <div class="modal-content border-0 horo">
                                     <div class="modal-header p-3 bg-info-subtle">
                                         <h5 class="modal-title" id="exampleModalLabel">Add Daily Horoscope</h5>
                                         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                     </div>
                                     <form method="POST" action="{{route('horoscope.store_daily')}}" class="tablelist-form" autocomplete="off">
                                         @csrf
                                         <div class="modal-body">
                                             <input type="hidden" id="tasksId" />
                                             <div class="row g-3">
                                                 <div class="col-lg-6">
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
                                                 <div class="col-lg-6">
                                                <label for="ticket-status" class="form-label">Horoscope Date</label>
                                                <input type="date" class="form-control" name="horoscopeDate">
                                                 </div>
                                                 <div class="col-lg-4">
                                                <label for="ticket-status" class="form-label">Lucky Time</label>
                                                <input type="time" class="form-control" name="luckyTime">
                                                 </div>
                                                 <div class="col-lg-4">
                                                <label for="ticket-status" class="form-label">Lucky Number</label>
                                                <input type="number" class="form-control" name="luckyNumber">
                                                 </div>
                                                 <div class="col-lg-4">
                                                <label for="ticket-status" class="form-label">Lucky Color</label>
                                                <input type="color" class="form-control" name="luckyColour">
                                                 </div>
                                                 <div class="col-lg-12">
                                                <div class="inline-item" style="font-size:20px;">
                                                  <label for="ticket-status" class="form-label">Love</label>
                                                </div>
                                                <div class="inline-item" style="float: right;">
                                                 <input type="text" id="lovepercent" name="lovepercent" class="form-control"
                                                 placeholder="Percentage(%)" aria-describedby="input-group-3"
                                                  onKeyDown="numbersOnly(event)" required>
                                                </div>
                                                <br>
                                                <textarea id="" cols="20" rows="10"  class="form-control ckeditor" name="lovedesc" required></textarea>
                                            </div>
                                            <div class="col-lg-12">
                                              <div class="inline-item" style="font-size:20px;">
                                                <label for="ticket-status" class="form-label">Career</label>
                                              </div>
                                              <div class="inline-item" style="float: right;">
                                                <input type="text" id="careerpercent" name="careerpercent" class="form-control"
                                                 placeholder="Percentage(%)" aria-describedby="input-group-3"
                                                 onKeyDown="numbersOnly(event)"  required>
                                              </div>
                                              <br>
                                                <textarea id="" cols="20" rows="10" class="form-control ckeditor" name="careerdesc" required></textarea>
                                            </div>
                                            <div class="col-lg-12">
                                              <div class="inline-item" style="font-size:20px;">
                                                <label for="ticket-status" class="form-label">Travel</label>
                                              </div>
                                              <div class="inline-item" style="float: right;">
                                                <input type="text" id="travelpercent" name="travelpercent" class="form-control"
                                                placeholder="Percentage(%)" aria-describedby="input-group-3"
                                                onKeyDown="numbersOnly(event)"  required>
                                              </div>
                                              <br>
                                                <textarea id="" cols="20" rows="10" class="form-control ckeditor" name="traveldesc" required></textarea>
                                            </div>
                                            <div class="col-lg-12">
                                              <div class="inline-item" style="font-size:20px;">
                                                <label for="ticket-status" class="form-label">Health</label>
                                              </div>
                                              <div class="inline-item" style="float: right;">
                                                <input type="text" id="healthpercent" name="healthpercent" class="form-control"
                                                 placeholder="Percentage(%)" aria-describedby="input-group-3"
                                                 onKeyDown="numbersOnly(event)" required>
                                              </div>
                                              <br>
                                                <textarea id="" cols="20" rows="10" class="form-control ckeditor" name="healthdesc" required></textarea>
                                            </div>
                                            <div class="col-lg-12">
                                              <div class="inline-item" style="font-size:20px;">
                                                <label for="ticket-status" class="form-label">Money</label>
                                              </div>
                                              <div class="inline-item" style="float: right;">
                                                <input type="text" id="moneypercent" name="moneypercent" class="form-control"
                                                 placeholder="Percentage(%)" aria-describedby="input-group-3"
                                                 onKeyDown="numbersOnly(event)" required>
                                              </div>
                                              <br>
                                                <textarea id="" cols="20" rows="10" class="form-control ckeditor" name="moneydesc" required></textarea>
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

