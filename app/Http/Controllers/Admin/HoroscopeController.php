<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ZodiacSign;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use DB;

class HoroscopeController extends Controller
{
    public function list(Request $request)
    {  
        $zodiac_signs = ZodiacSign::orderBy('created_at', 'desc')->get();
        return view('admin.horoscope.zodiac-sign', compact('zodiac_signs'));
    }
    public function store(Request $request)
    {  
        $rules = [
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif', // Adjust max file size and allowed file types as needed
            'date_from' => 'required',
            'date_to' => 'required',
        ];    
        $validator = Validator::make($request->all(), $rules);    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $zodiac = new ZodiacSign;
        $zodiac->name = $request->name;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_zodiac_' . $image->getClientOriginalName();
            $image->move(public_path('images/horoscope'), $imageName);
            $zodiac->image = $imageName;
        }
        $zodiac->date_from = $request->date_from;
        $zodiac->date_to = $request->date_to;
        $zodiac->save();
        return redirect()->route('horoscope.zodiac.list')->with('success', 'Zodiac sign added successfully.');
    }
    public function update(Request $request, $id)
    {   
        $rules = [
            'name' => 'required|string|max:255',
            'date_from' => 'required',
            'date_to' => 'required',  
        ];    
        $validator = Validator::make($request->all(), $rules);    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
            
        }
        $zodiac = ZodiacSign::find($id);
        $zodiac->name = $request->name;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_zodiac_' . $image->getClientOriginalName();
            $image->move(public_path('images/horoscope'), $imageName);
            $zodiac->image = $imageName;
        }
        $zodiac->date_from = $request->date_from;
        $zodiac->date_to = $request->date_to;
        $zodiac->save();
        return redirect()->route('horoscope.zodiac.list')->with('success', 'Zodiac sign updated successfully.');
    }
    public function destroy($id)
    {
     $zodiac = ZodiacSign::findOrFail($id);
     $zodiac->delete();
     return redirect()->back()->with('success', 'Zodiac sign deleted successfully.');
    }
    public function status_update(Request $request)
    {
        ZodiacSign::where(['id' => $request['zodiacId']])->update([
            'status' => $request['isChecked']
        ]);
        $response = array(
            'message' => 'Zodiac sign status updated successfully.',
            'alert-type' => 'success'
        );
        return response()->json($response);
    }
    public function view(Request $request)
    {
        $horoscope = DB::Table('horoscopes')
            ->join('zodiac_signs', 'zodiac_signs.id', '=', 'horoscopes.zodiac_sign_id');
        if ($request->filterSign) {
            $horoscope = $horoscope->where('horoscopes.zodiac_sign_id', '=', $request->filterSign);
        } else {
            $horoscope = $horoscope->where("zodiac_sign_id", '=', 1);
        }
        $horoscope = $horoscope->select('horoscopes.*')->get();
        $zodiacSign = ZodiacSign::query();
        $signs = $zodiacSign->get();
        $selectedId = $request->filterSign ? $request->filterSign : $signs[0]['id'];
        return view('admin.horoscope.view', compact('horoscope', 'signs', 'selectedId'));
    }
    public function store_horoscope(Request $request)
    {
        $rules = [
            'zodiacSignId' => 'required',
        ];  
        $messages = [
            'zodiacSignId.required' => 'Zodiac sign is required!',
        ];  
        $validator = Validator::make($request->all(), $rules,$messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();    
        }
        $this->addHoro('Weekly', $request->title, $request->zodiacSignId, $request->weeklydesc, null);
        $this->addHoro('Monthly', $request->monthlytitle, $request->zodiacSignId, $request->monthlydesc, null);
        $this->addHoro('Yearly', $request->yearlytitle, $request->zodiacSignId, $request->yearlydesc, null);
        return redirect()->route('horoscope.view')->with('success', 'Horoscope added successfully.');
    }
    public function addHoro($hroscopeType, $horoTitle, $zodiacSignId, $description, $oldSignId)
    {
        $horoscope = DB::table('horoscopes')->where('zodiac_sign_id', $zodiacSignId)->where('horoscopeType', $hroscopeType)->get();
        $data = array(
            'horoscopeType' => $hroscopeType,
            'title' => $horoTitle,
            'description' => $description,
            'zodiac_sign_id' => $zodiacSignId,
        );
        if ($horoscope && count($horoscope) > 0) {
            DB::table('horoscopes')->where('id', $horoscope[0]->id)->update($data);
        } else {
            if ($oldSignId) {
                DB::table('horoscopes')->where('zodiac_sign_id', $oldSignId)->delete();
            }
            DB::table('horoscopes')
                ->insert($data);
        }
    }
    public function edit_horoscope(Request $req)
    {
        $zodiacSignId = $req->zodiacSignId;
        $horoscope = DB::table('horoscopes')->where('zodiac_sign_id', $req->zodiacSignId)->get();
        if ($horoscope && count($horoscope) > 0) {
            for ($i = 0; $i < count($horoscope); $i++) {
                if ($horoscope[$i]->horoscopeType == 'Weekly') {
                    $weeklytitle = $horoscope[$i]->title;
                    $weeklydesc = $horoscope[$i]->description;
                }

                if ($horoscope[$i]->horoscopeType == 'Monthly') {
                    $monthlytitle = $horoscope[$i]->title;
                    $monthlydesc = $horoscope[$i]->description;
                }

                if ($horoscope[$i]->horoscopeType == 'Yearly') {
                    $yearlytitle = $horoscope[$i]->title;
                    $yearlydesc = $horoscope[$i]->description;
                }
            }
        }
        $horo = array(
            'weeklytitle' => $weeklytitle,
            'weeklydesc' => $weeklydesc,
            'monthlytitle' => $monthlytitle,
            'monthlydesc' => $monthlydesc,
            'yearlytitle' => $yearlytitle,
            'yearlydesc' => $yearlydesc,
        );
        $zodiacSign = ZodiacSign::query();
        $signs = $zodiacSign->where('status', true)->orderBy('id', 'DESC')->get();
        return view('admin.horoscope.edit-horoscope', compact('signs', 'horo', 'zodiacSignId'));
    }
    public function update_horoscope(Request $request)
    {
        $rules = [
            'zodiacSignId' => 'required',
        ];  
        $messages = [
            'zodiacSignId.required' => 'Zodiac sign is required!',
        ];  
        $validator = Validator::make($request->all(), $rules,$messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();    
        }
        $this->addHoro('Weekly', $request->title, $request->zodiacSignId, $request->weeklydesc, null);
        $this->addHoro('Monthly', $request->monthlytitle, $request->zodiacSignId, $request->monthlydesc, null);
        $this->addHoro('Yearly', $request->yearlytitle, $request->zodiacSignId, $request->yearlydesc, null);
        return redirect()->route('horoscope.view')->with('success', 'Horoscope updated successfully.');
    }
    public function delete_horoscope(Request $request)
    {
      DB::table('horoscopes')->where('zodiac_sign_id', '=', $request->del_id)->delete();
      return redirect()->route('horoscope.view')->with('success', 'Deleted successfully.');   
    }
}
