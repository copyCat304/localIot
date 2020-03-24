<?php
	session_start();
	error_reporting(E_ALL);
	$device_user_id = $_POST['id3'];
	
	//echo "<br />hie I am in new php<br />";
	//echo $device_user_id;
	//write code to get id	
	$device_id_string = explode("-",$device_user_id);
	//echo "<br />";
	$device_id_value =  $device_id_string[0];
	//echo "<br />";
	$device_table_name = $device_id_string[1];
	//echo "<br />";
	//echo $device_table_name;
	//echo "<br />";
	$filepath = realpath(dirname(__FILE__));		
	require_once($filepath."/dbconfig.php");
	$conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
	if ($conn->connect_errno) {
        die("Connection failed: " . $conn->connect_error);
        }
	if($device_table_name != "default"){		 
		if($result =  $conn->query("SELECT * FROM device_data WHERE device_id = $device_id_value")){
			while($row = $result->fetch_object()){
					$time_stamp = explode(" ",$row->date);
					$actual_time = explode(".",$time_stamp[1]);
					echo $actual_time[0]; 
			
			}
			//echo $conn->error;
		}
	}
    $conn->close();
?>