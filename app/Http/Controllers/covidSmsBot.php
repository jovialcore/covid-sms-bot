<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Twilio\Rest\Client;

class covidSmsBot extends Controller
{
    public functio countryCase (Request $request) {

    	$userNum = $request->input('from');
    	$countryNameSentByUser = $request->input('body');
    	$response = Http::get("https://scorona.lmao.ninja/countries/{$countryNameSentByUser}")l 



    	private function wireMessage ($theReplies, $reciever) {

    		$act_sid = getenv("TWILIO_ACCOUNT_SID");
    		$auth_token = getenv("TWILIO_AUTH_TOKEN");
    		$twilo_num = getenv("TWILIO_PHONE_NUMBER");

    		$twiloClientClassInst = new Client ($act_sid, $auth_token );

    		return $twiloClientClassInst->messages->create($reciever, ['from'=> $twilo_num, 'body'= $theReplies ]) 
    	} 

    }
}
