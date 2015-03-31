<?php 

$con=mysqli_connect("localhost","root","prasannas","my_seafarer");

$sql_q = "INSERT INTO `request_logs`(`ajax_request`, `email_id`, `params`) 
    VALUES 
    ('".explode(".php", end(explode("/", $_SERVER["SCRIPT_NAME"])))[0]."','".$_GET['email']."','".$_SERVER['QUERY_STRING']."')";
// echo $sql_q;
$res = $con->query($sql_q);


?>