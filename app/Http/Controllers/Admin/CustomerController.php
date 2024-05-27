<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function customer_list(Request $request)
    {  
        $customers = User::orderBy('created_at', 'desc')->get();
        return view('admin.customer.list', compact('customers'));
    }
    public function status_update(Request $request)
    {
        User::where(['id' => $request['customerId']])->update([
            'is_active' => $request['isChecked']
        ]);
        $response = [
            'success' => true,
            'message' => 'Customer status updated successfully.'
        ];

        return response()->json($response);
    }
    public function destroy($id)
    {
     $customer = User::findOrFail($id);
     $customer->delete();
     return redirect()->back()->with('success', 'Customer deleted successfully.');
    }
    public function view($id)
    {
     $customer = User::findOrFail($id);
     $wallets = WalletTransaction::where('user_id',$customer->id)->get();
     return view('admin.customer.view', compact('customer','wallets'));
    }


}
