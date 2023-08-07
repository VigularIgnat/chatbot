<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TelegramController extends Controller
{
    public function inbound(Request $request){
        $chat_id=$request->message['from']['id'];
        $reply_to_message= $request->message['message_id'];

        \Log::info($chat_id);
        \Log::info($reply_to_message);
    }
}
