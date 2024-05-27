<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Cart;
use App\Models\ShippingAddress;
use App\Models\BillingAddress;
use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class WebController extends Controller
{
    public function checkout_complete()
    {
        return view('checkout-complete');
    }
    public function about_us()
    {
        return view('about_us');
    }
    public function blog()
    {
        return view('blog');
    }
    public function contact()
    {
        return view('contact');
    }
    public function services()
    {
        return view('service');
    }
    public function service_details($id)
    {
        $service = Service::find($id);
        $lists = Service::where('status',1)->get();
        return view('service_details',compact('lists','service'));
    }

    public function shop(Request $request)
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        $query = Product::query();
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }
        else if ($request->has('sort_by') && $request->sort_by == 'name') {
            $query->orderBy('name');
        }
        else if ($request->has('sort_by') && $request->sort_by == 'price_low_to_high') {
            $query->orderBy('unit_price', 'asc');
        }
        else if ($request->has('sort_by') && $request->sort_by == 'price_high_to_low') {
            $query->orderBy('unit_price', 'desc');
        }
        else if ($request->has('latest') && $request->sort_by == 'latest') {
            $query->orderBy('created_at', 'desc');
        }
        else
        {
            $query->orderBy('created_at','desc');
            
        }
        $products = $query->simplepaginate(15);
        return view('shop', compact('products', 'categories'));
    }
    public function product_details($id)
    {
        $popular_products=Product::orderBy('created_at', 'desc')->get();
        $product=Product::find($id);
        return view('product_details',compact('product','popular_products'));
    }
    public function order_by_cash(Request $request)
    {
        if($request->payment_method != 'cash_on_delivery'){
            return back()->with('error', 'Something went wrong!');
        }
        $unique_id = rand(1000, 9999) . '-' . Str::random(5) . '-' . time();
        $order_id = 100000 + Order::all()->count() + 1;
        if (Order::find($order_id)) {
           $order_id = Order::orderBy('id', 'DESC')->first()->id + 1;
        }
        $user_id = Auth::user()->id;
        $cart = Cart::where('customer_id',$user_id)->get();
        $total = 0;
        if (!empty($cart)) {
            foreach ($cart as $item) {
                $product_subtotal = ($item['price'] * $item['quantity'])- $item['discount'] * $item['quantity'];
                $total += $product_subtotal;
            }
        }
        $address = ShippingAddress::where('customer_id',$user_id)->first();
        if($address->is_billing == 1)
        {
            $billing_address = ShippingAddress::where('customer_id',$user_id)->first();
        }
        else
        {
            $billing_address = BillingAddress::where('customer_id',$user_id)->first();
        }
        $or = [
            'id' => $order_id,
            'verification_code' => rand(100000, 999999),
            'customer_id' => Auth::user()->id,
            'payment_method' => 'cash_on_delivery',
            'order_status' => 'pending',
            'payment_status' => 'unpaid',
            'transaction_ref' => '',
            'discount_type' => '',
            'order_amount' => $total,
            'shipping_address_data' => $address,
            'billing_address_data' => $billing_address,
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('orders')->insertGetId($or);
        $cart= Cart::where('customer_id', Auth::id())->get();
        foreach($cart as $c)
        {
            $product = Product::where(['id' => $c['product_id']])->first();
            $or_d = [
                'order_id' => $order_id,
                'product_id' => $c['product_id'],
                'product_details' => $product,
                'qty' => $c['quantity'],
                'price' => $c['price'],
                'discount' => $c['discount'] * $c['quantity'],
                'discount_type' => 'discount_on_product',
                'delivery_status' => 'pending',
                'payment_status' => 'unpaid',
                'created_at' => now(),
                'updated_at' => now()
            ];


            Product::where(['id' => $product['id']])->update([
                'current_stock' => $product['current_stock'] - $c['quantity']
            ]);

            DB::table('order_details')->insert($or_d);
            Cart::where('id', $c['id'])->delete();
        }
        
        return redirect()->route('checkout-complete');
        

    }
    public function order_by_wallet(Request $request = null)
    {
        $user = Auth::user();
        $cart = Cart::where('customer_id',$user->id)->get();
        $cart_total = 0;
        if (!empty($cart)) {
            foreach ($cart as $item) {
                $product_subtotal = ($item['price'] * $item['quantity'])- $item['discount'] * $item['quantity'];
                $cart_total += $product_subtotal;
            }
        }
        if( $cart_total > $user->wallet_balance)
        {
            return back()->with('warning','inefficient balance in your wallet to pay for this order!!');
        }else{
            $unique_id = rand(1000, 9999) . '-' . Str::random(5) . '-' . time();
            $order_id = 100000 + Order::all()->count() + 1;
            if (Order::find($order_id)) {
               $order_id = Order::orderBy('id', 'DESC')->first()->id + 1;
            }
            
            $address = ShippingAddress::where('customer_id',$user->id)->first();
            if($address->is_billing == 1)
            {
                $billing_address = ShippingAddress::where('customer_id',$user->id)->first();
            }
            else
            {
                $billing_address = BillingAddress::where('customer_id',$user->id)->first();
            }
            $or = [
                'id' => $order_id,
                'verification_code' => rand(100000, 999999),
                'customer_id' => Auth::user()->id,
                'payment_method' => 'pay_by_wallet',
                'order_status' => 'confirmed',
                'payment_status' => 'paid',
                'transaction_ref' => '',
                'discount_type' => '',
                'order_amount' => $cart_total,
                'shipping_address_data' => $address,
                'billing_address_data' => $billing_address,
                'created_at' => now(),
                'updated_at' => now(),
            ];
            DB::table('orders')->insertGetId($or);
            $cart= Cart::where('customer_id', Auth::id())->get();
            foreach($cart as $c)
            {
                $product = Product::where(['id' => $c['product_id']])->first();
                $or_d = [
                    'order_id' => $order_id,
                    'product_id' => $c['product_id'],
                    'product_details' => $product,
                    'qty' => $c['quantity'],
                    'price' => $c['price'],
                    'discount' => $c['discount'] * $c['quantity'],
                    'discount_type' => 'discount_on_product',
                    'delivery_status' => 'pending',
                    'payment_status' => 'paid',
                    'created_at' => now(),
                    'updated_at' => now()
                ];
    
    
                Product::where(['id' => $product['id']])->update([
                    'current_stock' => $product['current_stock'] - $c['quantity']
                ]);
    
                DB::table('order_details')->insert($or_d);
                Cart::where('id', $c['id'])->delete();
            }        
        }

        return redirect()->route('checkout-complete');
    }
    public function order()
    {
        $orders = Order::where('customer_id',Auth::user()->id)->get();
        return view('customer.order',compact('orders'));
    }
    public function order_details($id)
    {
        $order = Order::with(['details.product'])->find($id);
        return view('customer.order-details', compact('order'));
    }
    // public function generate_invoice($id)
    // {
    //     $order = Order::where('id', $id)->first();
    //     $data["email"] = $order->customer["email"];
    //     $data["order"] = $order;

    //     $mpdf_view = \View::make('customer.invoice', compact('order'));
    //     $mpdf = new \Mpdf\Mpdf(['default_font' => 'FreeSerif', 'mode' => 'utf-8', 'format' => [190, 250]]);
    //     /* $mpdf->AddPage('XL', '', '', '', '', 10, 10, 10, '10', '270', '');*/
    //     $mpdf->autoScriptToLang = true;
    //     $mpdf->autoLangToFont = true;

    //     $mpdf_view = $view;
    //     $mpdf_view = $mpdf_view->render();
    //     $mpdf->WriteHTML($mpdf_view);
    //     $mpdf->Output($file_prefix . $file_postfix . '.pdf', 'D');
    // }
    public function generate_invoice($id)
    {
        // Generate PDF invoice (you'll need to implement this)
        $order = Order::where('id', $id)->first();
        $pdf = PDF::loadView('customer.invoice', ['order' => $order])->setOptions(['defaultFont' => 'sans-serif']);

        // Download the PDF
        return $pdf->download('invoice_'.$order->id.'.pdf');
        
    }
}
