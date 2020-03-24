<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Flow</title>
  </head>
  
<style>
/*body {
  background-color: #ffdd00;
}*/
</style>

<body class = "bg-warning py-5">
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<script type="text/javascript" src="jquery.js"></script>
	
    <select id="select" onchange="myFunction()">
        <option value="default">default</option>
    </select>
	
	<p id="demo"></p>

	<div class="col-md-10 offset-md-1">
		<div class="card">
			<div class="card-body">
				<h1>Current Flow</h1>
			</div>
			<div class="card-body">
				<canvas id="myChart"></canvas>
			</div>
		</div>
	</div>
	<p>"flowchart01"</p>
	<p id = "flowchart01" ></p>	
	<p>"flowchart02"</p>	
	<p id = "flowchart02" ></p>	
	<p>"flowvalue"</p>	
	<p id = "flowValue" ></p>
	<p>"timevalue"</p>
	<p id = "timeValue" ></p>
	<p>"datevalue"</p>
	<p id = "dateValue" ></p>
	<p>"totalvalue"</p>
	<p id = "totaliseValue" ></p>
	<p>"test"</p>
	<p id = "test" ></p>
	
	
	<?php
		$element = array();
		//$element_id = array();
		$id = $_SESSION['id'];
		echo $id;
		$filepath = realpath(dirname(__FILE__));
		require_once($filepath."/dbconfig.php");
		$conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);		
		if ($conn->connect_errno) {
			die("Connection failed: " . $conn->connect_error);
				echo "connection failed";
			}
		$device_name = $conn->query("SELECT * FROM device_data WHERE user_id = $id");
		while($row = $device_name->fetch_object()){
			$val = $row->device_id."-".$row->device_name;
			echo $val;
			array_push($element,$val);
		}
		echo "php done";
		
	?>
	
	<p id = "user_device_id" ><?php echo $id;?><br/></p>
	
	<script type="text/javascript">
	    //var select = document.getElementById("variable").innerHTML;
		//document.write(select);
		// Access the array elements 
		var passedArray =  <?php echo json_encode($element); ?>;
		//Display the array elements 
		/*for(var i = 0; i < passedArray.length; i++){
			document.write('<br/>');
			document.write(passedArray[i]); 
		}*/
		
		var select = document.getElementById("select"),arr = passedArray;
             
         for(var i = 0; i < arr.length; i++){
            var option = document.createElement("OPTION"),
            txt = document.createTextNode(arr[i]);
            option.appendChild(txt);
            option.setAttribute("value",arr[i]);
            select.insertBefore(option,select.lastChild);
		}
			 
		function myFunction() {
			var x = document.getElementById("select").value;
			document.getElementById("demo").innerHTML = "You selected: " + x;	
		}
		
		function fetchdata(){
			$.ajax({
			url: 'storeGlobal.php', 
			data: {id:document.getElementById("select").value},
			type: 'post',
			success: function(response){
			// Perform operation on the return value
			$("#flowchart01").html(response);
			//$("#myChart").load('storeGlobal.php');
			}});		
		}
		
		function fetchflow(){
			$.ajax({
			url: 'readflow.php', 
			data: {id1:document.getElementById("select").value},
			type: 'post',
			success: function(response){
			// Perform operation on the return value
			$("#flowValue").html(response);
			//$("#flowValue").load('readflow.php');
			}});		
		}
		
		function fetchdate(){
			$.ajax({
			url: 'readDate.php', 
			data: {id2:document.getElementById("select").value},
			type: 'post',
			success: function(response){
			// Perform operation on the return value
			$("#dateValue").html(response);
			//$("#dateValue").load('readDate.php');
			}});		
		}
		
		function fetchtime(){
			//getElem();
			$.ajax({
			url: 'readtime.php', 
			data: {id3:document.getElementById("select").value},
			type: 'post',
			success: function(response){
			// Perform operation on the return value
			$("#timeValue").html(response);
			//$("#timeValue").load('readtime.php');
			}});		
		}
		
		function fetchtotal(){
			$.ajax({
			url: 'readtotalise.php', 
			data: {id4:document.getElementById("select").value},
			type: 'post',
			success: function(response){
			// Perform operation on the return value
			$("#totaliseValue").html(response);
			//$("#totaliseValue").load('readtotalise.php');
			}});		
		}
		
		function getElem() {
			var x = document.getElementById("timevalue").text;
			document.getElementById("test").innerHTML = "You selected: " + x;	
		}
		
		$(document).ready(function() {
			setInterval(fetchdata, 1000);
		});
		
		$(document).ready(function() {
			setInterval(fetchflow, 2000);
		});
		
		$(document).ready(function() {
			setInterval(fetchtime, 3000);
		});
		
		$(document).ready(function() {
			setInterval(fetchdate, 4000);
		});
		
		$(document).ready(function() {
			setInterval(fetchtotal, 5000);
		});
		
		$(document).ready(function() {
			setInterval(function () {
				$('#flowchart02').load('dbdatabase.php')
			}, 30000);
		});
		
		$(document).ready(function(){
			setInterval(updateChart, 6000);
		});
		var x_data = ['1', '2', '3', '4', '5', '6', '7'];
		var y_data = [0, 10, 5, 2, 20, 30, 45];
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
				borderColor: 'rgb(0, 99, 132)',
				data: y_data,
			}]
		},

		// Configuration options go here
		options: {}
		});	
		
		function updateChart(){
			var instance = document.getElementById("timevalue");
			var instance_flow = document.getElementById("flowvalue");
			chart.data.datasets[0].data.shift();
			chart.data.labels.shift();
			//chart.data.datasets[0].data.push(instance_flow);
			//chart.data.labels.push(instance);
			chart.data.datasets[0].data.push(10);
			chart.data.labels.push(20);
			chart.update();
		};

	</script>
		
</body>
</html> 




















