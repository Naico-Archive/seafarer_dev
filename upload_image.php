<?php
ini_set('soap.wsdl_cache_enabled',0);
ini_set('soap.wsdl_cache_ttl',0);
header('Content-type: application/json');

// TO DEBUG
 ini_set('display_errors',true);
 error_reporting(E_ALL);

$http_origin = $_SERVER['HTTP_ORIGIN'];
if ($http_origin == "https://www.getvesseltracker.com" || $http_origin == "https://getvesseltracker.com")
{ 
   header('Access-Control-Allow-Origin: *');
}

try {	
	require_once 'vendor/autoload.php';
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
	
}

// include 'insert_logs.php';

// try {
// 	$current .= "inside try";
//     $data = base64_decode($_POST['data']);
// 	$file = UPLOAD_DIR . uniqid() . '.jpg';
// 	file_put_contents($file, $data);
// } catch (Exception $e) {
//     // echo 'Caught exception: ',  $e->getMessage(), "\n";
//     $current .= "Error". $e->getMessage() ." \n";
// }


// file_put_contents($file1, $current);


echo "string5";

$connectionString = "DefaultEndpointsProtocol=http;AccountName=bsmcdn;AccountKey=32AjIeh/3+S1+dHbz6IVhvBs/bVJvA8k4ZvvLFaqQMWUyVbwSe3PBuQpXs0L6jYaCY7z1z4H3SXlDTTcMmJCrA==";

// try{

use WindowsAzure\Common\ServicesBuilder;
use WindowsAzure\Common\ServiceException;

echo $connectionString;
// Create blob REST proxy.
$blobRestProxy = ServicesBuilder::getInstance()->createBlobService($connectionString);

try {
    // List blobs.
    $blob_list = $blobRestProxy->listBlobs("mycontainer");
    $blobs = $blob_list->getBlobs();

    foreach($blobs as $blob)
    {
        echo $blob->getName().": ".$blob->getUrl()."<br />";
    }
}

// } catch (Exception $e) {
//     echo 'Caught exception: ',  $e->getMessage(), "\n";
//     // $current .= "Error", $e->getMessage(), " \n";
// }


?>