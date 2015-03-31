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

include 'insert_logs.php';

// ini_set('max_execution_time', 300);
// ini_set('memory_limit', '-1');

$requestParams = array(
    'empid' => $_POST['empid'],
    'companyid' => $_POST['managerid'],
    'message' => $_POST['message'],
    'subject' => $_POST['subject']
);

$client = new SoapClient('BsmMobileService.svc.xml');

$response = $client->InsertCorrespondance($requestParams)->InsertCorrespondanceResult;

echo json_encode($response);

?>