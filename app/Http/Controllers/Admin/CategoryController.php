<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function list(Request $request)
    {  
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('admin.category.list', compact('categories'));
    }
    public function edit($id)
    {  
        $category = Category::find($id);
        return view('admin.category.create',compact('category'));
    }
    public function store(Request $request)
    {  
        $rules = [
            'name' => 'required',
        ];  
        $messages = [
            'name.required' => 'Category name is required!',
        ];  
        $validator = Validator::make($request->all(), $rules,$messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();    
        }
        $category= new Category;
        $category->name=$request->name;
        $category->save();
        return redirect()->route('category.list')->with('success', 'Category added successfully.');
    }
    public function update(Request $request,$id)
    {  
        $rules = [
            'name' => 'required',
        ];  
        $messages = [
            'name.required' => 'Category name is required!',
        ];  
        $validator = Validator::make($request->all(), $rules,$messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();    
        }
        $category= Category::find($id);
        $category->name=$request->name;
        $category->save();
        return redirect()->route('category.list')->with('success', 'Category updated successfully.');

    }
    public function destroy($id)
    {
     $category = Category::findOrFail($id);
     $category->delete();
     return redirect()->back()->with('success', 'Category deleted successfully.');
    }
    public function status_update(Request $request)
    {
        Category::where(['id' => $request['categoryId']])->update([
            'status' => $request['isChecked']
        ]);
        // $response = [
        //     'success' => true,
        //     'message' => 'Category status updated successfully.'
        // ];
        $response = array(
            'message' => 'Category status updated successfully.',
            'alert-type' => 'success'
        );
        return response()->json($response);
    }
    public function view($id)
    {
     $categories = Category::findOrFail($id);
     return view('admin.category.view', compact('categories'));
    }
    
}
