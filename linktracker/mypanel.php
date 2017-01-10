<?php
  //Include MySQL Database Connection.
  require_once "class/require.php";


if(isset($_COOKIE['usr'])){ 

        $email = $_COOKIE['usr'];  
        $pass = $_COOKIE['key']; 
        $check = mysql_query("SELECT * FROM users WHERE slt_user_email = '$email'")or die(mysql_error());
        $email = mysql_real_escape_string($_POST['slt_user_email']);
        $res=mysql_query("SELECT * FROM users WHERE slt_user_email='$email'");

    while($info = mysql_fetch_array( $check ))   {
        $user_id = $info["slt_user_id"]; 
        $userid = $info["slt_user_id"]; 
        if ($pass != $info['slt_user_password']) 
            {           header("Location: ".$app_path); 

            } else { 

  //tracking data  
  $track = $_GET["src"]; 

?>
<html>
<head>
    <title>MyPanel :: Simple Link Tracker</title>
    <link href="/<?php echo $app_path; ?>css/jquery-ui.css" rel="stylesheet">
    <link href="/<?php echo $app_path; ?>css/font-awesome.css" rel="stylesheet">
    <link href="/<?php echo $app_path; ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="/<?php echo $app_path; ?>css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="/<?php echo $app_path; ?>css/bootstrap-overrides.css" rel="stylesheet">
</head>
<body style="background-color: #e2f2ff;">

<br><br>
<center>
  <h3>Simple Link Tracker</h3><br>
 

<center>
  <div style="background:white;border:1px solid grey; width:250px;border-radius: 4px;" class="options">
  		<p>Create Links</p>
      <form action="includes/create_link.php" method="POST">
  		<input type="text" class="form-control" style="width:90%;border-radius: 2px; border:1px solid #c1c1c1;" name="linkaddr" placeholder="Enter a link URL."></input><br>
  		<button class="btn btn-success sebuild" id="submit" name="submit" type="submit"> Create Tracker</button><br><br>
  	</form>
  </div>
<a target="_blank" href="http://marcosraudkett.com/" style="font-size: 10px;">Simple Link Tracker by Marcos Raudkett</a>

  
      <?php 

         if($track == '') {

        } else {
          echo '<br><a class="btn btn-default" href="mypanel.php">Back</a>';
        }

      ?>
<div style="margin-top:75px;background:white;border:1px solid grey; width:750px;border-radius: 4px;" class="options">
      
      <?php 

         if($track == '') {

          include ("includes/links.php");

        } else {

          $get_tracking = mysql_query("SELECT * FROM tracking WHERE slt_tracking_trackid = '$track' LIMIT 0, 25");
          $get_links = mysql_query("SELECT * FROM links WHERE slt_link_userid = '$userid'");
          $get_link = mysql_fetch_assoc($get_links);
          $get_tracking_amount = mysql_num_rows($get_tracking);
            echo '<h4>Link:</h4> <p style="font-style:italic;">'.$get_link["slt_link_baseurl"].'</p>';
            echo '<h4>Tracking:</h4> <p style="font-style:italic;">'.$get_link["slt_link_url"].'</p><br><br>';
            echo '<b>Total:</b> '.$get_tracking_amount.'<br><br>';

          while($row = mysql_fetch_assoc($get_tracking)) {
            echo '<div style="text-align:left;">';
            echo '<p><b>IP Address: </b>'.$row["slt_tracking_ipaddr"].'</p>';
            echo '<p><b>Useragent: </b>'.$row["slt_tracking_useragent"].'</p>';
            echo '<p><b>Referral:</b> '.$row["slt_tracking_referral"].'</p>';
            echo '<p><b>Vsisit Time: </b>'.$row["slt_tracking_time"].'</p>';
            echo '</div>';
        }
      }

      ?>

</div>




<footer style="bottom:0;font-family:monospace;position: fixed;padding: 10px;background:#e6e6e6;width:100%;">
  <p style="display:inline;">MyPanel 0.0.1 :: Simple Link Tracker</p>&nbsp;<a class="btn btn-default" href="func/signout.php">Sign Out</a>
</footer>


</center>
<!-- JS -->
<script src="/<?php echo $app_path; ?>js/jquery-1.10.2.js"></script>
<script src="/<?php echo $app_path; ?>js/jquery-ui.js"></script>
<script src="/<?php echo $app_path; ?>js/jQuery-2.1.4.min.js"></script>
</body>             
</html>
<?php
 } } } else {
//if the cookie does not exist, they are taken to the root page (login)
header("Location: /".$app_path); } 
?> 