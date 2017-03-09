<?php

  //Include MySQL Database Connection from require.php -> config.php...
  require_once "class/require.php";

  //visitor data $_SERVER
  $slt_useragent = $_SERVER['HTTP_USER_AGENT'];
  $slt_ipaddr = $_SERVER['REMOTE_ADDR'];
  $slt_regerral = $_SERVER['HTTP_REFERER'];

  //ip-api.com API part..
  $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$slt_ipaddr));
   if($query && $query['status'] == 'success') {
      $slt_country = $query['country'];
      $slt_region = $query['region'];
      $slt_city = $query['city'];
      $slt_zip = $query['zip'];
      $slt_lat = $query['lat'];
      $slt_lon = $query['lon'];
  } else {

  }
  //ip-api.com end

  //bookmark widget .php
  $auto = $_GET["url"];
  if($auto == 'ref') {
    $auto = $_SERVER['HTTP_REFERER'];
  }
  //bookmark widget end

  //tracking data get the link info.
  $track = $_GET["src"];

  if($track == '') {
    //do something
  } else {
    $get_tracking = mysql_query("SELECT * FROM links WHERE slt_link_trackingid = '$track'");
    while($row = mysql_fetch_assoc($get_tracking)) {
      $slt_link_url = $row["slt_link_url"];
      $slt_link_baseurl = $row["slt_link_baseurl"];
      $slt_link_trackingid = $row["slt_link_trackingid"];
        //here we check for Unique visitors... we could skip this part with "goto update;"
        $get_visitor = mysql_query("SELECT * FROM tracking WHERE slt_tracking_ipaddr = '$slt_ipaddr' AND slt_tracking_trackid = '$slt_link_trackingid'");
          $get_visitor_amount = mysql_num_rows($get_visitor);
            if($get_visitor_amount > 0) {
              //if this user has already visited the following link already.
              //goto update; <- remove // if you want to update if this ip has already visited. (loss of unique visitors, all visitors will be logged even if it's the same IP Address..)
              header("Location: ".$slt_link_baseurl);
            } else {
              update:

              //BLOCK BOTS there should be a string...

              if(strpos($_SERVER['HTTP_USER_AGENT'], 'http://help.yahoo.com/help/us/ysearch/slurp') !== false) {
                die("Sorry, Bots are not allowed. :/");
              }
              if(strpos($_SERVER['HTTP_USER_AGENT'], 'Applebot') !== false) {
                die("Sorry, Bots are not allowed. :/");
              }
              if(strpos($_SERVER['HTTP_USER_AGENT'], 'Twitterbot') !== false) {
                die("Sorry, Bots are not allowed. :/");
              }
              if(strpos($_SERVER['HTTP_USER_AGENT'], 'facebookexternalhit') !== false) {
                die("Sorry, Bots are not allowed. :/");
              }
              if(strpos($_SERVER['REMOTE_ADDR'], '31.13.114.64') !== false) {
                die("Sorry, Bots are not allowed. :/");
              }
              if(strpos($_SERVER['REMOTE_ADDR'], '199.16.157.180') !== false) {
                die("Sorry, Bots are not allowed. :/");
              }
              if(strpos($_SERVER['REMOTE_ADDR'], '17.142.156.211') !== false) {
                die("Sorry, Bots are not allowed. :/");
              }
              if(strpos($_SERVER['REMOTE_ADDR'], '23.96.208.137') !== false) {
                die("Sorry, Bots are not allowed. :/");
              }
              if(strpos($_SERVER['REMOTE_ADDR'], '72.30.14.67') !== false) {
                die("Sorry, Bots are not allowed. :/");
              }
              if(strpos($_SERVER['HTTP_USER_AGENT'], 'http://l.facebook.com/lsr.php') !== false) {
                die("Sorry, Bots are not allowed. :/");
              }
              if(strpos($_SERVER['HTTP_USER_AGENT'], '31.13.114.78') !== false) {
                die("Sorry, Bots are not allowed. :/");
              }
              if(strpos($_SERVER['HTTP_USER_AGENT'], 'bot') !== false) {
                die("Sorry, Bots are not allowed. :/");
              }
              if(strpos($_SERVER['HTTP_USER_AGENT'], 'facebook.com/lsr.php?u=') !== false) {
                die("Sorry, Bots are not allowed. :/");
              }


              //if this user has not visited.
              $insertdata = mysql_query("INSERT INTO tracking 
                (slt_tracking_trackid, slt_tracking_ipaddr, slt_tracking_country, slt_tracking_region, slt_tracking_city, slt_tracking_zip, slt_tracking_lat, slt_tracking_lon, slt_tracking_referral, slt_tracking_useragent) 
                VALUES 
                ('$slt_link_trackingid', '$slt_ipaddr', '$slt_country', '$slt_region', '$slt_city', '$slt_zip', '$slt_lat', '$slt_lon', '$slt_regerral', '$slt_useragent')");
              //update total visits row.
              $insertdata = mysql_query("UPDATE links SET slt_link_total = slt_link_total + 1 WHERE slt_link_trackingid = '$slt_link_trackingid'");
              //redirect user to the target site.
              header("Location: ".$slt_link_baseurl);
            }
    }
  }



if(isset($_COOKIE['usr'])) { 

$email = $_COOKIE['usr'];  
$pass = $_COOKIE['key'];    
$check = mysql_query("SELECT * FROM users WHERE slt_user_email = '$email'")or die(mysql_error());  

while($info = mysql_fetch_array( $check )) {     

    if ($pass != $info['password']) {             

    }     else      {       
        header("Location: mypanel.php");      
    }     } } 

 if (isset($_POST['submit'])) { 
  if(!$_POST['email'] | !$_POST['pass']) {
    die('You did not fill in a required field.');
  }

  if (!get_magic_quotes_gpc()) {
    $_POST['email'] = addslashes($_POST['email']);
  }

  $check = mysql_query("SELECT * FROM users WHERE slt_user_email = '".$_POST['email']."'")or die(mysql_error());
  $check2 = mysql_num_rows($check);

  if ($check2 == 0) {
      die('That user does not exist in our database.');
  }

 while($info = mysql_fetch_array( $check )) {

  $_POST['pass'] = stripslashes($_POST['pass']);
  $info['slt_user_password'] = stripslashes($info['slt_user_password']);
  $_POST['pass'] = ($_POST['pass']);

  if ($_POST['pass'] != $info['slt_user_password']) {
    die('Incorrect password, please try again.');
  } else { 

  $_POST['email'] = stripslashes($_POST['email']); 
  $hour = time() + 3600; 

 setcookie(usr, $_POST['email'], $hour, '/'.$app_path); 
 setcookie(key, $_POST['pass'], $hour, '/'.$app_path);  
 header("Location: mypanel.php"); 
} } } else {  

  
?><form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<html>
<head>
    <title>Simple Link Tracker</title>
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
 
 <!-- Bookmark widget. -->
  <a id="bookmarklet" href="javascript:void(window.open('http://x-url.eu/?url='+encodeURIComponent(document.URL)))" onclick="return false;">Shorten</a>
   <div id="bookmarklet_bg">Drag and drop on Bookmark bar</div>

   <style>
   #bookmarklet { 
      height: 90px; top: 50px; position: absolute; width: 100%; background: transparent; z-index: 10;
      line-height: 150px; font-size: 0; font-weight: bold; text-align: center; text-decoration: none;
      cursor: move;
    }
    #bookmarklet_bg { 
      height: 90px; top: 20px; position: absolute; width: 100%; background: #34495e; border-radius: 6px; 
      line-height: 150px; font-size: 16px; color: #fff; font-weight: bold; text-align: center; text-decoration: none;
    }
   </style>


<center>
  <div style="background:white;border:1px solid grey; width:250px;border-radius: 4px;" class="options">
  		<p>Sign In to Link Tracker</p>
  		<input type="text" class="form-control" style="width:90%;border-radius: 2px; border:1px solid #c1c1c1;" name="email" placeholder="Email Address"></input><br>
  		<input type="password" class="form-control" style="width:90%;border-radius: 2px; border:1px solid #c1c1c1;" name="pass" id="pass" placeholder="Password"></input><br>
  		<button class="btn btn-success sebuild" id="submit" name="submit" type="submit"> Sign In</button><br><br>
  	</form>
  </div>
<a target="_BLANK" style="font-size: 10px;">Simple Link Tracker</a>
</center>

<?php 
   if($auto == '') { 
        
       } else {
       echo '
        <script type="text/javascript">
            $(window).load(function(){
                 $(\'#submit\').click();
             });
        </script>';
       }
   ?>

</body>             
</html>

<?php } ?> 
