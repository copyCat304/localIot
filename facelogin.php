<?php
	session_start();
	if(isset($_SESSION['username'])){
		echo "<script type = 'text/javascript'> document.location = 'dashboard.php';</script>";
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

		<title>LOGIN</title>
	</head>
	<body class = "container-fluid bg-warning py-5"  style="width: 20rem;>
		<div class="col-md-10" style="width: 20rem;">
			<div class="card text-white bg-info mb-3 align-items-center">
				<div class="card-body">
					<h1 class="card-header">WELCOME</h1>
						<form action = "login.php" method = "post">
							<div class="card text-dark align-items-center">
								UserName	:<input type = "text" name = "username" /><br /><br />
								Password	:<input type = "password" name = "password" /><br/><br />
								<input type = "submit" value = " LOGIN "/><br />
							</div>
						</form>
				</div>
			</div>
	</body>
</html>  