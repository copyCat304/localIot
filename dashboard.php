<?php
session_start();
if(!isset($_SESSION['username']) && !isset($_SESSION['id'])){
	echo "<script type = 'text/javascript'> document.location = 'login.html';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>Dashboard</title>
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
 
 <style>
	body {
		font: 20px Montserrat, sans-serif;
		line-height: 1.8;
		color: #f5f6f7;
	}
	p {font-size: 16px;}
		.margin {margin-bottom: 45px;}
		.bg-1 { 
		background-color: #1abc9c; /* Green */
		color: #FF00FF;
	}
	.bg-1 { 
    background-color: #10e7dc; /* Green */
    color: #ffffff;
	}
	.bg-2 { 
		background-color: #f79e02; /* Dark Blue */
		color: #ffffff;
	}
	.bg-3 { 
		background-color: #ffffff; /* White */
		color: #555555;
	}
	.bg-4 { 
		background-color: #2f2f2f; /* Black Gray */
		color: #fff;
	}
		.bg-5 { 
		background-color: #fff44f; /* Black Gray */
		color: #fff;
	}
	.container-fluid {
		padding-top: 70px;
		padding-bottom: 70px;
	}
		.navbar {
		padding-top: 15px;
		padding-bottom: 15px;
		border: 0;
		border-radius: 0;
		margin-bottom: 0;
		font-size: 12px;
		letter-spacing: 5px;
	}
	.navbar-nav  li a:hover {
		color: #1abc9c !important;
	}
	h2{
		color: #ffffff;
	}
	h1{
		color: #545454;
	}
	h5{
		color: #000000;
	}
	th, td {
		padding: 15px;
		text-align: right;
	  border-bottom: 1px solid #ddd;
	}
	#days{
		background-color: DodgerBlue;
	}
	#months{
		background-color: DodgerBlue;
	}
	#years{
		background-color: DodgerBlue;
	}
  </style>
</head>

