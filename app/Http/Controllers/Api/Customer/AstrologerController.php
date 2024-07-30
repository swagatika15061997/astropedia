<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Astrologer;

class AstrologerController extends Controller
{
    public function list(Request $request)
    {  
        $astrologers = Astrologer::orderBy('created_at', 'desc')->get();
        return response()->json(['astrologer'=>$astrologers]);
    }
    public function details(Request $request,$id)
    {  
        $astrologer = Astrologer::find($id);
        return response()->json(['astrologer'=>$astrologer]);

    }
}
