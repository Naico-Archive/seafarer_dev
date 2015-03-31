<?php
ini_set('soap.wsdl_cache_enabled',0);
ini_set('soap.wsdl_cache_ttl',0);
header('Content-type: application/json');

// TO DEBUG
// ini_set('display_errors',true);
// error_reporting(E_ALL);

$http_origin = $_SERVER['HTTP_ORIGIN'];
if ($http_origin == "https://www.getvesseltracker.com" || $http_origin == "https://getvesseltracker.com")
{ 
   header('Access-Control-Allow-Origin: *');
}

// ini_set('max_execution_time', 300);
// ini_set('memory_limit', '-1');

include 'insert_logs.php';


$email = $_POST['email'];
$oldPwd = $_POST['oldPwd'];
$newPwd = $_POST['newPwd'];
$empId = $_POST['empId'];

$requestParams = array(
    'oldPwd' => $_POST['oldPwd'],
    'newPwd' => $_POST['newPwd'],
    'empId' => $_POST['empId']
);

$client = new SoapClient('BsmMobileService.svc.xml');

$response = $client->SFChangePassword($requestParams)->SFChangePasswordResult;

$msg = 'Dear sir / madam,<br />Welcome to MyBSM Mobile Portal.<br />Password Changed Successfully<br />UserName: ';
$msg .= $email;
$msg .= '<br /> New Password:';
$msg .= $newPwd;
$msg .= '<br /><br />In case you face any difficulties singing in, please dont hesitate to contact me on this email, or mobile phone at +91 9790266106';
$msg .= '<br />Looking forward to your valuable feedback and comments.<br /><br />Thanks and Regards,<br />-Abdul';
// $msg = wordwrap($msg,70);

$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: BSMMobile <abdul.wahab@bs-shipmanagement.com>' . "\r\n";

// $headers .= "Reply-To: abdul.wahab <abdul.wahab@bs-shipmanagement.com>\r\n"; 
// $headers .= "Return-Path: abdul.wahab <abdul.wahab@bs-shipmanagement.com>\r\n"; 
// $headers .= "From: abdul.wahab <abdul.wahab@bs-shipmanagement.com>\r\n"; 

// $headers .= "Organization: BSM\r\n";
// $headers .= "MIME-Version: 1.0\r\n";
// $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
// $headers .= "X-Priority: 3\r\n";
// $headers .= "X-Mailer: PHP". phpversion() ."\r\n";

if($response=='sucess')
{
mail($email, 'MyBSM mobile app registraion', $msg, $headers);
}


echo json_encode($response);

?>