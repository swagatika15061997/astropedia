@extends('astrologer.layouts.app')

@section('title','Profile Setting')

@push('css_or_js')
<style>

</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" defer/>

<!-- <link href="{{asset('backend/assets/css/avail.css')}}" rel="stylesheet" type="text/css" /> -->
@endpush
@section('content')
   <div class="page-content">
        <div class="container-fluid">
            <div class="position-relative mx-n4 mt-n4">
                <div class="profile-wid-bg profile-setting-img">
                    <img src="{{asset('backend/assets/images/profile-bg.jpg')}}" class="profile-wid-img" alt="">
                    <div class="overlay-content">
                        <div class="text-end p-3">
                            <div class="p-0 ms-auto rounded-circle profile-photo-edit">
                                <input id="profile-foreground-img-file-input" type="file" class="profile-foreground-img-file-input">
                                <label for="profile-foreground-img-file-input" class="profile-photo-edit btn btn-light">
                                    <i class="ri-image-edit-line align-bottom me-1"></i> Change Cover
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <!--end col-->
                <div class="col-xxl-12">
                    <div class="card mt-n5">
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                        <i class="fas fa-home"></i> Personal Details
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#availability" role="tab">
                                        <i class="far fa-user"></i> Availability
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                        <i class="far fa-user"></i> Change Password
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body p-4">
                            <div class="tab-content">
                                <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                    <form  action="{{route('astrologer.profile.update',[$data->id])}}" method="post" enctype="multipart/form-data" id="myForm">
                                      @csrf
                                        <div class="row">
                                            <div class="text-center">
                                               <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                                   <img onerror="this.src='{{asset('backend/assets/images/demo/def.jpg')}}'" src="{{asset('images/profile/'.$data->image)}}" class="rounded-circle avatar-xl img-thumbnail user-profile-image material-shadow" alt="user-profile-image">
                                                   <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                                                       <input id="profile-img-file-input" name="image" type="file" class="profile-img-file-input">
                                                       <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                                                           <span class="avatar-title rounded-circle bg-light text-body material-shadow">
                                                               <i class="ri-camera-fill"></i>
                                                           </span>
                                                       </label>
                                                   </div>
                                               </div>
                                            </div>
                                                     
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="firstnameInput" class="form-label">Name</label>
                                                    <input type="text" class="form-control" name="name" id="firstnameInput" placeholder="Enter your firstname" value="{{$data->name}}">
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="emailInput" class="form-label">Email Address</label>
                                                    <input type="email" class="form-control" name="email" id="emailInput" placeholder="Enter your email" value="{{$data->email}}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="emailInput" class="form-label">Phone</label>
                                                    <input type="text" class="form-control" name="phone" id="emailInput" placeholder="Enter your phone no." value="{{$data->phone}}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="emailInput" class="form-label">Gender</label>
                                                    <select name="gender" class="form-control" id="">
                                                      <option Value="Female"
                                                          {{ $data['gender'] == 'Female' ? 'selected' : '' }}>
                                                          Female
                                                      </option>
                                                      <option Value="Male" {{ $data['gender'] == 'Male' ? 'selected' : '' }}>
                                                          Male
                                                      </option>
                                                    </select>
                                                </div>
                                                
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="emailInput" class="form-label">Date of Birth</label>
                                                    <input type="date" class="form-control" name="dob" id="emailInput" placeholder="Enter your phone no." value="{{$data->dob}}">
                                                </div>
                                            </div>
                                            <?php
                                              $services = \App\Models\Service::where('status',1)->orderBy('id','DESC')->get();
                                              $skills = \App\Models\Skill::where('status',1)->orderBy('id','DESC')->get();
                                            ?>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="emailInput" class="form-label">Service Category</label>
                                                    <select name="serviceCategory" class="form-control" id="">
                                                        <option>--Select--</option>
                                                      @foreach($services as $service)
                                                        <option value="{{ $service->id }}" {{ $data->serviceCategory == $service->id ? 'selected' : '' }}>
                                                            {{ $service->name }}
                                                        </option>
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
                                                    <input type="number" class="form-control" name="charge" placeholder="Enter your charge(As per Minute)" value="{{$data->charge}}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Experience In Years</label>
                                                    <input type="text" class="form-control" name="experience" placeholder="Experience in years" value="{{$data->experienceInYears}}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">How many hours you can contribute daily?</label>
                                                    <input type="text" class="form-control" name="dailyContribution" placeholder="How many hours you can contribute daily?" value="{{$data->dailyContribution}}">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Address</label>
                                                    <textarea class="form-control" name="address" placeholder="Enter your address">{{$data->address}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">What are some good qualities of perfect astrologer?</label>
                                                    <textarea class="form-control" name="goodQuality" placeholder="What are some good qualities of perfect astrologer?">{{$data->goodQuality}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">What was the biggest challenge you faced and how did you overcome it?</label>
                                                    <textarea class="form-control" name="biggestChallenge" placeholder="What was the biggest challenge you faced and how did you overcome it?">{{$data->biggestChallenge}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">A customer is asking the same question repeatedly: what will you do?</label>
                                                    <textarea class="form-control" name="whatwillDo" placeholder="A customer is asking the same question repeatedly: what will you do?">{{$data->whatwillDo}}</textarea>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            
                                            <div class="col-lg-12">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button type="submit" class="btn btn-primary">Updates</button>
                                                    <button type="button" class="btn btn-soft-success">Cancel</button>
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </form>
                                </div>
                                <!--end tab-pane-->
                                <div class="tab-pane" id="availability" role="tabpanel">
                                    <form action="{{route('astrologer.profile.availability',$data->id)}}" method="post" id="myForm1">
                                        @csrf
                                        <div class="row g-2">
                                            @foreach ($data['astrologerAvailability'] as $availability)
                                                <div class="input mt-2 sm:mt-0">
                                                    <h4 class="font-medium text-lg mt-3 d-inline">{{ $availability['day'] }}</h4>                                                  
                                                    <div class="row g-2">
                                                        @foreach ($availability['time'] as $timeIndex => $time)
                                                            <div
                                                                class="{{ $availability['day'] }}_fromTime{{ $timeIndex }} intro-y col-span-6 md:col-span-6 col-lg-6">
                                                                <label id="input-group"
                                                                    class="astrologerAvailability_{{ $availability['day'] }}_time{{ $timeIndex }}_fromTime form-label">FromTime
                                                                    </label>
                                                                <input type="hidden" class="form-control"
                                                                    id="astrologerAvailability[{{ $availability['day'] }}_{{ $timeIndex }}][day]"
                                                                    placeholder="FromTime"
                                                                    name="astrologerAvailability[{{ $availability['day'] }}_{{ $timeIndex }}][day]"
                                                                    aria-describedby="input-group-4" value="{{ $availability['day'] }}">
                                                                <input type="time" class="form-control" placeholder="FromTime"
                                                                    name="astrologerAvailability[{{ $availability['day'] }}_{{ $timeIndex }}][time][{{ $timeIndex }}][fromTime]"
                                                                    id="astrologerAvailability_{{ $availability['day'] }}_time{{ $timeIndex }}_fromTime"
                                                                    aria-describedby="input-group-4" value="{{ $time['fromTime'] }}">
                                                            </div>
                                                            <div
                                                                class="{{ $availability['day'] }}_toTime{{ $loop->index }} intro-y col-span-6 md:col-span-6 col-lg-6">
                                                                <label id="input-group"
                                                                    class="astrologerAvailability_{{ $availability['day'] }}_time{{ $loop->index }}_toTime form-label">ToTime</label>
                                                                <input type="time" class="form-control" placeholder="FromTime"
                                                                    name="astrologerAvailability[{{ $availability['day'] }}_{{ $timeIndex }}][time][{{ $loop->index }}][toTime]"
                                                                    id="astrologerAvailability_{{ $availability['day'] }}_time{{ $loop->index }}_toTime"
                                                                    aria-describedby="input-group-4" value="{{ $time['toTime'] }}">
                                                            </div>
                                                        @endforeach
                                                    </div>                               
                                                </div>
                                            @endforeach
                                            <!--end col-->
                                            <div class="col-lg-12">
                                                <div class="text-end">
                                                    <button type="submit" class="btn btn-success">Update</button>
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </form>
                                </div>
                                <!--end tab-pane-->
                                <div class="tab-pane" id="changePassword" role="tabpanel">
                                    <form action="{{route('astrologer.profile.settings-password')}}" method="post" id="myForm1">
                                        @csrf
                                        <div class="row g-2">

                                            <!--end col-->
                                            <div class="col-lg-4">
                                                <div>
                                                    <label for="newpasswordInput" class="form-label">New Password*</label>
                                                    <input type="password" class="form-control" name="password" id="newpasswordInput" placeholder="Enter new password">
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-4">
                                                <div>
                                                    <label for="confirmpasswordInput" class="form-label">Confirm Password*</label>
                                                    <input type="password" class="form-control" name="confirm_password" id="confirmpasswordInput" placeholder="Confirm password">
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-12">
                                                <div class="mb-3">
                                                    <a href="javascript:void(0);" class="link-primary text-decoration-underline">Forgot Password ?</a>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-12">
                                                <div class="text-end">
                                                    <button type="submit" class="btn btn-success">Change Password</button>
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </form>
                                </div>
                                <!--end tab-pane-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end row-->

        </div>
        <!-- container-fluid -->
    </div><!-- End Page-content -->
@endsection
@push('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    var allSkill = {{ Js::from($data['skill']) }};
    allSkill = allSkill.split(',')
    $('.all').val(allSkill).trigger('change');
    var times = {{ Js::from($data['astrologerAvailability']) }};
        var dayTime = [];


        function addField($day) {
            if (times && times.length > 0) {
                dayTime = times.find(c => c.day == $day)['time'];
                dayTime.push({
                    fromTime: null,
                    toTime: null
                })
            }
            html = '';
            htmlto = '';
            html +=
                " <div class=" + $day + "_fromTime" + (dayTime.length - 1) +
                " intro-y col-span-6 md:col-span-6 mt-5'> <label id='input-group' class='mt-5 astrologerAvailability_" +
                $day +
                "_time" + (dayTime.length - 1) +
                "_fromTime form-label'>FromTime<button style='padding: 2px 7px;border-radius: 50%'class='btn btn-sm btn-primary add-field d-inline' type='button' onclick=removeField('" +
                $day + "'," + (dayTime.length - 1) +
                ")>-</button></label> <input id='astrologerAvailability[" + $day + "_" + (dayTime.length - 1) +
                "][day]' type='hidden' class='form-control' placeholder='FromTime' name='astrologerAvailability[" +
                $day + "_" + (dayTime.length - 1) + "][day]' aria-describedby='input-group-4' value=" + $day +
                "><input type = 'time' class = 'form-control' placeholder = 'FromTime' id='astrologerAvailability_" +
                $day + "_time" + (dayTime.length - 1) + "_fromTime' name = 'astrologerAvailability[" +
                $day + "_" + (dayTime.length - 1) + "][time][" + (dayTime.length - 1) +
                "][fromTime]' aria-describedby = 'input-group-4'></div>";
            htmlto +=
                ' <div class=' + $day + '_toTime' + (dayTime.length - 1) +
                ' intro-y col-span-6 md:col-span-6 mt-5"><label id="input-group" class="mt-5 form-label astrologerAvailability_' +
                $day + '_time' + (dayTime.length - 1) +
                '_toTime">ToTime</label><input type = "time" class = "form-control"  placeholder = "ToTime" name = "astrologerAvailability[' +
                $day + '_' + (dayTime.length - 1) + '][time][' + (dayTime.length - 1) +
                '][toTime]" id="astrologerAvailability_' +
                $day + '_time' + (dayTime.length - 1) + '_toTime"></div>'
            $('.' + $day + '_fromTime' + (dayTime.length - 2)).append(
                html
            );
            $('.' + $day + '_toTime' + (dayTime.length - 2)).append(
                htmlto
            );
        }

        function removeField($day, $index) {
            if (dayTime.length == 0)
                dayTime = times.filter(c => c.day == $day)[0]['time'];
            dayTime.splice($index, 1);

            $('#astrologerAvailability_' + $day + '_time' + $index + '_fromTime').remove();
            $('#astrologerAvailability_' + $day + '_time' + $index + '_toTime').remove();

            $('.astrologerAvailability_' + $day + '_time' + $index + '_fromTime').remove();
            $('.astrologerAvailability_' + $day + '_time' + $index + '_toTime').remove();
            $('#astrologerAvailability[' + $day + '_' + $index + '][day]').remove();
        }
        
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
@endpush