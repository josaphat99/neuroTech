<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require __DIR__ . '/vendor/autoload.php';
// use Twilio\Rest\Client;

// class SendSms
// {
//     //SMS sending  
//     public function send_sms($account_sid,$auth_token,$twilio_number,$receiver,$message)
//     {
//         // Your Account SID and Auth Token from twilio.com/console
//         $account_sid = $account_sid;
//         $auth_token = $auth_token;

//         /* 
//         In production, these should be environment variables. E.g.:
//         $auth_token = $_ENV["TWILIO_AUTH_TOKEN"]
//         */

//         // A Twilio number you own with SMS capabilities
//         $twilio_number = $twilio_number;

//         $client = new Client($account_sid, $auth_token);

//         $client->messages->create(            
//             $receiver, // Where to send a text message (your cell phone?)
//             array(
//                 'from' => $twilio_number,
//                 'body' => $message
//             )
//         );
//     }    
// }