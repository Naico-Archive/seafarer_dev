<?php

/*ini_set('display_errors',true);
error_reporting(E_ALL);*/

$http_origin = $_SERVER['HTTP_ORIGIN'];
header('Content-type: application/json');

$emp_id = $_POST['empid'];
$reg_id = $_POST['gcm_registry_id'];
$platfrm = $_POST['platform'];

if ($http_origin == "https://www.getvesseltracker.com" || $http_origin == "https://getvesseltracker.com")
{ 
   header('Access-Control-Allow-Origin: *');
}
ini_set('max_execution_time', 300);
ini_set('memory_limit', '-1');

include 'insert_logs.php';

$con=mysqli_connect("localhost","root","prasannas","my_seafarer");
if ($emp_id && $reg_id) {
	$sql_q = "INSERT INTO `user_phone_reg` (emp_id, reg_id, platform, modified_on) VALUES('".$emp_id."','".$reg_id."','".$platfrm."', NOW()) ON DUPLICATE KEY UPDATE reg_id = VALUES(reg_id)";//.' ON DUPLICATE KEY UPDATE ';
	//echo $sql_q;
	$res = $con->query($sql_q);
}

echo json_encode("Success");

?>