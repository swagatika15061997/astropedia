<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    public function setting()
    {
        $settings = Setting::first();
        return view('admin.setting', compact('settings'));

    }
    public function setting_save(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'company_address' => 'nullable|string',
            'header_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'footer_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'commission' => 'required|integer'
        ]);

        // Update settings
        $settings = Setting::firstOrFail(); // Assuming you have only one settings record
        $settings->company_name = $request->input('company_name');
        $settings->phone = $request->input('phone');
        $settings->email = $request->input('email');
        $settings->company_address = $request->input('company_address');
        $settings->commission = $request->input('commission');

        // Handle logo, footer logo, and favicon uploads
        if ($request->hasFile('header_logo')) {
            $headerLogo = $request->file('header_logo');
            $headerLogoName = time() . '_header_' . $headerLogo->getClientOriginalName();
            $headerLogo->move(public_path('images/setting'), $headerLogoName);
            if ($settings->header_logo && File::exists(public_path('images/setting/' . $settings->header_logo))) {
                File::delete(public_path('images/setting/' . $settings->header_logo));
            }
            $settings->header_logo = $headerLogoName;
        }
    
        // Handle footer logo upload
        if ($request->hasFile('footer_logo')) {
            $footerLogo = $request->file('footer_logo');
            $footerLogoName = time() . '_footer_' . $footerLogo->getClientOriginalName();
            $footerLogo->move(public_path('images/setting'), $footerLogoName);
            if ($settings->footer_logo && File::exists(public_path('images/setting/' . $settings->footer_logo))) {
                File::delete(public_path('images/setting/' . $settings->footer_logo));
            }
            $settings->footer_logo = $footerLogoName;
        }
    
        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            $favicon = $request->file('favicon');
            $faviconName = time() . '_favicon_' . $favicon->getClientOriginalName();
            $favicon->move(public_path('images/setting'), $faviconName);
            if ($settings->favicon && File::exists(public_path('images/setting/' . $settings->favicon))) {
                File::delete(public_path('images/setting/' . $settings->favicon));
            }
            $settings->favicon = $faviconName;
        }

        $settings->save();

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
