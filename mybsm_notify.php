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
/*ini_set('display_errors',true);
error_reporting(E_ALL);*/
// Replace with real BROWSER API key from Google APIs


$client = new SoapClient('BsmMobileService.svc.xml');

	
$response = $client->GetSFCallPushAlert()->GetSFCallPushAlertResult->SFPushAlertLists;
//$emp;

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

//var_dump($response->SFPushAlertList);
$response = object_to_array($response);
//echo "\xA";echo "\xA";
//var_dump($response);

// $response = list of alerts. Each alert = list of alerts for one seafarer.

foreach ($response as $seafarer_alert) {
  foreach ($seafarer_alert as $alert) {
    
    $seafarer_alert_list = $alert['SFPushAlerts']['SFPushAlert'];
    if ($seafarer_alert_list['emp_id'] == null) {
      foreach ($seafarer_alert_list as $seafarer_alert_i) {
        
        // var_dump($seafarer_alert_i);  
        sql_get_vals_and($seafarer_alert_i['emp_id'], $seafarer_alert_i['alert_status']);  //alert_change
        sql_get_vals_ios($seafarer_alert_i['emp_id'], $seafarer_alert_i['alert_status']);  //alert_change
        //echo "\xA";
      }
    } else {
      // var_dump($seafarer_alert_list);
      sql_get_vals_and($seafarer_alert_list['emp_id'], $seafarer_alert_list['alert_status']);
      sql_get_vals_ios($seafarer_alert_list['emp_id'], $seafarer_alert_list['alert_status']);
    }
  }
}


//var_dump($response);

function sql_get_vals_and($emp, $alert_stat) {
  //echo $emp;
  $con=mysqli_connect("localhost","root","prasannas","my_seafarer");
  $sql_q = "SELECT  `reg_id` FROM `user_phone_reg` WHERE (`emp_id` = ".$emp." AND `platform` = 'Android') " ;
  //echo $sql_q;
  $res = $con->query($sql_q);

  $results;
  $reg_key;
  while($row = mysqli_fetch_array($res)) {
    $results[] = $row['reg_id'];
    push_to_mob_android($results, $alert_stat);
  }
}


function sql_get_vals_ios($emp, $alert_stat) {
  //echo $emp;
  $con=mysqli_connect("localhost","root","prasannas","my_seafarer");
  $sql_q = "SELECT  `reg_id` FROM `user_phone_reg` WHERE (`emp_id` = ".$emp." AND `platform` = 'iOS') " ;
  //echo $sql_q;
  $res = $con->query($sql_q);

  $results;
  $reg_key;
  while($row = mysqli_fetch_array($res)) {
    //$results[] = $row['reg_id'];
    push_to_mob_ios($row['reg_id'], $alert_stat);
  }
}

?>