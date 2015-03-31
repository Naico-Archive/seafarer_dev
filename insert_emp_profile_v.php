<?php
ini_set('soap.wsdl_cache_enabled',0);
ini_set('soap.wsdl_cache_ttl',0);
header('Content-type: application/json');

// TO DEBUG
ini_set('display_errors',true);
error_reporting(E_ALL);

$http_origin = $_SERVER['HTTP_ORIGIN'];
if ($http_origin == "https://www.getvesseltracker.com" || $http_origin == "https://getvesseltracker.com")
{ 
   header('Access-Control-Allow-Origin: *');
}

$msg = 'Dear sir / madam,<br />Welcome to MyBSM Mobile Portal.<br />Kindly use the below details to login into MyBSM App on your phone<br />UserName: ';
$msg .= $email;
$msg .= '<br />Password:';
$msg .= $response;
$msg .= '<br /><br />In case you face any difficulties singing in, please dont hesitate to contact me on this email, or mobile phone at +91 9790266106';
$msg .= '<br />Looking forward to your valuable feedback and comments.<br /><br />Thanks and Regards,<br />-Abdul';
// $msg = wordwrap($msg,70);

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: BSMMobile <abdul.wahab@bs-shipmanagement.com>' . "\r\n";

mail('vinbhai4u@gmail.com', 'MyBSM mobile app registraion', $msg, $headers);

echo json_encode($response);

?>