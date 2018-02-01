<?php 
	
	include ("config.php");

	//connetction to the database (change to whatever you'd like.)
	//You don't need to modify this file, to modify mysql info you can do it in class/config.php file.
	$conn = mysqli_connect($db_host, $db_user, $db_pass) or die("Unable to connect to database. Please use web installer at 'www.yourdomain.com/Installer/'"); 
	mysqli_select_db($conn, $db_name) or die(mysqli_error()); 
	//charset to UTF8
	//mysqli_set_charset("utf8", $conn);


?>
