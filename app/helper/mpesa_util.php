<?php 

/*GLOBAL $secret;
GLOBAL $key;
GLOBAL $paybill;
GLOBAL $passkey;
$secret="SZEiPGeDStjH03TrndqOG0LBv1kS1AeG"; 
$key="6nIrgdTGDJpKCjS4";
$paybill="174379";
$passkey="bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
*/
namespace App\helper;

 class mpesa_utils 
 {

	var $secret="SZEiPGeDStjH03TrndqOG0LBv1kS1AeG"; 
	var $key="6nIrgdTGDJpKCjS4";
	var $paybill="174379";
	var $passkey="bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
 	//var $checkoutrequestid = "";

 	function genAuthToken($con_secret,$con_key)
 	{

 		 $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
		 
		$opts = array('http' =>
		array(
		    'method'  => 'GET',
		    'header'  => "Content-Type: application/json\r\n".
		      "Authorization: Basic ".base64_encode($con_secret.':'.$con_key)."\r\n",
		    'timeout' => 60
		  )
		);
                       
		$context  = stream_context_create($opts);
		$result = file_get_contents($url, false, $context);

		$decoded_result = json_decode($result, true);

		$access_token = $decoded_result["access_token"];

		return $access_token;

 	}

 	function passGeneration($paybill_, $passkey_, $timestamp_)
 	{
 		$password = base64_encode($paybill_.$passkey_.$timestamp_);

 		return $password;
 	}


 	function onlineCheckout($phone_number,$amount)
 	{
 		$date = new \DateTime('now');
		$timestamp = $date->format('Ymdhis');
 		$pass_ = $this->passGeneration($this->paybill,$this->passkey,$timestamp);
 		$access_token = $this->genAuthToken($this->secret, $this->key);

		$url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
  
		  $curl = curl_init();
		  curl_setopt($curl, CURLOPT_URL, $url);
		  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header
		  
		  
		  $curl_post_data = array(
		    //Fill in the request parameters with valid values
		     "BusinessShortCode"=> $this->paybill,
      		"Password"=> $pass_,
      		"Timestamp"=> $timestamp,
      		"TransactionType"=> "CustomerPayBillOnline",
      		"Amount"=> $amount,
      		"PartyA"=> $phone_number,
      		"PartyB"=> $this->paybill,
      		"PhoneNumber"=> $phone_number,
        	"CallBackURL"=> "https://localhost.com",
      		"AccountReference"=> $phone_number,
      		"TransactionDesc"=>"Some desc"
		  );
		  
		  $data_string = json_encode($curl_post_data);
		  
		  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		  curl_setopt($curl, CURLOPT_POST, true);
		  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
		  
		  $curl_response = curl_exec($curl);
		  
		  $response = json_decode($curl_response, true);
		  
		  // $checkid = $response["CheckoutRequestID"];

		  return $response;

		 }

	function transactionStatus($checkoutrequestid)
	{
		// $checkoutrequestid = selectID();

		$date = new \DateTime('now');
		$timestamp = $date->format('Ymdhis');
 		$pass_ = $this->passGeneration($this->paybill,$this->passkey,$timestamp);

		$access_token = $this->genAuthToken($this->secret, $this->key);

  
		  $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpushquery/v1/query';
		  
		  $curl = curl_init();
		  curl_setopt($curl, CURLOPT_URL, $url);
		  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header
		  
		  
		  $curl_post_data = array(
		    //Fill in the request parameters with valid values
		    'BusinessShortCode' => $this->paybill,
		    'Password' => $pass_,
		    'Timestamp' => $timestamp,
		    'CheckoutRequestID' => $checkoutrequestid
		  );
		  
		  $data_string = json_encode($curl_post_data);
		  
		  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		  curl_setopt($curl, CURLOPT_POST, true);
		  curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
		  
		  $curl_response = curl_exec($curl);
		  $response = json_decode($curl_response, true);

		  // return response()->json($response);
	  
		  if ($response["ResultCode"]!="0") 
		  {
		  	
		  	$res = false;
		  
		  }else
		  {
		  	$res = true;
		  	
		  }
		 
		 // echo $curl_response;

		 return $res;
				 
		}
 }
 


 $obj = new mpesa_utils;
 //$obj->onlineCheckout("254718209288","2");
 //$obj->genAuthToken($secret,$key);
 //$obj->transactionStatus();
 //$obj->viewID();
 ?>