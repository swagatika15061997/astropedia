@extends('admin.layouts.app')
@section('title','Horoscope')
@push('css_or_js')
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
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
                                <h4 class="mb-sm-0">Edit Daily Horoscope</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Edit Daily Horoscope</li>
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
                                  <form method="POST" action="{{route('horoscope.update_daily')}}" class="tablelist-form" autocomplete="off">
                                    @csrf
                                        <div class="row">
                                           <div class="col-lg-6">
                                                <label for="ticket-status" class="form-label">Zodiac Sign</label>
                                                <select class="form-select mb-3" id="ticket-status" name="zodiacSignId" value="{{ $zodiacSignId }}">
                                                   <option disabled selected>--Select Sign--</option>
                                                   @foreach ($signs as $sign)
                                                    <option {{ $zodiacSignId == $sign->id ? 'selected' : '' }}
                                                    id="productCategoryId" value={{ $sign->id }}>
                                                    {{ $sign->name }}</option>
                                                   @endforeach
                                                </select>
                                            </div>
                                            <div class="col-lg-6">
                                                <label for="ticket-status" class="form-label">Horoscope Date</label>
                                                <input type="hidden" value={{ $zodiacSignId }} name="oldSignId">
                                                <input type="hidden" value={{ $horoscopeDate }} name="oldHoroDate">
                                                <input type="date" id="horoscopeDate" name="horoscopeDate"
                                                  class="form-control" placeholder="horoscopeDate"
                                                  aria-describedby="input-group-3"
                                                  value="{{ date('Y-m-d', strtotime($horoscopeDate)) }}" required>
                                            </div>
                                            <div class="col-lg-4">
                                                <label for="ticket-status" class="form-label">Lucky Time</label>
                                                <input type="time" id="luckyTime" name="luckyTime" class="form-control inputs"
                                                placeholder="luckyTime" aria-describedby="input-group-4"
                                                value="{{ $dailyHoroscopeStatics[0]->luckyTime }}" required>
                                            </div>
                                            <div class="col-lg-4">
                                                <label for="ticket-status" class="form-label">Lucky Number</label>
                                                <input type="number" id="luckyNumber" name="luckyNumber"
                                                class="form-control inputs" placeholder="luckyNumber"
                                                aria-describedby="input-group-4"
                                                value="{{ $dailyHoroscopeStatics[0]->luckyNumber }}" required>
                                            </div>
                                            <div class="col-lg-4">
                                                <label for="ticket-status" class="form-label">Lucky Color</label>
                                                <input type="color" id="luckyColor" name="luckyColour"
                                                 class="form-control inputs" placeholder="luckyColor"
                                                 aria-describedby="input-group-4"
                                                 value="{{ $dailyHoroscopeStatics[0]->luckyColor }}" required>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="inline-item" style="font-size:20px;">
                                                  <label for="ticket-status" class="form-label">Love</label>
                                                </div>
                                                <div class="inline-item" style="float: right;">
                                                 <input type="text" id="lovepercent" name="lovepercent" class="form-control"
                                                 placeholder="Percentage(%)" aria-describedby="input-group-3"
                                                  onKeyDown="numbersOnly(event)" value={{ $data['lovePercent'] }} required>
                                                </div>
                                                <br>
                                                <textarea id="" cols="20" rows="10"  class="form-control ckeditor" name="lovedesc" required>{{ $data['loveDesc'] }}</textarea>
                                            </div>
                                            <div class="col-lg-12">
                                              <div class="inline-item" style="font-size:20px;">
                                                <label for="ticket-status" class="form-label">Career</label>
                                              </div>
                                              <div class="inline-item" style="float: right;">
                                                <input type="text" id="careerpercent" name="careerpercent" class="form-control"
                                                 placeholder="Percentage(%)" aria-describedby="input-group-3"
                                                 onKeyDown="numbersOnly(event)" value={{ $data['careerPercent'] }} required>
                                              </div>
                                              <br>
                                                <textarea id="" cols="20" rows="10" class="form-control ckeditor" name="careerdesc" required>{{ $data['careerDesc'] }}</textarea>
                                            </div>
                                            <div class="col-lg-12">
                                              <div class="inline-item" style="font-size:20px;">
                                                <label for="ticket-status" class="form-label">Travel</label>
                                              </div>
                                              <div class="inline-item" style="float: right;">
                                                <input type="text" id="travelpercent" name="travelpercent" class="form-control"
                                                placeholder="Percentage(%)" aria-describedby="input-group-3"
                                                onKeyDown="numbersOnly(event)" value={{ $data['travelPercent'] }} required>
                                              </div>
                                              <br>
                                                <textarea id="" cols="20" rows="10" class="form-control ckeditor" name="traveldesc" required>{{ $data['travelDesc'] }}</textarea>
                                            </div>
                                            <div class="col-lg-12">
                                              <div class="inline-item" style="font-size:20px;">
                                                <label for="ticket-status" class="form-label">Health</label>
                                              </div>
                                              <div class="inline-item" style="float: right;">
                                                <input type="text" id="healthpercent" name="healthpercent" class="form-control"
                                                 placeholder="Percentage(%)" aria-describedby="input-group-3"
                                                 onKeyDown="numbersOnly(event)" value={{ $data['healthPercent'] }} required>
                                              </div>
                                              <br>
                                                <textarea id="" cols="20" rows="10" class="form-control ckeditor" name="healthdesc" required>{{ $data['healthDesc'] }}</textarea>
                                            </div>
                                            <div class="col-lg-12">
                                              <div class="inline-item" style="font-size:20px;">
                                                <label for="ticket-status" class="form-label">Money</label>
                                              </div>
                                              <div class="inline-item" style="float: right;">
                                                <input type="text" id="moneypercent" name="moneypercent" class="form-control"
                                                 placeholder="Percentage(%)" aria-describedby="input-group-3"
                                                 onKeyDown="numbersOnly(event)" value={{ $data['moneyPercent'] }} required>
                                              </div>
                                              <br>
                                                <textarea id="" cols="20" rows="10" class="form-control ckeditor" name="moneydesc" required>{{ $data['moneyDesc'] }}</textarea>
                                            </div>
                                        </div>    
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

