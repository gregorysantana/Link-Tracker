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
      <legend>Active Links <a class="btn btn-default btn-xs" onclick="tableview()" id="tbl" href="javascript:void(0);"><i class="fa fa-table" aria-hidden="true"></i> Table View</a><a style="display:none;" class="btn btn-default btn-xs" onclick="listview()" id="liv" href="javascript:void(0);"><i class="fa fa-table" aria-hidden="true"></i> List View</a></legend> 
      <?php 

         if($track == '') {

          include ("includes/links.php");

        } else {

          $get_tracking = mysql_query("SELECT * FROM tracking WHERE slt_tracking_trackid = '$track' LIMIT 0, 25");
          $get_tracking_table = mysql_query("SELECT * FROM tracking WHERE slt_tracking_trackid = '$track' LIMIT 0, 125");
          $get_links = mysql_query("SELECT * FROM links WHERE slt_link_userid = '$userid'");
          $get_link = mysql_fetch_assoc($get_links);
          $get_tracking_amount = mysql_num_rows($get_tracking);
            echo '<h4>Link:</h4> <p style="font-style:italic;">'.$get_link["slt_link_baseurl"].'</p>';
            echo '<h4>Tracking:</h4> <p style="font-style:italic;">'.$get_link["slt_link_url"].'</p><br>';
            echo '<b>Unique Visitors:</b> '.$get_tracking_amount.'<br><br>';

          echo '<div id="listview">';
          while($row = mysql_fetch_assoc($get_tracking)) {
            echo '<div class="well" style="text-align:left;">';
            echo '<p><b>IP Address: </b>'.$row["slt_tracking_ipaddr"].' <a class="btn btn-warning btn-xs" target="_blank" href="http://ip-api.com/#'.$row["slt_tracking_ipaddr"].'">Lookup <i style="font-size: 10px;" class="fa fa-external-link" aria-hidden="true"></i></a></p>';
          if($row["slt_tracking_useragent"] == '') { 
            echo '<p style="color:#a52424;"><b>Unresolved useragent.</b></p>';
          } else {
            echo '<p><b>Useragent: </b>'.$row["slt_tracking_useragent"].'</p>';
          }
          if($row["slt_tracking_referral"] == '') {
            echo '<p style="color:#a52424;"><b>Possibly a Direct Hit</b></p>';
          } else {
            echo '<p><b>Referral:</b> '.$row["slt_tracking_referral"].' <a class="btn btn-default btn-xs" target="_blank" href="'.$row["slt_tracking_referral"].'">Visit</a> <a class="btn btn-default btn-xs" target="_blank" href="https://whois.domaintools.com/'.$row["slt_tracking_referral"].'">Whois</a></p>';            
          }
            echo '<p><b>Vsisit Time: </b>'.$row["slt_tracking_time"].'</p>';
            echo '</div>';
        }
        echo '</div>';
         echo '<div style="display:none;" id="tableview">';
          echo '<table class="table">';
          echo '<thead>';
          echo '<tr>
                  <th>IP Address</th>
                  <th>Referral</th>
                  <th>Visit Time</th>
                </tr>
                <tr>
                  <tbody>';
          while($rows = mysql_fetch_assoc($get_tracking_table)) {
            echo '<td>'.$rows["slt_tracking_ipaddr"].' 
            <a class="btn btn-warning btn-xs" target="_blank" href="http://ip-api.com/#'.$rows["slt_tracking_ipaddr"].'">Lookup <i style="font-size: 10px;" class="fa fa-external-link" aria-hidden="true"></i></a></td>';
          
          if($rows["slt_tracking_referral"] == '') {
            echo '<td style="color:#a52424;"><b>Possibly a Direct Hit</b></td>';
          } else {

            echo '<td style="max-width:100px;">'.substr($rows["slt_tracking_referral"],0, 21).' <br><a class="btn btn-default btn-xs" target="_blank" href="'.$rows["slt_tracking_referral"].'">Visit</a> <a class="btn btn-default btn-xs" target="_blank" href="https://whois.domaintools.com/'.$rows["slt_tracking_referral"].'">Whois</a></td>';            
          }
            echo '<td>'.$rows["slt_tracking_time"].'</td>';
          echo '</tbody></tr>';
        }
          echo '</table>';
      echo '</div>';

      }

      ?>

</div>
<br><br><br>



<footer style="bottom:0;font-family:monospace;position: fixed;padding: 10px;background:#e6e6e6;width:100%;">
  <p style="display:inline;">MyPanel 0.0.1 :: Simple Link Tracker</p>&nbsp;<a class="btn btn-default" href="func/signout.php">Sign Out</a>
</footer>


<script type="text/javascript">
function tableview() {
   $("#listview").slideUp("mypanel.php #listview");
   $("#tbl").hide("mypanel.php #tbl");
   $("#liv").show("mypanel.php #liv");
   $("#tableview").slideDown("mypanel.php #tableview");
}
function listview() {
   $("#listview").slideDown("mypanel.php #listview");
   $("#liv").hide("mypanel.php #liv");
   $("#tbl").show("mypanel.php #tbl");
   $("#tableview").slideUp("mypanel.php #tableview");
}
</script>

</center>
<!-- LOAD ANIM -->
<script src="http://mvrclabs.info/se/labcode/third/jQuery-2.1.4.min.js"></script>
<script src="http://mvrclabs.info/se/labcode/showhide.js"></script>
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