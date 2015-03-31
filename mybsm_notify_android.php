<?php
ini_set('soap.wsdl_cache_enabled',0);
ini_set('soap.wsdl_cache_ttl',0);
header('Content-type: application/json');

$http_origin = $_SERVER['HTTP_ORIGIN'];
if ($http_origin == "https://www.getvesseltracker.com" || $http_origin == "https://getvesseltracker.com")
{ 
   header('Access-Control-Allow-Origin: *');
}

ini_set('max_execution_time', 300);
ini_set('memory_limit', '-1');
/*ini_set('display_errors',true);
error_reporting(E_ALL);*/
// Replace with real BROWSER API key from Google APIs


function push_to_mob_android($reg_key, $alert_stat) {
  $reg_key = $reg_key[0];
 /* echo "\xA";
  echo "::->".$reg_key."<";
  echo "\xA";*/
  $apiKey = "AIzaSyAMXs643T7HPa_5x1Tax5O_yJl7eG0GUws";

  // Replace with real client registration IDs 
  $registrationIDs = array($reg_key);

  // Message to be sent
 // $message = "AdHoc invoice $5,600 with XYZ shipping.";

  // Set POST variables
  $url = 'https://android.googleapis.com/gcm/send';

  $fields = array(
                  'registration_ids'  => $registrationIDs,
                  'data'              => array( "message" => $alert_stat,
                                                'title' => $alert_stat,
                                                //'invoice_id' => '1234',
                                              ),
                  'collapse_key'      => $alert_stat,
                  'delay_while_idle'  => true,
                );

  $headers = array( 
                      'Authorization: key=' . $apiKey,
                      'Content-Type: application/json'
                  );

  // Open connection
  $ch = curl_init();

  // Set the url, number of POST vars, POST data
  curl_setopt( $ch, CURLOPT_URL, $url );

  curl_setopt( $ch, CURLOPT_POST, true );
  curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

  curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $fields ) );

  // Execute post
  $result = curl_exec($ch);

  // Close connection
  curl_close($ch);

  echo $result;

}

?>