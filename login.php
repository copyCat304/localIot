<?php   
	session_start();
	echo "in login.php<br />";
	//header("Access-Control-Allow-Origin: *");
	//header("Content-Type: application/json; character=UTF-8");
	$myusername = $_POST['username'];
	echo $myusername;
	echo "<br />";
	$mypassword = $_POST['password']; 
	echo $mypassword;
	echo "<br />";
	$filepath = realpath(dirname(__FILE__));
	require_once($filepath."/dbvalidate.php");
	echo "validate.php inserted";
	echo "<br />";
	$db = new DB_VALIDATE	();
	echo "valide object created<br />";
	echo "<br />";
	$db->validate($myusername,$mypassword);
?>	  

	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 