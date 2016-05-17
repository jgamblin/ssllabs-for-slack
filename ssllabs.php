<?php

require_once 'ssllabsapi.php';
$text = $_POST['text'];
//Return API response as JSON string
$api = new sslLabsApi();

//Return API response as JSON object
//$api = new sslLabsApi(true);

//Set content-type header for JSON output
header('Content-Type: application/json');

//get API information
$data = $api->fetchHostInformation($text);
$json = json_decode($data, true);


#Send the reply back to the use
if ($json['status']  == 'READY'){
	$reply = "The SSLLabs TLS score for ".$json['host']. " is an " .$json['endpoints']['0']['grade']."\n";
}
if ($json['status'] !== 'READY'){
        $reply = "Starting a Scan. Rerun in 3 minutes to see results.";
}


print_r($reply);
#print_r($json);
