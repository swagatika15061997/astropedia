<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Laravel\Passport\Passport;



class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'nullable|string|email|max:255|unique:users|required_without:phone',
            'phone' => 'nullable|string|unique:users|required_without:email',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return response()->json(['user' => $user], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'nullable|string|email|required_without:phone',
            'phone' => 'nullable|string|required_without:email',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $otp = rand(1000, 9999);
        $expiry = Carbon::now()->addMinutes(10);

        $user->update([
            'otp' => $otp,
            'otp_expires_at' => $expiry,
        ]);

        // Here, you should integrate an SMS gateway or email service to send the OTP
        if ($user->email) {
            Mail::raw("Your OTP is: $otp", function($message) use ($user) {
                $message->to($user->email)->subject('Your OTP Code');
            });
        }

        if ($user->phone) {
            // Integrate SMS sending service here to send OTP to phone
        }

        return response()->json(['message' => 'OTP sent','otp' =>$otp ], 200);
    }

    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'nullable|string|email|required_without:phone',
            'phone' => 'nullable|string|required_without:email',
            'otp' => 'required|digits:4',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::where('email', $request->email)->orWhere('phone', $request->phone)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if ($user->otp !== $request->otp || Carbon::now()->greaterThan($user->otp_expires_at)) {
            return response()->json(['message' => 'Invalid or expired OTP'], 400);
        }

        // Clear the OTP after successful verification
        $user->update([
            'otp' => null,
            'otp_expires_at' => null,
        ]);

       $token = $user->createToken('authToken')->accessToken;

        return response()->json(['token' => $token], 200);
    }
}
