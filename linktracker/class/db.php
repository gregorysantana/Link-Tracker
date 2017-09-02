<?php 
	
	include ("config.php");

	//connetction to the database (change to whatever you'd like or use web installer)
		$conn = mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error()); mysql_select_db($db_name) or die(mysql_error()); 
	//charset to UTF8
		mysql_set_charset("utf8", $conn);


?>
