<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Astrologer;
class AstrologerController extends Controller
{
    public function list(Request $request)
    {  
        $astrologers = Astrologer::orderBy('created_at', 'desc')->get();
        return view('admin.astrologer.list', compact('astrologers'));
    }
    public function details(Request $request,$id)
    {  
        $astrologers = Astrologer::find($id);
        return view('admin.astrologer.list', compact('astrologers'));
    }
    public function destroy($id)
    {
     $astrologer = Astrologer::findOrFail($id);
     $astrologer->delete();
     return redirect()->back()->with('success', 'Astrologer deleted successfully.');
    }
    public function view($id)
    {
     $astrologer = Astrologer::findOrFail($id);
     return view('admin.astrologer.view', compact('astrologer'));
    }
    public function status_update(Request $request)
    {
       $astrologer = Astrologer::findOrFail($request->id);
       $astrologer->status = $request->status;
       if ($request->status == "approved") {
           $message = 'Astrologer approved successfully.';
       } else if ($request->status == "rejected") {
           $message = 'Astrologer rejected successfully.';
       } else if ($request->status == "suspended") {
           $message = 'Astrologer suspended successfully.';
       }
       $astrologer->save();
       return redirect()->back()->with('success', $message);
    }
    public function commission(Request $request,$id)
    {
        $request->validate([
            'commission' => 'numeric'
        ]);
        $astrologer = Astrologer::find($id);
        $astrologer->commission = $request->commission;
        $astrologer->save();
        return redirect()->back()->with('success', 'Commission updated successfully.');

    }

}
