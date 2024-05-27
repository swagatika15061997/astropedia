<?php

namespace App\Http\Controllers\Astrologer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use Illuminate\Support\Facades\File;
use App\Models\Astrologer;
use App\Models\AstrologerAvailability;
use Carbon\Carbon;
use DB;

class AstrologerController extends Controller
{
    public function dashboard()
    {
        return view('astrologer.dashboard');
    }
    public function view()
    {
        $data = Astrologer::where('id', auth('astrologer')->id())->first();
        return view('astrologer.profile.view', compact('data'));
    }

    public function edit(Request $req,$id)
    {
        $data = Astrologer::where('id', $id)->first();
        $astrologerAvailability = DB::table('astrologer_availabilities')->where('astrologerId', $req->id)->get();
        $day = [];
        $working = [];
        $day = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        if ($astrologerAvailability && count($astrologerAvailability) > 0) {

            foreach ($day as $days) {
                $day = array(
                    'day' => $days,
                );
                $currentday = $days;
                $result =
                    array_filter(
                    json_decode($astrologerAvailability),
                    function ($event) use ($currentday) {
                        return $event->day === $currentday;
                    }
                );
                $ti = [];
                foreach ($result as $available) {
                    if ($available->fromTime) {
                        $available->fromTime = Carbon::createFromFormat('h:i A', $available->fromTime);
                        $available->fromTime = $available->fromTime->format('H:i');
                    }
                    if ($available->toTime) {
                        $available->toTime = Carbon::createFromFormat('h:i A', $available->toTime);
                        $available->toTime = $available->toTime->format('H:i');
                    }
                    $time = array(

                        'fromTime' => $available->fromTime,
                        'toTime' => $available->toTime,
                    );
                    array_push($ti, $time);

                }
                if (count($ti) == 0) {
                    $time = array(

                        'fromTime' => null,
                        'toTime' => null,
                    );
                    array_push($ti, $time);
                }
                $weekDay = array(
                    'day' => $days,
                    'time' => $ti,
                );
                array_push($working, $weekDay);
            }
            $data->astrologerAvailability = $working;
        } else {

            foreach ($day as $days) {
                $ti = [];
                $time = array(
                    'fromTime' => null,
                    'toTime' => null,
                );
                array_push($ti, $time);
                $weekDay = array(
                    'day' => $days,
                    'time' => $ti,
                );
                array_push($working, $weekDay);
            }

            $data->astrologerAvailability = $working;
        }
        return view('astrologer.profile.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $astrologer = Astrologer::find($id);
        $astrologer->name = $request->name;
        $astrologer->email = $request->email;

        if ($request->hasFile('image')) {
            $newImage = $request->file('image');
            $filename = time() . '_' . $newImage->getClientOriginalName();
            $newImage->move(public_path('images/profile'), $filename);
            if ($astrologer->image && File::exists(public_path('images/profile/' . $astrologer->image))) {
                // Delete the previous image file
                File::delete(public_path('images/profile/' . $astrologer->image));
            }
            $astrologer->image = $filename;
        }
        $astrologer->phone = $request->phone;
        $astrologer->gender = $request->gender;
        $astrologer->dob = $request->dob;
        $astrologer->serviceCategory = $request->serviceCategory; 
        $astrologer->skill =  implode(',', $request->skill);
        $astrologer->charge = $request->charge;
        $astrologer->experienceInYears = $request->experience;
        $astrologer->dailyContribution = $request->dailyContribution;
        $astrologer->address = $request->address;
        $astrologer->goodQuality = $request->goodQuality;
        $astrologer->biggestChallenge = $request->biggestChallenge;
        $astrologer->whatwillDo = $request->whatwillDo;
        $astrologer->save();
        
        return back();
    }

    public function settings_password_update(Request $request)
    {
        $request->validate([
            'password' => 'required|same:confirm_password|min:8',
            'confirm_password' => 'required',
        ]);

        $astrologer = Astrologer::find(auth('astrologer')->id());
        $astrologer->password = bcrypt($request['password']);
        $astrologer->save();
        return back();
    }
    public function availability(Request $req,$id)
    {
        $astrologer = Astrologer::find($id);
        if ($req->astrologerAvailability) {
            $availability = DB::Table('astrologer_availabilities')
                ->where('astrologerId', '=', $req->id)->delete();
            foreach ($req->astrologerAvailability as $astrologeravailable) {
                if (array_key_exists('time', $astrologeravailable)) {
                    foreach ($astrologeravailable['time'] as $availability) {
                        if ($availability['fromTime']) {
                            $availability['fromTime'] = Carbon::createFromFormat('H:i', $availability['fromTime'])->format('h:i A');
                        }
                        if ($availability['toTime']) {
                            $availability['toTime'] = Carbon::createFromFormat('H:i', $availability['toTime'])->format('h:i A');
                        }
                        AstrologerAvailability::create([
                            'astrologerId' => $astrologer->id,
                            'day' => $astrologeravailable['day'],
                            'fromTime' => $availability['fromTime'],
                            'toTime' => $availability['toTime'],
                            // 'createdBy' => $req->id,
                            // 'modifiedBy' => $req->id,
                        ]);
                    }
                }
            }
        }
        $astrologer->astrologerAvailability = $req->astrologerAvailability;
        return back();

    }
    

}
