<?php
	session_start();
	error_reporting(E_ALL);
	
		//echo "search";
	if(isset($_POST['id'])){
		//echo "id found";
		$device_user_id = $_POST['id'];
		$device_id_string = explode("-",$device_user_id);
		$device_id = $device_id_string[0];
		$device_table_name = $device_id_string[1];
		
		$filepath = realpath(dirname(__FILE__));		
		require_once($filepath."/dbconfig.php");
		$conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
		if ($conn->connect_errno) {
			die("Connection failed: " . $conn->connect_error);
		}	
		if($device_table_name != "default"){		 
			if($result =  $conn->query("SELECT * FROM device_data WHERE device_id = $device_id")){
				echo "<br />";
				//$row = $result->fetch_object()
				while($row = $result->fetch_object()){
					$time_stamp = explode(" ",$row->date);
					$actual_time = explode(".",$time_stamp[1]);
					$_SESSION['flow'] = $row->flow;
					$_SESSION['total'] = $row->totalise;
					$_SESSION['time'] = $actual_time[0];
					$_SESSION['date'] = $row->date;
					echo $_SESSION['flow'];
					echo '<br/>';
					echo $_SESSION['time'];
					echo '<br/>';
				}
				echo '<br/>';
				echo "hie";
				echo '<br/>';
				echo "<script>console.log($conn->error);</script>";	
			}
		}
		$conn->close();
	}
?>

