<?php

namespace App\Http\Controllers\Api\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Astrologer;
use App\Models\ChatRequest;
use App\Events\ChatRequestUser;
use Auth;
use DB;

class ChatController extends Controller
{
    public function chatRequestAdd(Request $request, $id)
    {
       $user = Auth::guard('api')->user();
       if (!$user) {
           return response()->json(['message' => 'Unauthorized access'], 401);
       }
       
       $astrologer = Astrologer::find($id);
       if (!$astrologer) {
           return response()->json(['error' => true, 'message' => 'Astrologer not found.'], 404);
       }
        $existingRequest = ChatRequest::where('user_id', $user->id)
            ->where('astrologer_id', $astrologer->id)
            ->whereIn('status', ['pending', 'accepted'])
            ->first();
        if ($existingRequest) {
            return response()->json(['error' => true, 'message' => 'You already have sent one chat request with this astrologer.'], 400);
        }
        if ($astrologer->free_status == 1 && $user->free_min > 0) {
            ChatRequest::create([
                'user_id' => $user->id,
                'astrologer_id' => $astrologer->id,
                'status' => 'pending',
                'isFreeSession' => 1
            ]);
            event(new ChatRequestUser($user->name, $astrologer->id));
            $message = [
                'title' => "New Chat Request!",
                'body' => 'You have a new chat request from ' . $user->name
            ];
            $this->send_single_notification($message, [$astrologer->device_id]);
        } else {
            $user_wallet = $user->wallet_balance;
            $min_recharge_balance = $astrologer->charge * 5;
            if ($user_wallet >= $min_recharge_balance) {
                ChatRequest::create([
                    'user_id' => $user->id,
                    'astrologer_id' => $astrologer->id,
                    'status' => 'pending',
                    'isFreeSession' => 0
                ]);
                event(new ChatRequestUser($user->name, $astrologer->id));
                $message = [
                    'title' => "New Chat Request!",
                    'body' => 'You have a new chat request from ' . $user->name
                ];
                $this->send_single_notification($message, [$astrologer->device_id]);
            } else {
                $min_recharge = $astrologer->charge * 5;
                return response()->json(['error' => true, 'message' => 'Wallet balance should be greater than or equal to ' . $min_recharge . ', which is five mins chats with the astrologer.'], 400);
            }
        }
        return response()->json(['error' => false, 'message' => 'Chat request sent successfully'], 200);
    }
    private function send_single_notification($fcmMsg, $registrationIDs)
    {
       $fcmFields = [
           'registration_ids' => $registrationIDs,
           'priority' => 'high',
           'notification' => $fcmMsg,
           'data' => $fcmMsg,
       ];
       $key = 'AAAASEpUYLw:APA91bF5gjwbjqRMMlP3DmkBF-Pg8m2X2ktRM3XQCrfUuVAMAb8hXyorvwVymr9kCXfKgEzZWakzCASpkMnV-oqgnTLzITb5429G1Z97mdIr0rZFPFqn9Hmv5H0w-DyFni870_Zmm5FM';
       $headers = [
           'Authorization: key=' . $key,
           'Content-Type: application/json',
       ];

       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
       curl_setopt($ch, CURLOPT_POST, true);
       curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
       curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
       $result = curl_exec($ch);
       curl_close($ch);
       return $result;
    }
    public function chat_request_list(Request $request)
    {
       $user = Auth::guard('api')->user();
       if (!$user) {
           return response()->json(['message' => 'Unauthorized access'], 401);
       }
       $chatRequests = DB::table('chat_requests')
        ->join('astrologers', 'chat_requests.astrologer_id', '=', 'astrologers.id')
        ->where('chat_requests.user_id', $user->id)
        ->select(
            'chat_requests.id',
            'chat_requests.astrologer_id',
            'chat_requests.status',
            'chat_requests.created_at',
            'astrologers.name as astrologer_name',asset('images/profile/' . $user->image)
            DB::raw("CONCAT('storage/images/', astrologers.image) as astrologer_image")
        )
        ->orderBy('chat_requests.created_at', 'desc')
        ->get();

        if (!$chatRequests->isEmpty()) {
            return response()->json([
                'error' => false,
                'message' => 'Chat Request List',
                'data' => $chatRequests
            ]);
        } else {
            return response()->json([
                'error' => false,
                'message' => 'No Chat Requests Found',
                'data' => []
            ]);
        }
       
    }
}
