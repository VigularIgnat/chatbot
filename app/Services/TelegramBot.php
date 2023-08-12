<?php

namespace App\Services;
use Illuminate\Support\Facades\Http;
class TelegramBot
{
    protected $token;
    protected $api_endpoint;
    protected $headers;

    public function __construct(){
        $this->token=env('TELEGRAM_BOT_USER');
        $this->api_endpoint=env('TELEGRAM_API_ENDPOINT');
        $this->setHeaders();
    }

    protected function setHeaders(){
        $this->headers=[
            "Content-Type"=>"application/json",
            "Accept"=>"application/json",
        ];
    }

    public function sendMessage($text='', $chat_id, $reply_to_message_id){
        
        //Default result array
        $result=['success'=>false, 'body'=>[]]; 

        //Create params array
        $params=[
            'chat_id'           =>$chat_id,
            'reply_to_message_id'  =>$reply_to_message_id,
            'text'           =>$text
        ];

        $url="{$this->api_endpoint}/{$this->token}/sendMessage";
        //Send the request
        try{
            $response=Http::withHeaders($this->headers)->post($url, $params);
            $result=['success'=>$response->ok(), 'body'=>$response->json()]; 

        }catch(\Throwable $th){
            $result['error']=$th->getMessage();
        }
        \Log::info('TelegramBot->sendMessage->result',['result'=>$result]);
        \Log::info("url",$url);
        return $result;
    }
}