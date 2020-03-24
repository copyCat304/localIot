<?php
	session_start();
	error_reporting(E_ALL);
	$device_user_id = $_POST['id01'];
	$device_user_month = $_POST['month01'];
	$device_user_year = $_POST['year01'];
	$device_id_string = explode("-",$device_user_id);
	$device_id_value =  $device_id_string[0];
	$device_table_name = "pis".$device_id_string[0].$device_id_string[1].$device_id_string[2];
	$filepath = realpath(dirname(__FILE__));		
	require_once($filepath."/dbconfig.php");
	$conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
	if ($conn->connect_errno) {
        die("Connection failed: " . $conn->connect_error);
        }
	$element = array();
	if($device_table_name != "default"){		 
		if($result =  $conn->query("SELECT * FROM pis1tag01 WHERE  month = $device_user_month AND year = $device_user_year")){
			while($row = $result->fetch_object()){
				array_push($element,$row->flow);
			}
			echo json_encode($element); 
		}
	}
    $conn->close();
?>