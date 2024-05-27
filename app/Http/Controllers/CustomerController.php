<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShippingAddress;
use App\Models\BillingAddress;
use App\Models\Service;
use App\Models\WalletTransaction;
use Razorpay\Api\Api;
use App\Models\Booking;


use Auth;

class CustomerController extends Controller
{ 
    public function booking()
    {
        $bookings = Booking::where('customer_id',Auth::user()->id)->get();
        return view('customer.booking',compact('bookings'));
    }
    public function razorpayPaymentPage(Request $request)
    {
        $service = Service::findOrFail($request->input('service_id'));
        return view('razorpay_payment', ['service' => $service]);
    }

    public function razorpayPayment(Request $request)
    {
        // Validate the request
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'amount' => 'required|numeric',
            // Add more validation rules as needed
        ]);

        // Retrieve input data
        $serviceId = $request->input('service_id');
        $amount = $request->input('amount');

        // Process payment here...
        // For Razorpay, you'll need to initialize the Razorpay API and create an order
        // Once payment is successful, handle the payment callback to update the booking details

        // Example Razorpay payment processing code:
        $api = new \Razorpay\Api\Api('rzp_test_LChA9UN9Ok4aOP', 'ZiCkxdQ7GcD90QPN5YCDlYVo');
        $order = $api->order->create([
            'amount' => $amount,
            'currency' => 'INR',
            'receipt' => 'order_receipt_'.$serviceId,
            // Add more order details as needed
        ]);

        // After successful payment, redirect user to a success page or display a success message
        return redirect()->route('paymentSuccess');
    }

    public function handlePaymentCallback(Request $request)
    {
        // Handle payment success or failure
        $paymentId = $request->input('razorpay_payment_id');
        $orderId = $request->input('razorpay_order_id');
        $signature = $request->input('razorpay_signature');

        // Verify the payment signature

        // Find the corresponding booking entry based on the order ID
        $booking = Booking::findOrFail($orderId);

        // Store payment details in the booking table
        $booking->payment_id = $paymentId;
        $booking->payment_status = 'success';
        $booking->save();

        // Redirect user to a success page or display a success message
        return redirect()->route('bookingSuccess');
    }
    public function success(Request $request)
    {
    
        $paymentId = $request->input('payment_id');
        $serviceId = $request->input('service_id');
        $astrologerId = $request->input('astrologer_id');
        $amount = $request->input('amount');
        $customer_id = $request->input('user_id');
        // Store booking data in the database
        $booking = new Booking();
        $booking->payment_id = $paymentId;
        $booking->service_id = $serviceId;
        $booking->astrologer_id = $astrologerId;
        $booking->amount = $amount;
        $booking->payment_status = 'success'; // Set payment status to 'success'
        $booking->customer_id = $customer_id;
        $booking->save();

        // Redirect or respond with success message
        return redirect()->route('bookingSuccess')->with('success', 'Booking successful! Thank you for choosing our service.');
    }
    public function bookingSuccess()
    {
        return view('payment.success');
    }
    public function wallet()
    {
        $wallets = WalletTransaction::where('user_id',Auth::user()->id)->get();
        return view('customer.wallet',compact('wallets'));

    }
    public function billing_address_add(Request $request)
    {
        $billing_address = new BillingAddress();
        $billing_address->customer_id = Auth::id();
        $billing_address->phone = $request->phone;
        $billing_address->contact_person_name = $request->contact_person_name;
        $billing_address->address = $request->address;
        $billing_address->city = $request->city;
        $billing_address->zip = $request->zip;
        $billing_address->state = $request->state;
        $billing_address->country = $request->country;
        $billing_address->save();
        return redirect()->back()->with('success', 'Billing address added successfully.');
    }
    public function billing_address_update(Request $request,$id)
    {
        $billing_address = BillingAddress::find($id);
        $billing_address->customer_id = Auth::id();
        $billing_address->phone = $request->phone;
        $billing_address->contact_person_name = $request->contact_person_name;
        $billing_address->address = $request->address;
        $billing_address->city = $request->city;
        $billing_address->zip = $request->zip;
        $billing_address->state = $request->state;
        $billing_address->country = $request->country;
        $billing_address->save();
        return redirect()->back()->with('success', 'Billing address updated successfully.');
    }
    public function shipping_address_add(Request $request)
    {
        $shipping_address = new ShippingAddress();
        $shipping_address->customer_id = Auth::id();
        $shipping_address->phone = $request->phone;
        $shipping_address->contact_person_name = $request->contact_person_name;
        $shipping_address->address = $request->address;
        $shipping_address->city = $request->city;
        $shipping_address->zip = $request->zip;
        $shipping_address->state = $request->state;
        $shipping_address->country = $request->country;
        $shipping_address->save();
        return redirect()->back()->with('success', 'Shipping address added successfully.');
    }
    public function shipping_address_update(Request $request,$id)
    {
        $shipping_address = ShippingAddress::find($id);
        $shipping_address->customer_id = Auth::id();
        $shipping_address->phone = $request->phone;
        $shipping_address->contact_person_name = $request->contact_person_name;
        $shipping_address->address = $request->address;
        $shipping_address->city = $request->city;
        $shipping_address->zip = $request->zip;
        $shipping_address->state = $request->state;
        $shipping_address->country = $request->country;
        $shipping_address->save();
        return redirect()->back()->with('success', 'Shipping address updated successfully.');
    }
    public function address()
    {
        $shipping = ShippingAddress::where('customer_id', Auth::id())->first();
        $billing = BillingAddress::where('customer_id', Auth::id())->first();
        return view('customer.address',compact('shipping','billing'));

    }
    public function delete_billing_address($id)
    {
        $billing = BillingAddress::find($id);
        $billing->delete();
        return redirect()->back()->with('success', 'Billing address deleted successfully.');
    }
    public function delete_shipping_address($id)
    {
        $shipping = ShippingAddress::find($id);
        $shipping->delete();
        return redirect()->back()->with('success', 'Shipping address deleted successfully.');
    }

}
