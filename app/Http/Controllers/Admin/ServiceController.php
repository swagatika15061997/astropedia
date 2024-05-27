<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function list(Request $request)
    {  
        $services = Service::orderBy('created_at', 'desc')->get();
        return view('admin.service.list', compact('services'));
    }
    public function store(Request $request)
    {  
        $rules = [
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max file size and allowed file types as needed
            'banner' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max file size and allowed file types as needed
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ];
    
        // Perform validation
        $validator = Validator::make($request->all(), $rules);
    
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
            
        }
        $service = new Service;
        $service->name = $request->name;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_service_' . $image->getClientOriginalName();
            $image->move(public_path('images/service'), $imageName);
            $service->image = $imageName;
        }
        if ($request->hasFile('banner')) {
            $banner = $request->file('banner');
            $bannerName = time() . '_service_' . $banner->getClientOriginalName();
            $banner->move(public_path('images/service'), $bannerName);
            $service->banner_image = $bannerName;
        }
        $service->title = $request->title;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->save();
        return redirect()->route('service.list')->with('success', 'Service added successfully.');
    }
    public function update(Request $request, $id)
    {   
        $rules = [
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ];    
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();    
        }
        $service = Service::findOrFail($id); // Retrieve the existing product by ID
        $service->name = $request->name;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_service_' . $image->getClientOriginalName();
            $image->move(public_path('images/service'), $imageName);
            $service->image = $imageName;
        }
        if ($request->hasFile('banner')) {
            $banner = $request->file('banner');
            $bannerName = time() . '_service_' . $banner->getClientOriginalName();
            $banner->move(public_path('images/service'), $bannerName);
            $service->banner_image = $bannerName;
        }
        $service->title = $request->title;
        $service->description = $request->description;
        $service->price = $request->price;
        $service->save();
        return redirect()->route('service.list')->with('success', 'Service updated successfully.');
    }
    public function destroy($id)
    {
     $service = Service::findOrFail($id);
     $service->delete();
     return redirect()->back()->with('success', 'Service deleted successfully.');
    }
    public function status_update(Request $request)
    {
        Service::where(['id' => $request['serviceId']])->update([
            'status' => $request['isChecked']
        ]);
        $response = array(
            'message' => 'Service status updated successfully.',
            'alert-type' => 'success'
        );
        return response()->json($response);
    }
}
