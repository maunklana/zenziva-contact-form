<?php
function send ($destination, $text){
    $destination = explode(',', $destination);
    $jml = count($destination);
    
    for($i=0; $i<=$jml-1; $i++){
	    //global $user_ID;
	    $username = get_option('zconformuserkey');
    	$password = get_option('zconformpasskey');
	    $url = get_option('zconformhttp_api');
	    
	    // REGULER http://zenziva.com/apps/smsapi.php?userkey=f21hv4&passkey=12345&nohp=6285862067888&pesan=test sms
	    
	    $content =  $url.
	    						'?userkey='.rawurlencode($username).
	                '&passkey='.rawurlencode($password).
	                '&nohp='.rawurlencode($destination[$i]).
	                '&pesan='.rawurlencode($text);
	
	    $smsglobal_response = file_get_contents($content);
	    $xmldata = new SimpleXMLElement($smsglobal_response);
	    $status = $xmldata->message[0]->text;
  	}
		if($status == "Success"){
			return "Message Sent";
		}else{
			return "Message Failed<br />".$status;
		}
		
}

function save_api($user_id, $username, $password, $url){
    update_option("zconformuserkey", $username);
    update_option("zconformpasskey", $password);
    update_option("zconformhttp_api", $url);
}

?>