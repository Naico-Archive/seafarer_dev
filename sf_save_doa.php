<?php
ini_set('soap.wsdl_cache_enabled',0);
ini_set('soap.wsdl_cache_ttl',0);
header('Content-type: application/json');


// TO DEBUG
/* ini_set('display_errors',true);
 error_reporting(E_ALL);*/

$http_origin = $_SERVER['HTTP_ORIGIN'];
if ($http_origin == "https://www.getvesseltracker.com" || $http_origin == "https://getvesseltracker.com")
{ 
   header('Access-Control-Allow-Origin: *');
}

// ini_set('max_execution_time', 300);
// ini_set('memory_limit', '-1');

 // echo $_POST['empid'];
 // echo $_POST['remark'];
 // echo $_POST['doadate'];

include 'insert_logs.php';

$requestParams = array(
    'empid' =>  $_POST['empid'] ,
    'remark' => $_POST['remark'],
    'doaDate' => $_POST['doadate'],
    'operation' => $_POST['operation'],
);

$client = new SoapClient('BsmMobileService.svc.xml');

$response = $client->InsertDOA($requestParams)->InsertDOAResult;

echo json_encode($response);
?>