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
    <?php
    $get_tracking_charts = mysql_query("SELECT * FROM tracking WHERE slt_tracking_trackid = '$track' ORDER BY slt_tracking_time DESC");
    while($row = mysql_fetch_assoc($get_tracking_charts)) {
      $tref = $row["slt_tracking_referral"];
    }
    $direct = mysql_query("SELECT * FROM tracking 
      WHERE slt_tracking_trackid = '$track' 
      AND slt_tracking_referral = '' 
      ORDER BY slt_tracking_time DESC"); 

    $organic = mysql_query("SELECT * FROM tracking
      WHERE slt_tracking_trackid = '$track' 
      AND slt_tracking_referral 
      LIKE '%google%'
      OR slt_tracking_referral 
      LIKE '%yahoo%'
      OR slt_tracking_referral 
      LIKE '%bing%'
      OR slt_tracking_referral 
      LIKE '%ask%'
      OR slt_tracking_referral 
      LIKE '%duckduckgo%'
      ORDER BY slt_tracking_time DESC"); 

    $social = mysql_query("SELECT * FROM tracking 
      WHERE slt_tracking_trackid = '$track' 
      AND slt_tracking_referral 
      LIKE '%facebook%' 
      OR  slt_tracking_referral
      LIKE '%twitter%'
      OR slt_tracking_referral
      LIKE '%instagram%'
      ORDER BY slt_tracking_time DESC"); 

    $direct_total = mysql_num_rows($direct);
    $organic_total = mysql_num_rows($organic);
    $social_total = mysql_num_rows($social);

    ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Visits', 'Total'],
          ['Social',   <?php echo $social_total ?>],
          ['Direct',   <?php echo $direct_total ?>],
          ['Organic',  <?php echo $organic_total ?>]
        ]);

        var options = {
          title: '<?php  ?>'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
    <script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ["Element", "Density", { role: "style" } ],
        ["Social", <?php echo $social_total ?>, "#b87333"],
        ["Direct", <?php echo $direct_total ?>, "silver"],
        ["Organic", <?php echo $organic_total ?>, "gold"]
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Total Unique Visitors",
        width: 600,
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  </script>
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
      <legend><?php  if($track == '') { echo 'Active Links'; } else { ?>Your Link<?php } ?> <?php  if($track == '') { } else {?><a class="btn btn-default btn-xs" onclick="tableview()" id="tbl" href="javascript:void(0);"><i class="fa fa-table" aria-hidden="true"></i> Table View</a><a style="display:none;" class="btn btn-default btn-xs" onclick="listview()" id="liv" href="javascript:void(0);"><i class="fa fa-table" aria-hidden="true"></i> List View</a> <?php }; ?><?php  if($track == '') { } else {?> <a class="btn btn-default btn-xs" onclick="barview()" id="bchart" href="javascript:void(0);"><i class="fa fa-bar-chart" aria-hidden="true"></i> Bar Chart</a><a style="display:none;" class="btn btn-default btn-xs" onclick="cakeview()" id="pchart" href="javascript:void(0);"><i class="fa fa-pie-chart" aria-hidden="true"></i> Pie Chart</a> <?php }; ?></legend> 
      <?php 

         if($track == '') {

          include ("includes/links.php");

        } else {

          $get_tracking = mysql_query("SELECT * FROM tracking WHERE slt_tracking_trackid = '$track' ORDER BY slt_tracking_time DESC LIMIT 0, 125");
          $get_tracking_table = mysql_query("SELECT * FROM tracking WHERE slt_tracking_trackid = '$track' ORDER BY slt_tracking_time DESC LIMIT 0, 125");
          $get_links = mysql_query("SELECT * FROM links WHERE slt_link_userid = '$userid'");
          $get_link = mysql_fetch_assoc($get_links);
          $get_tracking_amount = mysql_num_rows($get_tracking);
            echo '<div id="piechart" style="width: 300px; height: 200px;"></div><br>';
            echo '<div style="display:none;" id="columnchart_values" style="width: 400px; height: 100px;"></div>';
            echo '<table class="table"><thead><tr><th>Link</th><th>Tracking Link</th><th style="white-space:nowrap;">Unique Visitors</th></tr></thead>
                  <tbody><tr><td style="font-style:italic;">'.$get_link["slt_link_baseurl"].'</td>';
            echo '<td style="font-style:italic;">'.$get_link["slt_link_url"].'</td>';
            echo '<td style="white-space:nowrap;">'.$get_tracking_amount.'</td></tr></tbody></table><br><br>';

          echo '<div id="listview">
                Showing 125 Newest visitors';
          while($row = mysql_fetch_assoc($get_tracking)) {
            echo '<div class="well" style="text-align:left;">';
            echo '<p><b>IP Address: </b>'.$row["slt_tracking_ipaddr"].' <a class="btn btn-warning btn-xs" target="_blank" href="http://ip-api.com/#'.$row["slt_tracking_ipaddr"].'">Lookup <i style="font-size: 10px;" class="fa fa-external-link" aria-hidden="true"></i></a></p>';
          if($row["slt_tracking_useragent"] == '') { 
            echo '<p style="color:#a52424;"><b>Unresolved useragent.</b></p>';
          } else {
            echo '<p><b>Useragent: </b>'.substr($row["slt_tracking_useragent"],0, 200).'</p>';
          }
          if($row["slt_tracking_referral"] == '') {
            echo '<p style="color:#a52424;"><b>Possibly a Direct Hit</b></p>';
          } else {
            echo '<p><b>Referral:</b> '.substr($row["slt_tracking_referral"],0, 50).' <a class="btn btn-default btn-xs" target="_blank" href="'.$row["slt_tracking_referral"].'">Visit</a> <a class="btn btn-default btn-xs" target="_blank" href="https://whois.domaintools.com/'.$row["slt_tracking_referral"].'">Whois</a></p>';            
          }
            echo '<p><b>Vsisit Time: </b>'.$row["slt_tracking_time"].'</p>';
            echo '</div>';
        }
        echo '</div>';
         echo '<div style="display:none;" id="tableview"> Showing 125 Newest visitors';
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
function barview() {
   $("#piechart").slideUp("mypanel.php #piechart");
   $("#bchart").hide("mypanel.php #bchart");
   $("#pchart").show("mypanel.php #pchart");
   $("#columnchart_values").slideDown("mypanel.php #columnchart_values");
}
function cakeview() {
   $("#columnchart_values").slideUp("mypanel.php #columnchart_values");
   $("#pchart").hide("mypanel.php #pchart");
   $("#bchart").show("mypanel.php #bchart");
   $("#piechart").slideDown("mypanel.php #piechart");
}
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