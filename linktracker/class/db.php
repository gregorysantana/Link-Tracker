<?php 
	
	include ("config.php");

	//connetction to the database (change to whatever you'd like.)
	$conn = mysqli_connect($db_host, $db_user, $db_pass) or die(mysqli_error()); 
	mysqli_select_db($conn, $db_name) or die(mysqli_error()); 
	//charset to UTF8
	//mysqli_set_charset("utf8", $conn);


?>
