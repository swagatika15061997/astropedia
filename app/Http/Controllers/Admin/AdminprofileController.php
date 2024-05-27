<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminprofileController extends Controller
{
    public function view()
    {
        $data = Admin::where('id', auth('admin')->id())->first();
        return view('admin.profile.view', compact('data'));
    }

    public function edit($id)
    {
        $data = Admin::where('id', $id)->first();
        return view('admin.profile.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::find($id);
        $admin->name = $request->name;
        $admin->email = $request->email;

        if ($request->hasFile('image')) {
            $newImage = $request->file('image');
            $filename = time() . '_' . $newImage->getClientOriginalName();
            $newImage->move(public_path('images/profile'), $filename);
            if ($admin->image && File::exists(public_path('images/profile/' . $admin->image))) {
                // Delete the previous image file
                File::delete(public_path('images/profile/' . $admin->image));
            }
            $admin->image = $filename;
        }
        $admin->save();
        
        return back();
    }

    public function settings_password_update(Request $request)
    {
        $request->validate([
            'password' => 'required|same:confirm_password|min:8',
            'confirm_password' => 'required',
        ]);

        $admin = Admin::find(auth('admin')->id());
        $admin->password = bcrypt($request['password']);
        $admin->save();
        return back();
    }
}
