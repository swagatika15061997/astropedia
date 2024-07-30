<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\WalletTransaction;
use Illuminate\Support\Facades\Validator;
use Razorpay\Api\Api;
use Auth;

class WelletController extends Controller
{

    public function index()
    {
        $user = Auth::guard('api')->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized access'], 401);
        }
        $wallets = WalletTransaction::where('user_id', $user->id)->get();
        return response()->json(['wallet_transaction'=>$wallets]);
    }
    public function razor_pay(Request $request)
    {
        $user = Auth::guard('api')->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized access'], 401);
        }
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
        ]);   
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $user_id = $user->id;
        $wallet_recharge_id = 'WalletRecharge_' . uniqid();
        $api_key = 'rzp_test_P9DP2EL6CIqXZw';
        $api_secret = 'sX9gYPkAbm4eQFyeNjV1aWHA';
        $razorpay = new Api($api_key, $api_secret);

        // Create an order using the Razorpay API
        $order = $razorpay->order->create([
            'receipt' => $wallet_recharge_id,
            'amount' => $request->amount * 100, // Razorpay accepts amounts in paise, so multiply by 100
            'currency' => 'INR', // Change to your desired currency code
        ]);
        return response()->json(['razorpay_order_id' => $order['id']]);
    }
    public function success(Request $request)
    {
        $user = Auth::guard('api')->user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized access'], 401);
        }
        if ($request->get('payment_id')) {
        $api_key = 'rzp_test_P9DP2EL6CIqXZw';
        $api_secret = 'sX9gYPkAbm4eQFyeNjV1aWHA';
        $razorpay = new Api($api_key, $api_secret);
        $status = $razorpay->payment->fetch($request->get('payment_id'));
        $amount = $status->amount/100;
        if($status->status=='captured')
        {
            $avail_wallet_transaction = WalletTransaction::where('user_id',$user->id)->first();
            if(!$avail_wallet_transaction){
                $additional_amount = $amount;
                $request->amount *= 2;
            }
            else{
                $additional_amount = 0;
            }
            $walletTransaction = new WalletTransaction();
            $walletTransaction->user_id = $user->id;
            $walletTransaction->amount = $amount;
            $walletTransaction->transaction_type = 'credit';
            $walletTransaction->message = "Wallet recharge";
            $walletTransaction->created_at = now();
            $walletTransaction->updated_at = now();
            $walletTransaction->save();
    
            $user->wallet_balance += $walletTransaction->amount;
            $user->save();
            if ($additional_amount > 0) {
                $additionalTransaction = new WalletTransaction();
                $additionalTransaction->user_id = $user->id;
                $additionalTransaction->amount = $additional_amount;
                $additionalTransaction->transaction_type = 'credit';
                $additionalTransaction->message = "First recharge bonus";
                $additionalTransaction->created_at = now();
                $additionalTransaction->updated_at = now();
                $additionalTransaction->save();
        
                // Update user's wallet balance with the additional amount
                $user->wallet_balance += $additionalTransaction->amount;
                $user->save();
            }
            return response()->json(['message' => 'Wallet recharged successfully'], 200);
        }
        else{
            return response()->json(['message' => 'Payment failed'], 401);
        }}
        else{
            return response()->json(['message' => 'payment id required'], 401);
        }
        
    }
}
