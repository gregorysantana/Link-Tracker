<?php
  

  /* 
     Before using this make sure you've made a backup of
     /class/config.php file!
     This Script will handle everything for you
     It will install the script onto your server and
     Set mysql data. this is ONLY recommended if you have
     a blank database without following tables:

     @users
     @links
     @tracking

     Installer and Tiny 'Simple' Link Tracker by Marcos Raudkett
     https://marcosraudkett.com/
     https://github.com/marcosraudkett/linktracker

     If you have any questions about this script then please contact me at
     projects@marcosraudkett.com

   */


  /*
    VAR
    You can change these below to your needs.
  */

    $db_new_host = $_POST["h"];
    $db_new_username = $_POST["u"];
    $db_new_name = $_POST["n"];
    $db_new_pass = $_POST["p"];


    $sql_link_url        = 'http://mvrclabs.info/linktracker/?src=0032fb939e3425e65db3b6867ced8b80';
    $sql_link_baseurl    = 'http://marcosraudkett.com/';
    $sql_link_trackingid = '0032fb939e3425e65db3b6867ced8b80';

    $sql_email = 'admin@slt.com';
    $sql_passw = '123123';


  /* @INSTALL 
     Here we install everything.
  */

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

      //connetction to the database (change to whatever you'd like.)
      $conn = mysql_connect($db_new_host, $db_new_username, $db_new_pass) or die(mysql_error()); mysql_select_db($db_new_name) or die(mysql_error()); 
      //charset to UTF8
      mysql_set_charset("utf8", $conn);

     if(mysql_num_rows(mysql_query("SHOW TABLES LIKE 'users'"))==1) {
        die("Unable to install slt at table: 'Users' this might be caused if you already have installed slt or have users table! check config.php file.");
     }

     if(mysql_num_rows(mysql_query("SHOW TABLES LIKE 'links'"))==1) {
        die("Unable to install slt at table: 'links' this might be caused if you already have installed slt or have links table! check config.php file.");
     }

     if(mysql_num_rows(mysql_query("SHOW TABLES LIKE 'tracking'"))==1) {
        die("Unable to install slt at table: 'tracking' this might be caused if you already have installed slt or have users table! check config.php file.");
     }

        $install_sql_links = mysql_query('CREATE TABLE links (
                slt_link_id int(11) NOT NULL AUTO_INCREMENT,
                slt_link_url varchar(255) NOT NULL,
                slt_link_baseurl varchar(255) NOT NULL,
                slt_link_userid varchar(255) NOT NULL,
                slt_link_trackingid varchar(255) NOT NULL,
                slt_link_total varchar(255) NOT NULL,
                slt_link_created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (slt_link_id)
              )');

        $install_sql_links_insert = mysql_query("INSERT INTO `links` VALUES(24, '$sql_link_url', '$sql_link_baseurl', '1', '$sql_link_trackingid', '0', '2017-01-09 16:18:22')");

        $install_sql_tracking = mysql_query('CREATE TABLE tracking (
                slt_tracking_id int(11) NOT NULL AUTO_INCREMENT,
                slt_tracking_trackid varchar(255) NOT NULL,
                slt_tracking_ipaddr varchar(255) NOT NULL,
                slt_tracking_country varchar(255) NOT NULL,
                slt_tracking_region varchar(255) NOT NULL,
                slt_tracking_city varchar(255) NOT NULL,
                slt_tracking_zip varchar(255) NOT NULL,
                slt_tracking_lat varchar(255) NOT NULL,
                slt_tracking_lon varchar(255) NOT NULL,
                slt_tracking_referral varchar(255) NOT NULL,
                slt_tracking_useragent varchar(255) NOT NULL,
                slt_tracking_time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (slt_tracking_id)
              )');


        $install_sql_users = mysql_query('CREATE TABLE users (
                slt_user_id int(11) NOT NULL AUTO_INCREMENT,
                slt_user_email varchar(255) NOT NULL,
                slt_user_password varchar(255) NOT NULL,
                slt_user_created timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (slt_user_id)
              )');

        $install_sql_users_insert = mysql_query("INSERT INTO `users` VALUES(1, '$sql_email', '$sql_passw', '2017-01-09 04:59:43')");


         $fconf = 'config.php';
         $fp=fopen('../class/'.$fconf,'w');
          fwrite($fp, '<?php
  /*
    Simple Link Tracker Configuration. 
    https://marcosraudkett.com/link_tracker.html
    https://github.com/marcosraudkett/linktracker
    Generated automatically by Installer.
  */


    /* MySQL Database Hostname */   $db_host  = \''.$db_new_host.'\';
    /* MySQL Database Name */       $db_name  = \''.$db_new_name.'\';
    /* MySQL Database Username */   $db_user  = \''.$db_new_username.'\';
    /* MySQL Database Password */   $db_pass  = \''.$db_new_pass.'\';                            

                      //Your full domain: http://mydomain.com/ ex: "http://mvrclabs.info/"
                      $myhost   = \'http://'.$_SERVER['HTTP_HOST'].'/'.'\';              
                      //Root App Path that comes after above domain. ex: "linktracker/"
                      $app_path = \'linktracker/\';                     

?>');
          fclose($fp);




        /*
            @INSTALLATION COMPLETE
        */

        if ($fp === false) {
            return $written;
        }

        exit("Successfully Installed.");
      } else {

      }



  
?><form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
<html>
<head>
    <title>Install :: Simple Link Tracker</title>
    <link href="../css/jquery-ui.css" rel="stylesheet">
    <link href="../css/font-awesome.css" rel="stylesheet">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="../css/bootstrap-overrides.css" rel="stylesheet">
</head>
<body style="background-color: #e2f2ff;">

<br><br>
<center>
  <h3 title="Simple Link Tracker">SLT Installer</h3><br>
 

<center>
  <div style="background:white;border:1px solid grey; width:450px;border-radius: 4px;" class="options">
  		<p>MySQL Information</p>
  		<input type="text" class="form-control" style="width:90%;border-radius: 2px; border:1px solid #c1c1c1;" name="h" title="Your MySQL Hostname" placeholder="Database Hostname"></input><br>
      <input type="text" class="form-control" style="width:90%;border-radius: 2px; border:1px solid #c1c1c1;" name="u" id="Username" title="Your MySQL Username" placeholder="Database Username"></input><br>
      <input type="text" class="form-control" style="width:90%;border-radius: 2px; border:1px solid #c1c1c1;" name="n" id="Name" title="Your MySQL Name" placeholder="Database Name"></input><br>
  		<input type="password" class="form-control" style="width:90%;border-radius: 2px; border:1px solid #c1c1c1;" name="p" id="pass" title="Your MySQL Password" placeholder="Database Password"></input><br>
  		Account Details: Username: <?php echo $sqt_email; ?> Password: <?php echo $sqt_passw ?> <br><br>
      <button class="btn btn-info sebuild" id="submit" name="submit" type="submit"> Install</button><br><br>
  	</form>
  </div>
<a target="_BLANK" style="font-size: 10px;">Simple Link Tracker :: Install</a>
</center>



</body>             
</html>
