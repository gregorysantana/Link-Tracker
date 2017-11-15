<?php
  //Include MySQL Database Connection.
  require_once "../class/require.php";
if(isset($_COOKIE['usr'])){ 
        $email = $_COOKIE['usr'];  
        $pass = $_COOKIE['key']; 
        $check_query = "SELECT * FROM users WHERE slt_user_email = '$email'";
        $check = mysqli_query($conn, $check_query);
        $email = mysqli_real_escape_string($conn, $_POST['slt_user_email']);
        $res_query = "SELECT * FROM users WHERE slt_user_email='$email'";
        $res = mysqli_query($conn, $res_query);
        
      while($info = mysqli_fetch_array( $check ))   {
        $user_id = $info["slt_user_id"]; 
        $userid = $info["slt_user_id"]; 
        if ($pass != $info['slt_user_password']) {           
          header("Location: ".$app_path); 
        } else { 


	        $tid = $_POST["tid"];
	        $d_query = "DELETE FROM tracking WHERE slt_tracking_trackid = '$tid'";
            $d = mysqli_query($conn, $d_query);
            $d2_query = "DELETE FROM links WHERE slt_link_trackingid = '$tid'";
            $d2 = mysqli_query($conn, $d2_query);


			//Send user back to previous site..
			header("Location: ".$_SERVER["HTTP_REFERER"]);



} } } else {
//if the cookie does not exist, they are taken to the root page (login)
header("Location: /".$app_path); } 


?>
