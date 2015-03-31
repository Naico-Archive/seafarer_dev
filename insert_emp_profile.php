<?php
ini_set('soap.wsdl_cache_enabled',0);
ini_set('soap.wsdl_cache_ttl',0);
header('Content-type: application/json');
require_once('PHPMailer/class.phpmailer.php');

// TO DEBUG
// ini_set('display_errors',true);
// error_reporting(E_ALL);

$http_origin = $_SERVER['HTTP_ORIGIN'];
if ($http_origin == "https://www.getvesseltracker.com" || $http_origin == "https://getvesseltracker.com")
{ 
   header('Access-Control-Allow-Origin: *');
}

ini_set('max_execution_time', 300);
ini_set('memory_limit', '-1');

include 'insert_logs.php';

$email = $_POST['email'];

$requestParams = array(
    'id' => $_POST['id'],
    'sur_name' => $_POST['sur_name'],
    'first_name' => $_POST['first_name'],
    'middle_name' => $_POST['middle_name'],
    'passport_no' => $_POST['passport_no'],
    'email_id' => $email
);

$client = new SoapClient('BsmMobileService.svc.xml');

$response = $client->InsertEmpPersonnelDetails($requestParams)->InsertEmpPersonnelDetailsResult;

if ($response == 'Already exist') {
	echo json_encode($response);
	exit();
}

$body = 'Dear sir / madam,<br />Welcome to MyBSM Mobile Portal.<br />Kindly use the below details to login into MyBSM App on your phone<br />UserName: ';
$body .= $email;
$body .= '<br />Password:';
$body .= $response;
$body .= '<br /><br />In case you face any difficulties singing in, please dont hesitate to contact me on this email, or mobile phone at +91 9790266106';
$body .= '<br />Looking forward to your valuable feedback and comments.<br /><br />Thanks and Regards,<br />-Abdul';
// $body = wordwrap($body,70);

// $headers  = 'MIME-Version: 1.0' . "\r\n";
// $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
// $headers .= 'From: BSMMobile <abdul.wahab@bs-shipmanagement.com>' . "\r\n";

// $headers .= "Reply-To: abdul.wahab <abdul.wahab@bs-shipmanagement.com>\r\n"; 
// $headers .= "Return-Path: abdul.wahab <abdul.wahab@bs-shipmanagement.com>\r\n"; 
// $headers .= "From: abdul.wahab <abdul.wahab@bs-shipmanagement.com>\r\n"; 

// $headers .= "Organization: BSM\r\n";
// $headers .= "MIME-Version: 1.0\r\n";
// $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
// $headers .= "X-Priority: 3\r\n";
// $headers .= "X-Mailer: PHP". phpversion() ."\r\n";

//mail($email, 'MyBSM mobile app registraion', $body, $headers);

$mail             = new PHPMailer();

$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "smtp.office365.com"; // sets the SMTP server
$mail->Port       = 587;                    // set the SMTP port for the GMAIL server
$mail->Username   = "vidya.sagar@bs-shipmanagement.com"; // SMTP account username
$mail->Password   = "Login@PC";        // SMTP account password

$mail->SetFrom('vidya.sagar@bs-shipmanagement.com', 'Vidya Sagar');
$mail->AddReplyTo("vidya.sagar@bs-shipmanagement.com","Vidya Sagar");

$mail->Subject    = "MyBSM mobile app registraion";
$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

// $mail->bodyHTML($body);
$mail->Body = $body;

$address = $email;
$mail->AddAddress($address, "Name of Seafarer here");

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo json_encode($response);
	// echo 'success';
}

?>