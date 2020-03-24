<?php   
	session_start();
	if(!isset($_SESSION['uname'])){
		if(isset($_REQUEST['username']) && isset($_REQUEST['username'])){
			$user_name = $_REQUEST['username'];
			$password = $_REQUEST['password'];
			$_SESSION['uname'] = $user_name;
			$_SESSION['pass'] = $password;	
		}
		$filepath = realpath(dirname(__FILE__));
		require_once($filepath."/dbconfig.php");

		$conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASSWORD,DB_DATABASE);

		if ($conn->connect_errno) {
			die("Connection failed: " . $conn->connect_error);
			//echo "connection failed";
		}

		echo "Connected successfully <br/>";

		if($result =  $conn->query("SELECT * FROM logindetails")){
			//echo "hie<br/>";
			while($row = $result->fetch_object()){
				//echo $row->logId, $row->logPass,'<br/>'; 
				if($_SESSION['uname'] == $row->logId){
					if($_SESSION['pass'] == $row->logPass){
						$_SESSION['id'] == $row->id;
						echo $_SESSION['id'];
						echo "<script type = 'text/javascript'> document.location = 'dashboard.php';</script>";	
						//echo "<script type = 'text/javascript'> document.location = 'https://www.youtube.com/';</script>";	
					}
				}
			}
		echo "<script type = 'text/javascript'> document.location = 'login.php';</script>";
		echo $conn->error;
		}
	}else{
		echo "<script type = 'text/javascript'> document.location = 'dashboard.php';</script>";	
	}
?>	
  
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

		<title>LOGIN</title>
	</head>
	<body class = "container-fluid bg-warning py-5">
		<div class="col-md-10 offset-md-1"></div>
		<div class="col-md-2 offset-md-5" style="width: 20rem;">
			<div class="card  text-white bg-info mb-3 align-items-center">
				<div class="card-body">
					<h1 class="card-header">WELCOME</h1>
					<div class="card text-dark align-items-center">
					UserName	:<input type = "text" name = "username" /><br /><br />
					Password	:<input type = "password" name = "password" /><br/><br />
					<input type = "submit" value = " LOGIN "/><br />
					</div>
				</div>
			</div>
		<div class="col-md-10 offset-md-1"></div>
	</body>
</html>  
     
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 