<?php 

	
	include ("../class/require.php");

	if(isset($_COOKIE['usr'])){ 

        $email = $_COOKIE['usr'];  
        $pass = $_COOKIE['key']; 
        $check = mysql_query("SELECT * FROM users WHERE slt_user_email = '$email'")or die(mysql_error());
        $email = mysql_real_escape_string($_POST['slt_user_email']);
        $res=mysql_query("SELECT * FROM users WHERE slt_user_email='$email'");

    while($info = mysql_fetch_array( $check ))   {
        $user_id = $row["slt_user_id"]; 
        if ($pass != $info['slt_user_password']) 
            {           header("Location: ".$app_path); 

            } else { 


	        $tid = $_POST["tid"];
	        $d = mysql_query("DELETE FROM tracking WHERE slt_tracking_trackid = '$tid'");
	        $d2 = mysql_query("DELETE FROM links WHERE slt_link_trackingid = '$tid'");

			//Send user back to previous site..
			header("Location: ".$_SERVER["HTTP_REFERER"]);



} } } else {
//if the cookie does not exist, they are taken to the root page (login)
header("Location: /".$app_path); } 


?>