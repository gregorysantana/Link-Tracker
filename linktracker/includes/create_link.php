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






		$link = $_POST["linkaddr"];
		$username = $_COOKIE['usr'];

		$get_user = mysql_query("SELECT * FROM users WHERE slt_user_email = '$username'");
		while($row = mysql_fetch_assoc($get_user)) {
			$user_id = $row["slt_user_id"];
		}

		$get_links = mysql_query("SELECT * FROM links WHERE slt_link_baseurl = '$link' AND slt_link_userid = '$user_id'");
			$get_links_amount = mysql_num_rows($get_links);

			/*if($get_links_amount != 0) {
				die("This link is already in use!");
			}*/

		$hash = md5( rand( 0, 1000 ) . rand( 0, 1000 ) . rand( 0, 1000 ) . rand( 0, 1000 ) );

		//CREATE
		$slt_link = $myhost.$app_path.'?src='.$hash;
			
		$inser_links = mysql_query("INSERT INTO links (slt_link_url, slt_link_baseurl, slt_link_userid, slt_link_trackingid, slt_link_total) VALUES ('$slt_link', '$link', '$user_id', '$hash', '0')");


		//Send user back to previous site..
		header("Location: ".$_SERVER["HTTP_REFERER"]);





} } } else {
//if the cookie does not exist, they are taken to the root page (login)
header("Location: /".$app_path); } 


?>