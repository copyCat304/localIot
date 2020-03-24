<?php
	session_start();
    error_reporting(E_ALL);

	class DB_VALIDATE{
		function validate($a,$b){
			console.log("hie");

			$filepath = realpath(dirname(__FILE__));
			require_once($filepath."/dbconfig.php");
			
			$conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);
			
			if ($conn->connect_errno) {
                die("Connection failed: " . $conn->connect_error);
				console.log( "connection failed");
            }
			
            echo "Connected successfully <br/>";
			
            if($result =  $conn->query("SELECT * FROM logindetails")){
                echo "hie<br/>";
                while($row = $result->fetch_object()){
                    //echo $row->logId, $row->logPass,'<br/>'; 
                    if($a == $row->logId){
                        if($b == $row->logPass){
                            console.log("matched ID is ");
							console.log( $row->id);
							$_SESSION['id'] = $row->id;
							$_SESSION['username'] = $row->logId;
							console.log( $_SESSION['id']);
							echo "<script type = 'text/javascript'> document.location = 'dashboard.php';</script>";	
                            //echo "<script type = 'text/javascript'> document.location = 'https://www.youtube.com/';</script>";	
                        }
                    }
                }
            // 
            // require_once($filepath."/jump_fail.php");
	        // $f = new DB_FAIL();
            // $f->returnBack($con);
            // 
            //echo "<script type = 'text/javascript'> document.location = 'https://www.google.com/';</script>";
			echo "<script type = 'text/javascript'> document.location = 'facelogin.php';</script>";
            console.log( $conn->error);
			console.log( "done<br/>");
            }
		}                                                       
	}
 ?>