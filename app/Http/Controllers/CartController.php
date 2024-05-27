<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Models\ShippingAddress;
use App\Models\BillingAddress;
// use Gloudemans\Shoppingcart\Facades\Cart;
use Auth;

class CartController extends Controller
{
    public function store_address(Request $request)
    {
        $shipping_address = ShippingAddress::where('customer_id', Auth::id())->first();
        if ($shipping_address) {
            $shipping = ShippingAddress::find($shipping_address->id);
            $shipping->phone = $shipping_address->phone;
            $shipping->contact_person_name = $shipping_address->contact_person_name;
            $shipping->address = $shipping_address->address;
            $shipping->city = $shipping_address->city;
            $shipping->zip = $shipping_address->zip;
            $shipping->state = $shipping_address->state;
            $shipping->country = $shipping_address->country;
            $shipping->is_billing = $request->has('same_address') ? true : false;
            $shipping->save();
        } else {
            $shipping_address = new ShippingAddress();
            $shipping_address->customer_id = Auth::id();
            $shipping_address->contact_person_name = $request->contact_person_name;
            $shipping_address->phone = $request->phone;
            $shipping_address->address = $request->address;
            $shipping_address->city = $request->city;
            $shipping_address->zip = $request->zip;
            $shipping_address->state = $request->state;
            $shipping_address->country = $request->country;
            $shipping_address->is_billing = $request->has('same_address') ? true : false;
            $shipping_address->save();
        }
        if ($request->same_address != 'on') {
            // Check if the authenticated user already has a billing address
            $billing_address = BillingAddress::where('customer_id', Auth::id())->first();
            
            // If a billing address exists, update it; otherwise, create a new one
            if ($billing_address) {
                $billing=BillingAddress::find($billing_address->id);
                $billing->phone = $billing_address->phone;
                $billing->contact_person_name = $billing_address->contact_person_name;
                $billing->address = $billing_address->address;
                $billing->city = $billing_address->city;
                $billing->zip = $billing_address->zip;
                $billing->state = $billing_address->state;
                $billing->country = $billing_address->country;
                $billing->save();
            } else {
                $billing_address = new BillingAddress();
                $billing_address->customer_id = Auth::id();
                $billing_address->phone = $request->b_phone;
                $billing_address->contact_person_name = $request->b_contact_person_name;
                $billing_address->address = $request->b_address;
                $billing_address->city = $request->b_city;
                $billing_address->zip = $request->b_zip;
                $billing_address->state = $request->b_state;
                $billing_address->country = $request->b_country;
                $billing_address->save();
            }
        }
        return redirect()->route('payment');
    }
    public function payment()
    {
        if (Auth::check()) {
            $cart = Cart::where('customer_id', Auth::id())
                ->get();
        }
        return view('payment',compact('cart'));
    }
    public function checkStock(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
    
        $product = Product::find($productId);
    
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
    
        if ($quantity > $product->current_stock) {
            return response()->json(['error' => 'Stock limit exceeded'], 422);
        }
    
        return response()->json(['success' => true]);
    }
    public function cart()
    {
        if (Auth::check()) {
            $cart = Cart::where('customer_id', Auth::id())
                ->get();
        }
        if($cart->count()!=0){
            return view('cart',compact('cart'));
        }
        else
        {
            return redirect('/');
        }
        

    }
    public function checkout()
    {
        if (Auth::check()) {
            $cart = Cart::where('customer_id', Auth::id())
                ->get();
        }
        return view('checkout',compact('cart'));
    }
    public function addToCart($id)
    {
        $product = Product::findOrFail($id);
        if($product->current_stock>0){
           // If user is authenticated, store cart item in database
            if (Auth::check()) {
                // Check if the product already exists in the user's cart
                $existingCartItem = Cart::where('product_id', $id)
                    ->where('customer_id', Auth::id())
                    ->first();
        
                if ($existingCartItem) {
                    return redirect()->back()->with('warning', 'Product already added to cart!');
                } else {
                    $cartItem = new Cart();
                    $cartItem->customer_id = Auth::id();
                    $cartItem->product_id = $id;
                    $cartItem->name = $product->name;
                    $cartItem->thumbnail = $product->thumbnail;
                    $cartItem->quantity = 1;
                    if ($product->discount_type == 'flat') {
                        $dis = $product->discount;
                    } elseif ($product->discount_type == 'percent') {
                        $dis = ($product->unit_price * $product->discount) / 100;
                    }
                    
                    $cartItem->price = $product->unit_price;
                    $cartItem->discount = $dis;
                    $cartItem->save();
                }
            } else {
                // If user is not authenticated, store cart item in session
                $cart = session()->get('cart', []);
        
                if (isset($cart[$id])) {
                    return redirect()->back()->with('warning', 'Product already added to cart!');
                } else {
                    if ($product->discount_type == 'flat') {
                        $dis = $product->discount;
                    } elseif ($product->discount_type == 'percent') {
                        $dis = ($product->unit_price * $product->discount) / 100;
                    }
                    $cart[$id] = [
                        "name" => $product->name,
                        "quantity" => 1,
                        "price" => $product->unit_price,
                        "thumbnail" => $product->thumbnail,
                        "discount" => $dis
                    ];
                }
        
                session()->put('cart', $cart);
            }
            return redirect()->back()->with('success', 'Product added to cart successfully!');

        }else{
            return redirect()->back()->with('warning', 'Out of stock!');
        }

    
    }
    public function cartContent()
    {
        // Retrieve cart items or build HTML content for the cart here
        // For simplicity, let's assume $cartHtml contains the HTML content of the cart
        
        // You can build the HTML content based on the authenticated user's cart items
        
        // Build HTML content for the cart based on $cartItems
        $cartHtml = view('layouts.frontend.partial.cart')->render();
        
        return $cartHtml;
    }



  
    /**
     * Write code on Method
     *
     * @return response()
     */
    // public function update(Request $request)
    // {
    //     if($request->id && $request->quantity){
    //         $cart = Cart::where('product_id',$request->id)->where('customer_id',Auth::id())->get();
    //         $cart->quantity = $request->quantity;
    //         $cart->save();
    //         session()->flash('success', 'Cart updated successfully');
    //     }
    // }
    public function update(Request $request)
    {
    if($request->id && $request->quantity && $request->quantity>0){
        $cart = Cart::where('id', $request->id)
                    ->where('customer_id', Auth::id())
                    ->first(); // Retrieve the cart item
        
        if ($cart) {
            $cart->quantity = $request->quantity; // Update the quantity
            $cart->save(); // Save the changes
            
            session()->flash('success', 'Cart updated successfully');
        } else {
            session()->flash('error', 'Cart item not found');
        }
    } else {
        session()->flash('error', 'Minimum order quantity can not be less than 1');
    }
}

  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
        
    }
    public function remove_cart(Request $request)
    {
    
        if($request->id) {
            $cart = Cart::find($request->id);            
            $cart->delete();
            $remainingItems = Cart::where('customer_id', Auth::id())->count(); // Count the remaining items in the cart
            
        if ($remainingItems == 0) {
            return redirect('/')->with('success', 'Product removed successfully'); // Redirect to shop page if cart is empty
        }
            
            session()->flash('success', 'Product removed successfully');
        }
    }
    public function updateNavCart()
    {
        return response()->json(['data' => view('layouts.frontend.partial.cart')->render()]);
    }
    // public function cart()
    // {
    //     dd(Cart::content());
    //     // return view('cart');
    // }
    // public function addToCart(Request $request)
    // {
    //     $product = Product::find($request->id);
    //     if($product == null) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => 'Product not found'
    //         ]);
    //     }
    //     if(Cart::count() > 0) {
    //         $cartContent = Cart::content();
    //         $productAlreadyExist = false;
    //         foreach ($cartContent as $item) {
    //             if($item->id == $product->id) {
    //                 $productAlreadyExist = true;
    //             }
    //         }
    //         if($productAlreadyExist == false){
    //             Cart::add($product->id,$product->name,1,$product->unit_price,['productImage' => $product->thumbnail]);
    //             $status = true;
    //             $message = 'Added in cart'; 
    //         } else {
    //             $status = false;
    //             $message = 'Already added in cart'; 
    //         }

    //     } else {
    //         Cart::add($product->id,$product->name,1,$product->unit_price,['productImage' => $product->thumbnail]);
    //         $status = true;
    //         $message = 'Added in cart';
    //     }
    //     return response()->json([
    //         'status' => $status,
    //         'message' => $message
    //     ]);
         
    // }

}
