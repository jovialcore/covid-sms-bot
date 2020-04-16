<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Twilio\Rest\Client;

class covidSmsBot extends Controller
{
    public function countryCase(Request $request) {

    	$userNum = $request->input('from');
    	$countryNameSentByUser = $request->input('body');
    	$response = Http::get("https://scorona.lmao.ninja/countries/{$countryNameSentByUser}");
    	$response =  json_decode($response->body());

    	if(isset($response->message)){
    		$this->wireMessage($response->message, $userNum);
    		return;
    	}; 



    		$theReplies = "Hi 👋  Summary of covid-19 cases in" . Str::title($countryNameSentByUser). "as at". now()->toRfc850String() . "\n\n";
			
			$theReplies.="Today's cases: {$response->todayCases} \n";
			$theReplies.="Recoverd Cases: {$response->recovered} \n";
			$theReplies.="Deaths Recorded: {$response->deaths} \n";
			$theReplies.="total cases: {$response}";

			$this->wireMessage($theReplies, $userNum);
				return;
		}

    	private function wireMessage($theReplies, $reciever) {

    		$act_sid = getenv("TWILIO_ACCOUNT_SID");
    		$auth_token = getenv("TWILIO_AUTH_TOKEN");
    		$twilo_num = getenv("TWILIO_PHONE_NUMBER");

    		$twiloClientClassInst = new Client ($act_sid, $auth_token );

    		return $twiloClientClassInst->messages->create($reciever, ['from'=> $twilo_num, 'body'=> $theReplies]); 
    		//lets check if the onject json has some value
    	}




    }

