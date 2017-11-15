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






		$link = $_POST["linkaddr"];
		$username = $_COOKIE['usr'];

		$get_user_query = "SELECT * FROM users WHERE slt_user_email = '$username'";
		$get_user = mysqli_query($conn, $get_user_query);
		while($row = mysqli_fetch_assoc($get_user)) {
			$user_id = $row["slt_user_id"];
		}

		$get_links_query = "SELECT * FROM links WHERE slt_link_baseurl = '$link' AND slt_link_userid = '$user_id'";
		$get_links = mysqli_query($conn, $get_links_query);
			$get_links_amount = mysqli_num_rows($get_links);

			/*if($get_links_amount != 0) {
				die("This link is already in use!");
			}*/

		$hash = substr(md5( rand( 0, 1000 ) . rand( 0, 1000 ) . rand( 0, 1000 ) . rand( 0, 1000 ) ),0,7);

		//CREATE
		$slt_link = $myhost.$app_path.'?src='.$hash;
			
		$inser_links_query = "INSERT INTO links (slt_link_url, slt_link_baseurl, slt_link_userid, slt_link_trackingid, slt_link_total) VALUES ('$slt_link', '$link', '$user_id', '$hash', '0')";
		$inser_links = mysqli_query($conn, $inser_links_query);


		//Send user back to previous site..
		header("Location: ".$_SERVER["HTTP_REFERER"]);





} } } else {
//if the cookie does not exist, they are taken to the root page (login)
header("Location: /".$app_path); } 


?>
