<?php
include 'mybsm_notify_android.php';
include 'mybsm_notify_ios.php';
ini_set('soap.wsdl_cache_enabled',0);
ini_set('soap.wsdl_cache_ttl',0);
header('Content-type: application/json');

$http_origin = $_SERVER['HTTP_ORIGIN'];
if ($http_origin == "https://www.getvesseltracker.com" || $http_origin == "https://getvesseltracker.com")
{ 
   header('Access-Control-Allow-Origin: *');
}

ini_set('max_execution_time', 300);
ini_set('memory_limit', '-1');
// ini_set('display_errors',true);
// error_reporting(E_ALL);
// Replace with real BROWSER API key from Google APIs

function sql_get_vals($emp) {
  //echo $emp;
  $alert_stat = 'New Open Opsition for you';
  $con=mysqli_connect("localhost","root","prasannas","my_seafarer");
  $sql_q = "SELECT  `reg_id` FROM `user_phone_reg` WHERE (`emp_id` IN (".$emp.")  AND `platform` = 'Android')" ;
  echo  $sql_q;
  $res = $con->query($sql_q);

  $results;
  $reg_key;
  while($row = mysqli_fetch_array($res)) {
    $results[] = $row['reg_id'];
  }
  
  //var_dump($results);
  push_to_mob_android($results, $alert_stat);
}

function sql_get_vals_ios($emp) {
  //echo $emp;
  $alert_stat = 'New Open Opsition for you';
  $con=mysqli_connect("localhost","root","prasannas","my_seafarer");
  $sql_q = "SELECT  `reg_id` FROM `user_phone_reg` WHERE (`emp_id` IN (".$emp.")  AND `platform` = 'iOS')" ;
  //echo  $sql_q;
  $res = $con->query($sql_q);

  //$results;
  $reg_key;
  while($row = mysqli_fetch_array($res)) {
    //$results[] = $row['reg_id'];
    push_to_mob_ios($row['reg_id'], $alert_stat);
  }
  
  //var_dump($results);
}


function object_to_array($obj) {
    if(is_object($obj)) $obj = (array) $obj;
    if(is_array($obj)) {
        $new = array();
        foreach($obj as $key => $val) {
            $new[$key] = object_to_array($val);
        }
    }
    else $new = $obj;
    return $new;       
}

$client = new SoapClient('BsmMobileService.svc.xml');
$response = $client->GetSFOpenPositionNotify()->GetSFOpenPositionNotifyResult->SFOpenPositionNotifyEntity;
$response = object_to_array($response);
$emp_ids = '';

foreach ($response as $op_notify) {
    $emp_ids.= $op_notify['emp_id'].',';
}
$emp_ids = substr($emp_ids, 0, strlen($emp_ids)-1);
//$emp_ids = '610788,610789';
sql_get_vals($emp_ids);
sql_get_vals_ios($emp_ids);

//var_dump( $notify_empids);
//sql_get_vals($op_notify['emp_id']);
?>