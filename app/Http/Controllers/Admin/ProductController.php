<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function create()
    {
        $categories=Category::orderBy('created_at', 'desc')->get();
        return view('admin.product.create',compact('categories'));
    }
    public function list()
    {
        $products=Product::orderBy('created_at', 'desc')->get();
        return view('admin.product.list',compact('products'));
    }
    public function store(Request $request)
    {   
        
        
        $product = new Product();
        $product->name = $request->name;
        // dd($product->name);
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        if ($request->hasFile('images')) {
            $imageNames = [];
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/products'), $imageName);
                $imageNames[] = $imageName;
            }
            $product->images = json_encode($imageNames);
            
        }
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = time() . '_thumbnail_' . $thumbnail->getClientOriginalName();
            $thumbnail->move(public_path('images/products/thumbnail'), $thumbnailName);
            $product->thumbnail = $thumbnailName;
        } 
        $product->discount_type = $request->discount_type;
        $product->discount = $request->discount;
        $product->current_stock = $request->current_stock;
        $product->unit_price = $request->unit_price;
        $product->purchase_price = $request->purchase_price;
        $product->meta_title = $request->meta_title;
        $product->meta_keyword = $request->meta_keyword;
        $product->meta_description = $request->meta_description;
        $product->save();
        
        return redirect()->route('product.list')->with('success', 'Product created successfully.');
    }
    public function edit($id)
    {
        $categories=Category::orderBy('created_at', 'desc')->get();
        $product=Product::find($id);
        return view('admin.product.edit',compact('product','categories'));
    }
    public function update(Request $request, $id)
    {   
        $product = Product::findOrFail($id); // Retrieve the existing product by ID
        
        // Update the product attributes with values from the request
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
    
        // Handle image upload for images
        if ($request->hasFile('images')) {
            $imageNames = [];
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images/products'), $imageName);
                $imageNames[] = $imageName;
            }
            $product->images = json_encode($imageNames);
        }
    
        // Handle image upload for thumbnail
        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $thumbnailName = time() . '_thumbnail_' . $thumbnail->getClientOriginalName();
            $thumbnail->move(public_path('images/products/thumbnail'), $thumbnailName);
            $product->thumbnail = $thumbnailName;
        } 
    
        $product->discount_type = $request->discount_type;
        $product->discount = $request->discount;
        $product->current_stock = $request->current_stock;
        $product->unit_price = $request->unit_price;
        $product->purchase_price = $request->purchase_price;
        $product->meta_title = $request->meta_title;
        $product->meta_keyword = $request->meta_keyword;
        $product->meta_description = $request->meta_description;
        
        $product->save(); // Save the updated product
        
        return redirect()->route('product.list')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
     $product = Product::findOrFail($id);
     $product->delete();
     return redirect()->back()->with('success', 'Product deleted successfully.');
    }
}

