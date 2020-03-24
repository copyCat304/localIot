<?php
	session_start();
	error_reporting(E_ALL);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
	  <!-- Theme Made By www.w3schools.com - No Copyright -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
		<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		<script type="text/javascript" src="jquery.js"></script>
	</head>
	<body>
		<canvas id="myChart"></canvas>
	</body>
</html>	

<?php	
		//echo "search";
	if(isset($_POST['id'])){
		//echo "id found";
		$device_user_id = $_POST['id'];
		$device_id_string = explode("-",$device_user_id);
		$device_id = $device_id_string[0];
		$device_table_name = $device_id_string[1];
		$flow = '';
		$instance = '';
		$// $_SESSION['time'] = $actual_time[0]; = '';
		$filepath = realpath(dirname(__FILE__));		
		require_once($filepath."/dbconfig.php");
		$conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
		if ($conn->connect_errno) {
			die("Connection failed: " . $conn->connect_error);
		}	
		if($device_table_name != "default"){		 
			if($result =  $conn->query("SELECT * FROM device_data WHERE device_id = $device_id")){
				//echo "<br />";
				while($row = $result->fetch_object()){
					$time_stamp = explode(" ",$row->date);
					$actual_time = explode(".",$time_stamp[1]);
					$flow = $row->flow;
					$instance = $actual_time[0]
					// $_SESSION['time'] = $actual_time[0];
					// $_SESSION['flow'] = $row->flow;
					// $_SESSION['total'] = $row->totalise;
					// $_SESSION['time'] = $actual_time[0];
					// $_SESSION['date'] = $row->date;

				}
			}
		}
		$conn->close();
	}
?>
	<script type="text/javascript">
		var x_data = ['1', '2', '3', '4', '5', '6', '7','1', '2', '3', '4', '5', '6', '7','1', '2', '3', '4', '5', '6', '7','1', '2', '3', '4', '5', '6', '7','1', '2', '3', '4', '5', '6', '7'];
		var y_data = ['1', '2', '3', '4', '5', '6', '7','1', '2', '3', '4', '5', '6', '7','1', '2', '3', '4', '5', '6', '7','1', '2', '3', '4', '5', '6', '7','1', '2', '3', '4', '5', '6', '7'];
		var ctx = document.getElementById('myChart').getContext('2d');
		var chart = new Chart(ctx, {
		// The type of chart we want to create
		type: 'line',

		// The data for our dataset
		data: {
			labels: x_data,
			datasets: [{
				label: 'My First dataset',
				backgroundColor: 'rgb(0, 99, 132)',
				borderColor: 'rgb(0, 00, 00)',
				data: y_data,
			}]
		},

		// Configuration options go here
		options: {}
		});	
		



		

		
		function updateChart(){

			var flow = <?php echo getflow(10); ?>; 
			var instance = <?php echo gettime(10); ?>;
			// var flow = document.getElementById('userFLow').value;
			// var instance = document.getElementById('userTime').value;

			chart.data.datasets[0].data.push(flow);
			chart.update();
			chart.data.datasets[0].data.shift();
			chart.update();
			chart.data.labels.push(instance);
			chart.update();
			chart.data.labels.shift();
			chart.update();
		};
		
		
		$(document).ready(function() {
			setInterval(fetchdata, 1000);
		});
		
		$(document).ready(function() {
			setInterval(fetchtime, 2000);
		});
		
		$(document).ready(function() {
			setInterval(fetchflow, 3000);
		});
		
		$(document).ready(function(){
			setInterval(updateChart, 5000);
		});
		

		


	</script>
