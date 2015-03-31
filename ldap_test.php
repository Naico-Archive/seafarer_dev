<?php
$http_origin = $_SERVER['HTTP_ORIGIN'];
if ($http_origin == "https://www.getvesseltracker.com" || $http_origin == "https://getvesseltracker.com")
{ 
   header('Access-Control-Allow-Origin: *');
}

/*ini_set('display_errors',true);
error_reporting(E_ALL);
*/
$username = $_POST['username'];
$password = $_POST['password'];

include 'insert_logs.php';



if (empty($username) || empty($password)) {
	echo 'failed';
	exit;
}

if($username == '132058' && $password == '4521') {
	echo 'success:670324';
} else if($username == '132076' && $password == '9813') {
	echo 'success:672065';
} else if($username == 'M6764' && $password == '8542') {
	echo 'success:677216';
} else if($username == 'M4936' && $password == '6479') {
	echo 'success:678744';
} else if($username == 'M9354' && $password == '5645') {
	echo 'success:677966';
} else {
	echo 'failed:';
}
?>
