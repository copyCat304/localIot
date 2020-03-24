<?php
	session_start();
	//if(isset($_SESSION['username'])){
		session_unset();
		session_destroy();
		echo "<script type = 'text/javascript'> document.location = 'facelogin.php';</script>";
	//}
?>