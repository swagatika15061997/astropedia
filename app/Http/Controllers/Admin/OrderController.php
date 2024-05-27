<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ShippingAddress;
use App\Models\BillingAddress;


class OrderController extends Controller
{
    public function list()
    {
        $orders = Order::all();
        return view('admin.order.list',compact('orders'));
    }
    public function details($id)
    {
        $order = Order::with('details.product')->where(['id' => $id])->first();
        $total_delivered = Order::where(['order_status' => 'delivered'])->count();
        
        return view('admin.order.order-details', compact('order', 'total_delivered'));
        

    }
    public function updateOrderStatus(Request $request)
    {
        $orderId = $request->input('order_id');
        $newStatus = $request->input('new_status');

        // Find the order
        $order = Order::find($orderId);
        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found']);
        }

        // Update order status
        $order->order_status = $newStatus;
        $order->save();

        return response()->json(['success' => true, 'message' => 'Order status updated successfully']);
        
    }
    public function updatePaymentStatus(Request $request)
    {
        $orderId = $request->input('order_id');
        $newStatus = $request->input('new_status');

        // Find the order
        $order = Order::find($orderId);
        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found']);
        }

        // Update order status
        $order->payment_status = $newStatus;
        $order->save();

        return response()->json(['success' => true, 'message' => 'Payment status updated successfully']);
        
    }
}
