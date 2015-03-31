<?php
ini_set('soap.wsdl_cache_enabled',0);
ini_set('soap.wsdl_cache_ttl',0);
header('Content-type: application/json');


// TO DEBUG
 /*ini_set('display_errors',true);
 error_reporting(E_ALL);*/

$http_origin = $_SERVER['HTTP_ORIGIN'];
if ($http_origin == "https://www.getvesseltracker.com" || $http_origin == "https://getvesseltracker.com")
{ 
   header('Access-Control-Allow-Origin: *');
}

ini_set('max_execution_time', 300);
ini_set('memory_limit', '-1');
// ini_set('display_errors',true);
// error_reporting(E_ALL);


include 'insert_logs.php';

	
$client = new SoapClient('BsmMobileService.svc.xml');
// echo 'push';

$con=mysqli_connect("localhost","root","prasannas","my_seafarer");
$sql_q = "SELECT  `reg_id` FROM `user_phone_reg` WHERE (`emp_id` = 610788)" ;
 // echo $sql_q;
$res = $con->query($sql_q);

$results;

while($row = mysqli_fetch_array($res)) {
	$results[] = $row['reg_id'];
}
echo json_encode($results);


?>