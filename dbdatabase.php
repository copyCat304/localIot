<?php
    error_reporting(E_ALL);
		
	$filepath = realpath(dirname(__FILE__));
			
	require_once($filepath."/dbconfig.php");
	$conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
	if ($conn->connect_errno) {
        die("Connection failed: " . $conn->connect_error);
        }
            
	$date = date("y/m/d");
	$val1 = rand(10,100);
	$val2 = rand(100,1000);
	$device_user_day = 1;
	$device_user_month = 2;
	$device_user_year = 2020;

	$conn->query("UPDATE device_data SET date = now(),flow=$val1,totalise=$val2 WHERE device_id = 1;");
	$conn->query("INSERT INTO pis1tag01(`day`, `month`, `year`, `hour`, `minute`, `second`, `flow`, `totalise`) VALUES (2,2,2020,1,2,3,18,100)");
	//$conn->query("SELECT * FROM pis1tag01 WHERE  month = $device_user_month AND day = $device_user_day AND year = $device_user_year");
	echo "insert <br />";
	  
	echo $conn->error;
    
    $conn->close();
?>




