<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Auth;

class ProfileController extends Controller
{
    public function profile_info(Request $request)
    {
        $user = Auth::guard('api')->user();
        if(!$user){
            return response()->json(['message' => 'Unauthorized access'], 401);
        }
        else{
            $userData = [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'dob' => $user->dob,
                'birth_place' => $user->birth_place,
                'birth_time' => $user->birth_time,
                'marital_status' => $user->marital_status,
                'gender' => $user->gender,
                'wallet_balance' => $user->wallet_balance,
                'image_url' => $user->image ? asset('images/profile/' . $user->image) : null,
            ];
            return response()->json(['user' => $userData], 200);
        }
        
        
    }
    public function update_profile(Request $request)
    {
        $user = Auth::guard('api')->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized access'], 401);
        }

        // Validate the request data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'string|unique:users,phone,' . $user->id,
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
            'dob' => 'required|date',
            'birth_place' => 'required|string|max:255',
            'birth_time' => 'required|string|max:255',
            'marital_status' => 'required|string|in:single,married,divorced,widowed',
            'gender' => 'required|string|in:male,female,other',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Update the user's profile
        $user->name = $request->input('name');
        $user->dob = $request->input('dob');
        $user->birth_place = $request->input('birth_place');
        $user->birth_time = $request->input('birth_time');
        $user->marital_status = $request->input('marital_status');
        $user->gender = $request->input('gender');

        // Conditionally update email and phone
        if ($request->has('email')) {
            $user->email = $request->input('email');
        }
        if ($request->has('phone')) {
            $user->phone = $request->input('phone');
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $newImage = $request->file('image');
            $filename = time() . '_' . $newImage->getClientOriginalName();
            $newImage->move(public_path('images/profile'), $filename);

            // Delete the previous image file if it exists
            if ($user->image && File::exists(public_path('images/profile/' . $user->image))) {
                File::delete(public_path('images/profile/' . $user->image));
            }

            $user->image = $filename;
        }

        $user->save();

        return response()->json(['message' => 'Profile updated successfully', 'user' => $user], 200);
    }
}
