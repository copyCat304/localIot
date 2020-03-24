<?php
	error_reporting(E_ALL);
	$device_user_id = $_POST['id'];

	//echo "<br />hie I am in new php<br />";
	echo $device_user_id;

	//write code to get id	
	$device_id_string = explode("-",$device_user_id);
	//echo "<br />";
	//echo $device_id_string[0];
	//echo "<br />";
	$device_table_name = 'PAT'.$device_id_string[0];
	//echo "<br />";
	//echo $device_table_name;
	//echo "<br />";
	$filepath = realpath(dirname(__FILE__));		
	require_once($filepath."/dbconfig.php");
	$conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
	if ($conn->connect_errno) {
        die("Connection failed: " . $conn->connect_error);
        }
	if($device_table_name != "PATdefault"){		 
		if($result =  $conn->query("SELECT * FROM $device_table_name ORDER BY time DESC LIMIT 1")){
			while($row = $result->fetch_object()){
				$time_stamp = explode(" ",$row->time);
				$actual_time = explode(".",$time_stamp[1]);
				echo $actual_time[0]; 
				}
				if($device_var == "flow"){
					echo $row->flow; 
				}
				if($device_var == "total"){
					echo $row->totalise; 
				}
				if($device_var == "date"){
					echo $row->date; 
				}
			}
			echo $conn->error;
		}
	}
    $conn->close();
?>