<?php 
defined('BASEPATH') OR exit('No direct script access allowed'); 
Class Notification_Model extends CI_Model{
	
	public function send_notification($fcm_token,$msg){
    
        $apiKey = "AAAAkarirj0:APA91bHpxTiqhhRAD-aTGfwKNEi3TATDRVx2J2Dn3vunE-QVxVx-uADIqbAlrYqLk86OdbtmWkaxVhh9R7wQAEdZCFz1-eFj5ZuvT7ijjEx1pK6p47h48YCJ4D3CuzXNE9aCx6mWeZ0J";
        
        $registrationIDs = array($fcm_token);
        
        $url = 'https://fcm.googleapis.com/fcm/send';
        
        $fields = array(
        'registration_ids' => $registrationIDs,
        'data' => array( "message" => $msg ),
        );
        
        $headers = array(
        'Authorization: key=' . $apiKey,
        'Content-Type: application/json'
        );
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode( $fields));
        $result = curl_exec($ch);
        curl_close($ch);
        //echo $result;echo '<br><br>';//
    }
}
