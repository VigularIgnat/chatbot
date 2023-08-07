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

        if(!cache()->has("chat_id{{$chat_id}}")){
            $text= "Welcome to Ihnat projects 🤖\r\n";
            $text.= "Please upload a image";

            cache()->put("chat_id{{$chat_id}}", true,now()->addMinute(60));
        }
        
        else{
            $text='ImageDetectbot 🤖 \r\n\r\n Please upload an image';
        }

        //telegram service sendMessage($chat_id,$text,$reply_to_message)
        //$telegram_bot=new \App\Services\TelegramBot();
        $result=app('telegram_bot')->sendMessage($text, $chat_id,$reply_to_message);
        
        return responce()->json($result,200);
    }
}
