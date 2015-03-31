<?php 

$http_origin = $_SERVER['HTTP_ORIGIN'];
if ($http_origin == "https://www.getvesseltracker.com" || $http_origin == "https://getvesseltracker.com")
{ 
   header('Access-Control-Allow-Origin: *');
}

ini_set('display_errors',true);
error_reporting(E_ALL);

ini_set('max_execution_time', 300);
ini_set('memory_limit', '-1');

// $con=mysqli_connect("localhost","root","prasannas","my_seafarer");

// $sql_q = "INSERT INTO `request_logs`(`ajax_request`, `email_id`, `params`) 
//     VALUES 
//     ('get_sf_expiry_docs','".$_GET['email_id']."','".$_SERVER['QUERY_STRING']."')";
// echo $sql_q;
// $res = $con->query($sql_q);

// echo $_SERVER['QUERY_STRING'];

// echo phpversion();

// echo $_SERVER['REQUEST_URI'];

// $str =  explode("/", $_SERVER["SCRIPT_NAME"]);
// echo $_SERVER["SCRIPT_NAME"];
// var_dump($str);

// var_dump(explode(".php", end($str)));

echo explode(".php", end(explode("/", $_SERVER["SCRIPT_NAME"])))[0];

?>