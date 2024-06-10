<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;

class ProfileController extends Controller
{
    public function profile_info(Request $request)
    {
        $user = Auth::user();
        
        return response()->json(['user' => $user], 200);
        
    }
}
