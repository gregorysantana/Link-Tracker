<?php 

include ("../class/require.php");

	 $past = time() - 100; 
	 setcookie(usr, gone, $past, '/'.$app_path); 
	 setcookie(key, gone, $past, '/'.$app_path); 

//redirect homepage
 header("Location: /".$app_path); 

 ?> 