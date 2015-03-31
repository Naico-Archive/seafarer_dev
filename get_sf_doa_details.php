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

ini_set('max_execution_time', 300);
ini_set('memory_limit', '-1');
// ini_set('display_errors',true);
// error_reporting(E_ALL);

include 'insert_logs.php';

$requestParams = array(
    'empid' => $_GET['empid']
);

$client = new SoapClient('BsmMobileService.svc.xml');

$response = $client->GetDOA($requestParams)->GetDOAResult->DOAListEntity;
// var_dump($response);
/*$cur_obj = get_object_vars($response);
echo $cur_obj["code"];*/
// echo "arr";
if (is_array($response)) {
	 // echo "arr";
	echo json_encode($response);
} else {
	// echo "obj";
	$resp_array;
	$resp_array[] = $response;
	echo json_encode($resp_array);
}

?>