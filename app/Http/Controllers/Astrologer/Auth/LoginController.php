<?php

namespace App\Http\Controllers\Astrologer\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\Astrologer;

class LoginController extends Controller
{
    public function register()
    {
        return view('astrologer.auth.registration');
    }
    public function register_submit(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:astrologers',
            'phone' => 'required|numeric|min:11|unique:astrologers',
            'password' => 'required|min:8|confirmed',
        ]);

        // Create a new astrologer
        $astrologer = new Astrologer();
        $astrologer->name = $validatedData['name'];
        $astrologer->email = $validatedData['email'];
        $astrologer->phone = $request->phone;
        $astrologer->password = Hash::make($validatedData['password']);
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
        $day = [];
        $working = [];
        $day = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        $astrologer->save();

        // Redirect the user after successful registration
        return redirect()->route('astrologer.login')->with('success', 'Registration successful! You can now log in.');
    }
    public function login()
    {
        return view('astrologer.auth.login');
    }
    public function login_submit(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $check = $request->all();
        $data = [
            'email' => $check['email'],
            'password' => $check['password'],
        ];
        if(Auth::guard('astrologer')->attempt($data)) {
            if(Auth::guard('astrologer')->user()->status == 'approved'){
                return redirect()->route('astrologer.dashboard')->with('success','Login Successfull');
            }
            else{
                return redirect()->route('astrologer.login')->with('warning','Account has not activated');
            }
            
        } else {
            return redirect()->route('astrologer.login')->with('error','Invalid Credentials');
        }
    }
    public function logout()
    {
        Auth::guard('astrologer')->logout();
        return redirect()->route('astrologer.login')->with('success','Logout Successfully');
    }
}
