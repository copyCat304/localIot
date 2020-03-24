<?php   
	 if(isset($_POST["dayValue"]))  
	 {  
		 if(isset($_POST["monthValue"]))  
			 {  
			if(isset($_POST["yearValue"]))  
			 {  
				$id = $_POST['idValue'];
				$day = $_POST['dayValue'];
				$month =  $_POST['monthValue'];
				$year = $_POST['yearValue'];
				$device_id_string = explode("-",$id);
				$device_table_name = "pis".$device_id_string[0].$device_id_string[1].$device_id_string[2];
				if($year != '0'){
					if($month != '0'){
						if($day != '0'){
							$filepath = realpath(dirname(__FILE__));		
							require_once($filepath."/dbconfig.php");
							$conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
							if ($conn->connect_errno) {
									die("Connection failed: " . $conn->connect_error);
								} 
							if($device_table_name != "pis0default0"){
								header('Content-Type: text/csv; charset=utf-8');  
								header('Content-Disposition: attachment; filename=data.csv');  
								$output = fopen("php://output", "w");  
								fputcsv($output, array('day', 'month', 'year', 'hour', 'minute', 'second', 'flow', 'totalised'));  
								$query = "SELECT * FROM $device_table_name WHERE  month = $month AND day = $day AND year = $year";
								if($result =  $conn->query($query)){					
									while($row = mysqli_fetch_assoc($result))  
									{  
									   fputcsv($output, $row);  
									}  
									fclose($output);  
								}
							}else{
								echo '<script type="text/javascript">';
								echo ' alert("tag value not selected")';  //not showing an alert box.
								echo '</script>';
						}}else{
							$filepath = realpath(dirname(__FILE__));		
							require_once($filepath."/dbconfig.php");
							$conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
							if ($conn->connect_errno) {
									die("Connection failed: " . $conn->connect_error);
								} 
							if($device_table_name != "pis0default0"){
								header('Content-Type: text/csv; charset=utf-8');  
								header('Content-Disposition: attachment; filename=data.csv');  
								$output = fopen("php://output", "w");  
								fputcsv($output, array('day', 'month', 'year', 'hour', 'minute', 'second', 'flow', 'totalised'));  
								$query = "SELECT * FROM $device_table_name WHERE  month = $month  AND year = $year";
								if($result =  $conn->query($query)){					
									while($row = mysqli_fetch_assoc($result))  
									{  
									   fputcsv($output, $row);  
									}  
									fclose($output);  
								}
								}else{
									echo '<script type="text/javascript">';
									echo ' alert("tag value not selected")';  //not showing an alert box.
									echo '</script>';
								}
				}
					}else{
						echo '<script type="text/javascript">';
						echo ' alert("month not selected")';  //not showing an alert box.
						echo '</script>';
					}
					
				}else{
					echo '<script type="text/javascript">';
					echo ' alert("year not selected")';  //not showing an alert box.
					echo '</script>';
				}

				
	 }}} 

?>
     
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 