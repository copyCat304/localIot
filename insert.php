<?php
	error_reporting(E_ALL);

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $a = $_POST["a"];
        $b = $_POST["b"];
        $c = $_POST["c"];
        // $d = $_POST["d"];
        // $e = $_POST["e"];
		// $f = $_POST["f"];
        // $g = $_POST["g"];
        // $h = $_POST["h"];
		    
		if($c == 'nuidq87hn9h310u098qyeljouHDUBH8xt'){
			$filepath = realpath(dirname(__FILE__));
				
			require_once($filepath."/dbconfig.php");
			$conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
			if ($conn->connect_errno) {
				die("Connection failed: " . $conn->connect_error);
				}
				
			// if ($conn->query("INSERT INTO pis1tag01(`day`, `month`, `year`, `hour`, `minute`, `second`, `flow`, `totalise`) VALUES ($a,$b,$c,$d,$e,$f,$g,$h)")) {
				// echo "New record created successfully";
			// } 
			// else {
				// echo "Error: " . $sql . "<br>" . $conn->error;
			// }
		
			
			if ($conn->query("UPDATE device_data SET date = now(),flow=$a,totalise=$b WHERE device_id = 1;")) {
				echo "New record updated successfully";
			} 
			else {
				echo "Error: " . $sql . "<br>" . $conn->error;
			}
		
			$conn->close();
    
		}
	}
	else {
		echo "No data posted with HTTP POST.";
	}

?>


