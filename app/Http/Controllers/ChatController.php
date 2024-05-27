<?php

namespace App\Http\Controllers;
use App\Models\Astrologer;
use App\Models\WalletTransaction;
use App\Models\ChatRequest;
use App\Models\Chat;
use App\Events\ChatRequestSent;
use App\Events\ChatRequestUser;
use App\Notifications\ChatNotification;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use Auth;

class ChatController extends Controller
{
    public $api;
    public function __construct($foo = null)
    {
        $this->api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));

    }

    public function astrologer()
    {
        $astrologers = Astrologer::where('status','approved')->get();
        return view('astrologer',compact('astrologers'));
    }
    public function chat_request_add($id)
    {
        $astrologer = Astrologer::find($id);
        if (Auth::check()) {
            $user = Auth::user();
            $existingRequest = ChatRequest::where('user_id', $user->id)
            ->where('astrologer_id', $astrologer->id)
            ->whereIn('status', ['pending', 'accepted'])
            ->first();            
           if ($existingRequest) {
              return redirect()->back()->with('warning', 'You already have sent one chat request with this astrologer.');
           }
            if ($astrologer->free_status == 1 && $user->free_min > 0) {
                ChatRequest::create([
                    'user_id' => $user->id,
                    'astrologer_id' => $astrologer->id,
                    'status' => 'pending',
                    'isFreeSession' => 1
                ]);
                event(new ChatRequestUser($user->name, $astrologer->id));  
                $message = 'You have a new chat request from ' . $user->name;
                $astrologer->notify(new ChatNotification($user, $astrologer, $message));
            } else {
                $user_wallet = $user->wallet_balance;
                $min_recharge_balance = $astrologer->charge * 5;
                if($user_wallet >= $min_recharge_balance)
                {
                    ChatRequest::create([
                        'user_id' => $user->id,
                        'astrologer_id' => $astrologer->id,
                        'status' => 'pending',
                        'isFreeSession' => 0
                    ]);   
                    event(new ChatRequestUser($user->name, $astrologer->id));  
                    $message = 'You have a new chat request from ' . $user->name;
                    $astrologer->notify(new ChatNotification($user, $astrologer, $message));
                }
                else{
                    $min_recharge = $astrologer->charge * 5;
                    return redirect()->back()->with('warning', 'Wallet balance should be greater than or equal to ' . $min_recharge . ', which is five mins chats with the astrologer.');
                }
                 
                
            }
            return redirect()->back()->with('success', 'Chat request sent successfully');
        } else {
            return redirect()->route('login');
        }
    }
    public function cancelChatRequest($id)
    {
        $chat = ChatRequest::find($id);
        $chat->delete();
        return redirect()->back()->with('success', 'Chat request cancelled successfully');


    }
    public function wallet_recharge()
    {
        return view('wallet-recharge');
    }
    public function store_wallet_recharge(Request $request)
    {
        $this->validate($request,[
            'amount' => 'required|numeric',
        ]);
        $orderData = [
            'receipt'         => 'rcptid_11',
            'amount'          => ($request->get('amount')*100), // 39900 rupees in paise
            'currency'        => 'INR'
        ];
        
        $razorpayOrder = $this->api->order->create($orderData);
        // dd($razorpayOrder);
        // die();
        return view('razor-payment',compact('razorpayOrder'));
        

    }
    public function success(Request $request)
    {
        $status = $this->api->payment->fetch($request->get('payment_id'));
        $amount = $status->amount/100;
        if($status->status=='captured')
        {
            $user = Auth::user();
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
            return redirect()->route('astrologer')->with('success', 'Wallet recharged successfully');
        }
        else{
            return redirect()->back()->with('error', 'Payment failed');
        }
        
    }
    public function chat_request()
    {
        $last_chat = Chat::with(['astrologer'])->where('user_id', Auth::user()->id)
                ->whereNotNull(['astrologer_id', 'user_id'])
                ->orderBy('created_at', 'DESC')
                ->first();
        if (isset($last_chat)) {
            $chattings = Chat::join('astrologers', 'astrologers.id', '=', 'chats.astrologer_id')
                ->select('chats.*', 'astrologers.name', 'astrologers.image')
                ->where('chats.user_id', Auth::user()->id)
                ->where('astrologer_id', $last_chat->astrologer_id)
                ->get();
            $unique_astrologers = Chat::join('astrologers', 'astrologers.id', '=', 'chats.astrologer_id')
                ->select('chats.*', 'astrologers.name', 'astrologers.image')
                ->where('chats.user_id', Auth::user()->id)
                ->orderBy('chats.created_at', 'desc')
                ->get()
                ->unique('astrologer_id');
                return view('customer.chat',compact('chattings','unique_astrologers','last_chat'));           
             }
             return view('customer.chat'); 
        
    }
    public function chat($id)
    {

            $chattings = Chat::join('astrologers', 'astrologers.id', '=', 'chats.astrologer_id')
                ->select('chats.*', 'astrologers.name', 'astrologers.image')
                ->where('chats.user_id', Auth::user()->id)
                ->where('astrologer_id', $id)
                ->get();
            $unique_astrologers = Chat::join('astrologers', 'astrologers.id', '=', 'chats.astrologer_id')
                ->select('chats.*', 'astrologers.name', 'astrologers.image')
                ->where('chats.user_id', Auth::user()->id)
                ->orderBy('chats.created_at', 'desc')
                ->get()
                ->unique('astrologer_id');
                return view('chat',compact('chattings','unique_astrologers'));           
             
             return view('chat'); 
        
    }
}