<body>

	<!-- Navbar -->
	<nav class="navbar navbar-default">
	  <div class="container">
		<div class="navbar-header">
		  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>                        
		  </button>
		  <a class="navbar-brand" href="#">PaperPlane</a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
		  <ul class="nav navbar-nav navbar-right">
			<li><a href="#"><select id="select" onchange="myFunction()" name = "idValue" form = "carform">
								<option value="0-default-0">default</option>
								</select></a></li>
			<li><a id = "deviceSelect">DEVICE ID</a></li>
			<li><a id = "userSelect">USER ID</a></li>
			<li><a href="logout.php">LOGOUT</a></li>
		  </ul>
		</div>
	  </div>
	</nav>

	<!-- First Container -->
	<div class="container-fluid bg-1 text-center">
	<div class="col-md-1 offset-md-1"></div>
	<div class="col-md-8">
		<div  class = "well well-sm bg-3"><h1><b>Flow Rate/Totalizer</b></h1></div>
		<div class="card text-white bg-info bg-3 align-items-center">
			<div class="card-body">
				<canvas id="myChart"></canvas>
			</div>
		</div>
	</div>	
		<div class="col-md-3">	
		<table style="width:80%">
			<tr>
				<td><h2 id = "userFlow"><b>FLOW</b></h2></td>
				<td><h2>L/HR</h2></td>
			</tr>			
			<tr>
				<td><h2 id ="userTotal"><b>TOTALISE</b></h2></td>
				<td><h2>LITERS</h2></td>
			</tr>
		</table>
		</div>
	  </div>
	</div>

	<!-- Second Container -->
		<div  class="container-fluid bg-2 text-center">
			<h1 class="margin">GET DATA BY DATE</h1>
			
			<div class="col-md-3">
				<select id="days"  name = "dayValue" form = "carform">
					<option value="0"><h5>Day</h5></option>
					<option value="1"><h5>1</h5></option>
					<option value="2"><h5>2</h5></option>
					<option value="3"><h5>3</h5></option>
					<option value="4"><h5>4</h5></option>
					<option value="5"><h5>5</h5></option>
					<option value="6"><h5>6</h5></option>
					<option value="7"><h5>7</h5></option>
					<option value="8"><h5>8</h5></option>
					<option value="9"><h5>9</h5></option>
					<option value="10"><h5>10</h5></option>
					<option value="11"><h5>11</h5></option>
					<option value="12"><h5>12</h5></option>
					<option value="13"><h5>13</h5></option>
					<option value="14"><h5>14</h5></option>
					<option value="15"><h5>15</h5></option>
					<option value="16"><h5>16</h5></option>
					<option value="17"><h5>17</h5></option>
					<option value="18"><h5>18</h5></option>
					<option value="19"><h5>19</h5></option>
					<option value="20"><h5>20</h5></option>
					<option value="21"><h5>21</h5></option>
					<option value="22"><h5>22</h5></option>
					<option value="23"><h5>23</h5></option>
					<option value="24"><h5>24</h5></option>
					<option value="25"><h5>25</h5></option>
					<option value="26"><h5>26</h5></option>
					<option value="27"><h5>27</h5></option>
					<option value="28"><h5>28</h5></option>
					<option value="29"><h5>29</h5></option>
					<option value="30"><h5>30</h5></option>
					<option value="30"><h5>31</h5></option>
				</select>
			</div>
			<div class="col-md-3" >
				<select id="months" name = "monthValue" form = "carform">
					<option value="0"><h5>Month</h5></option>
					<option value="1"><h5>January</h5></option>
					<option value="2"><h5>February</h5></option>
					<option value="2"><h5>March</h5></option>
					<option value="4"><h5>April</h5></option>
					<option value="5"><h5>May</h5></option>
					<option value="6"><h5>June</h5></option>
					<option value="7"><h5>July</h5></option>
					<option value="8"><h5>August</h5></option>
					<option value="9"><h5>September</h5></option>
					<option value="10"><h5>October</h5></option>
					<option value="11"><h5>November</h5></option>
					<option value="12"><h5>December</h5></option>
				</select>
			</div>
			
			<div class="col-md-3">
				<select id="years" name = "yearValue" form = "carform">
					<option value="0"><h5>Year</h5></option>
					<option value="2020"><h5>2020</h5></option>
					<option value="2021"><h5>2021</h5></option>
					<option value="2022"><h5>2022</h5></option>
					<option value="2023"><h5>2023</h5></option>
					<option value="2024"><h5>2024</h5></option>
					<option value="2025"><h5>2025</h5></option>
				</select>
			</div>
			
			<div class="col-md-3">
			<form action="csvWrite.php" method="post" id="carform">
			  <input type="submit" value="Submit" class="btn btn-default btn-lg">
			</form> 
			</div>
			
  
	</div>

	<!-- Footer -->
	<footer class="container-fluid bg-4 text-center">
	  <p>Bootstrap Theme Made By <a href="https://www.w3schools.com">www.w3schools.com</a></p> 
	</footer>


	
	<?php
		$element = array();
		//$element_id = array();
		$id = $_SESSION['id'];
		$userSelect = $_SESSION['username'];
		$filepath = realpath(dirname(__FILE__));
		//require_once($filepath."/dbconfig.php");
		require($filepath."/dbconfig.php");
		$conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);		
		if ($conn->connect_errno) {
			die("Connection failed: " . $conn->connect_error);
				echo "connection failed";
			}
		console.log("connection success");
		$device_name = $conn->query("SELECT * FROM device_data WHERE user_id = $id");
		while($row = $device_name->fetch_object()){
			$val = $row->device_id."-".$row->device_name;
			//console.log($val);
			array_push($element,$val);
		}
				function getflow($a) {
					if(isset($_SESSION['flow'])){
						return json_encode($_SESSION['flow']);
						}
						return json_encode($a);
				}
				function gettime($a) {	
					if(isset($_SESSION['time'])){
						return json_encode($_SESSION['time']);
					}
						return json_encode($a);
				}
		
		
				function getFlowTime($a1,$a2,$a3,$a4){
					$device_user_id = $a1;
					$device_user_month = "<script>document.writeln(document.getElementById('months').value);</script>";
					$device_user_year = $a4;
					$device_id_string = explode("-",$device_user_id);
					$device_id = $device_id_string[0];
					$device_table_name = "pis".$device_id_string[0].$device_id_string[1].$device_id_string[2];
					$filepath = realpath(dirname(__FILE__));		
					require_once($filepath."/dbconfig.php");
					$conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
					if ($conn->connect_errno) {
						die("Connection failed: " . $conn->connect_error);
					}	
					$flow = array();
					$instance = array();
					if($device_table_name != "default"){		 
						if($result =  $conn->query("SELECT * FROM pis1tag01 WHERE  month = $device_user_month AND year = $device_user_year")){
							while($row = $result->fetch_object()){
								array_push($instance,$row->month);
								array_push($flow,$row->flow);
							}
						}
					}
					//$conn->close();
					if($a2 == '1'){
						return json_encode($flow);
					}
					if($a2 == '2'){
						return json_encode($instance);
					}
				}
	?>



	
	<script type="text/javascript">

		var passedArray =  <?php echo json_encode($element); ?>;

		
		var select = document.getElementById("select"),arr = passedArray;
             
         for(var i = 0; i < arr.length; i++){
            var option = document.createElement("OPTION"),
            txt = document.createTextNode(arr[i]);
            option.appendChild(txt);
            option.setAttribute("value",arr[i]);
            select.insertBefore(option,select.lastChild);
		}
		
		var x_data = ['0', '0', '0', '0','0', '0', '0', '0','0', '0', '0', '0','0', '0', '0', '0','0', '0', '0', '0','0', '0', '0', '0','0', '0', '0', '0','0', '0', '0', '0','0', '0', '0', '0'];
		var y_data = ['0', '0', '0', '0','0', '0', '0', '0','0', '0', '0', '0','0', '0', '0', '0','0', '0', '0', '0','0', '0', '0', '0','0', '0', '0', '0','0', '0', '0', '0','0', '0', '0', '0'];
		var ctx = document.getElementById('myChart').getContext('2d');
		var chart = new Chart(ctx, {
		// The type of chart we want to create
		type: 'line',

		// The data for our dataset
		data: {
			labels: x_data,
			datasets: [{
				label: 'Flow Rate',
				backgroundColor: 'rgb(255, 100, 100)',
				borderColor: 'rgb(0, 00, 00)',
				data: y_data,
			}]
		},

		// Configuration options go here
		options: {
			scales: {
				yAxes :[{
					ticks: {
						beginAtZero: true
					}
				}]
			}
		}
		});	
		
		//displays slected device and user
		function myFunction() {
			var x = document.getElementById("select").value;
			var y = <?php echo json_encode($userSelect); ?>;
			document.getElementById("deviceSelect").innerHTML = x;
			document.getElementById("userSelect").innerHTML = y;
		}

		function fetchtime(){
			//getElem();
			$.ajax({
			url: 'readtime.php', 
			data: {id3:document.getElementById("select").value},
			type: 'post',
			success: function(response){
			// Perform operation on the return value
			
			
			x_data.push(response);
			x_data.shift();
			chart.data.labels = x_data;
			chart.update();
			}});		
		}
		
		function fetchflow(){
			$.ajax({
			url: 'readflow.php', 
			data: {id1:document.getElementById("select").value},
			type: 'post',
			dataType: 'json',
			success: function(response){
			// Perform operation on the return value
			$("#userFlow").html(response);
			y_data.push(response);
			y_data.shift();
			chart.data.datasets[0].data = y_data;
			chart.update();
			}});		
		}
		
		function fetchtotal(){
			$.ajax({
			url: 'readtotalise.php', 
			data: {id4:document.getElementById("select").value},
			type: 'post',
			success: function(response){
			$("#userTotal").html(response);	
			}});		
		}
		
		function fetchdate(){
			$.ajax({
			url: 'readtime.php', 
			data: {id3:document.getElementById("select").value},
			type: 'post',
			dataType: 'json',
			success: function(response){
			// Perform operation on the return value
			$("#userTime").html(response);
			}});		
		}
		

		
		$(document).ready(function() {
			setInterval(fetchdate, 5000);
		});
		
		$(document).ready(function() {
			setInterval(fetchtime, 2000);
		});
		
		$(document).ready(function() {
			setInterval(fetchflow, 2050);
		});
		
		$(document).ready(function(){
			setInterval(fetchtotal, 4000);
		});
		

		


	</script>
</body>
</html>
