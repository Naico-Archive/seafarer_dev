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

include 'insert_logs.php';

$email = $_POST['email'];
$phone = $_POST['phone'];
$emp_id = $_POST['emp_id'];

// echo $email;

$con=mysqli_connect("localhost","root","prasannas","my_seafarer");

$sql_q = "INSERT INTO `seafarer_profile`(
	`email`, 
	`phone`, 
	`emp_id`
	) VALUES (
	'".$_POST['email']."','".$_POST['phone']."','".$_POST["emp_id"]."')
	ON DUPLICATE KEY UPDATE `phone`='".$_POST['phone']."', `email`='".$_POST['email']."' ";

$res = $con->query($sql_q);

if($res)
{
	echo json_encode("Success");
}
else
{
	echo json_encode("Error");
}

?>