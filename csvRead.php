<?php
	ini_set('max_execution_time', 1200);
    $date = date("d/m/Y");
	echo $date;
	echo '<br/>';
	$yesterday =  date("d/m/Y", strtotime("-1 days")); 
    $fileSplit = explode("/",$yesterday);
	$day = str_pad($fileSplit[0], 2, "0", STR_PAD_LEFT);
	$month = str_pad($fileSplit[1], 2, "0", STR_PAD_LEFT);
	$year = str_pad($fileSplit[2], 4, "0", STR_PAD_LEFT);
	
	echo date("d/m/Y", strtotime("1 days")); 
	
	$filepath = realpath(dirname(__FILE__));
	echo '<br/>';
	echo $filepath;
	require_once($filepath."/dbconfig.php");
	$conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
	if ($conn->connect_errno) {
			die("Connection failed: " . $conn->connect_error);
		}
    $today = $day.$month.$year;
	$today_id = $day.$month.$year;
    $filename = $filepath.'\\pis01\\'.$today.'.csv';
	echo 'today<br/>';
	echo $filename;
	echo '<br/>';
    $file = fopen($filename, "r");
    if($result =  $conn->query("SELECT * FROM device_data WHERE device_id = 1")){
		$row = $result->fetch_object();
		$loadon_val = $row->loadon;
		echo 'loadon<br/>';
		echo $loadon_val;
		echo '<br/>';
		$i = 1;
		$data_valid = array();
		while($loadon_val != $today){
				echo "data not upto date<br/>";
				$nextDay =  date("d/m/Y", strtotime("-".$i." days")); 
				$next_split = explode("/",$nextDay);
				$next_day = str_pad($next_split[0], 2, "0", STR_PAD_LEFT);
				$next_month = str_pad($next_split[1], 2, "0", STR_PAD_LEFT);
				$next_year = str_pad($next_split[2], 4, "0", STR_PAD_LEFT);
				$next_day = $next_day.$next_month.$next_year;
				echo 'next day<br/>';
				echo $next_day;
				echo '<br/>';
				$next_filepath = $filepath.'\\pis01\\'.$next_day.'.csv';
				echo $next_filepath;
				echo '<br/>';
				$j = 0;
				//if(file_exists($filepath.'\\pis01\\'.$next_day.'.csv')){
				if (($handle = fopen($next_filepath, "r")) !== FALSE){
					echo 'File there<br/>';
					while (($column = fgetcsv($handle,'5000',",")) !== FALSE) {
						//$id_val = $column[0].$column[1].$column[2].$column[3].$column[4];
						$id_val = str_pad($column[0], 2, "0", STR_PAD_LEFT).str_pad($column[1], 2, "0", STR_PAD_LEFT).str_pad($column[2], 4, "0", STR_PAD_LEFT).str_pad($column[3], 2, "0", STR_PAD_LEFT).str_pad($column[4], 2, "0", STR_PAD_LEFT);
						echo 'while ok<br/>';
						echo $column[7];
						echo '<br/>';
						$j = $j +1;
						echo $j;
						echo '<br/>';
						echo $id_val;
						echo '<br/>';
						//$sqlIn = $conn->query("INSERT INTO pis1tag01(day, month, year, hour, minute, second, flow, totalise) VALUES($column[0],$column[1],$column[2],$column[3],$column[4],$column[5],$column[6],$column[7])");
						//$sqlIn = $conn->query("INSERT INTO pis1tag01(day, month, year, hour, minute, second, flow, totalise) VALUES($column[0],$column[1],$column[2],$column[3],$column[4],$column[5],$column[6],$column[7])");
						//if($sqlIn = $conn->query("INSERT INTO pis0001tag0001(id, flow, totalise) VALUES($id_val,$column[6],$column[7])"))	
						if($sqlIn = $conn->query("INSERT INTO pis1tag01(stamp,day, month, year, hour, minute, second, flow, totalise) VALUES($id_val,$column[0],$column[1],$column[2],$column[3],$column[4],$column[5],$column[6],$column[7])"))
						{
						    echo "New record created successfully";
							try{
								$data_valid += [$next_day => 'nok'];
							}
							catch(Exception $e){
								$data_valid[next_day] = 'nok';
							}
						} else {
							echo "Error: " . $sqlIn . "<br>" . mysqli_error($conn);
							try{
								$data_valid += [$next_day => 'nok'];
							}
							catch(Exception $e){
								$data_valid[next_day] = 'nok';
							}
						}
					}
					$j = 0;
				}
				
				$today = $next_day;
				echo 'today<br/>';
				echo $today;
				echo '<br/>';
				$i = $i + 1;
			}
			if($loadon_val == $today){
				$conn->query("UPDATE device_data SET loadon = $today_id WHERE device_id = 1;");
			}else{
				$conn->query("UPDATE device_data SET loadon = $loadon_val WHERE device_id = 1;");
			}
			echo '<br/>';
			foreach($data_valid as $x => $x_value) {
				echo "Key=" . $x . ", Value=" . $x_value;
				echo "<br>";
				if($x_value == 'ok'){
					echo "<br>";
					echo "i am ok";
					echo "<br>";
					$conn->query("UPDATE device_data SET loadon = $today_id WHERE device_id = 1;");
				}else{
					echo "<br>";
					echo "i am nok";
					echo "<br>";
					$conn->query("UPDATE device_data SET loadon = $x WHERE device_id = 1;");
				}
			}
			
	}
//UPDATE `device_data` SET `loadon`='22032020' WHERE device_id=1
?>