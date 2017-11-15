<?php
  /*Include MySQL Database Connection.*/
  require_once "class/require.php";
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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <?php
    $get_tracking_charts_query = "SELECT * FROM tracking WHERE slt_tracking_trackid = '$track' ORDER BY slt_tracking_time DESC";
    $get_tracking_charts = mysqli_query($conn, $get_tracking_charts_query);
  
    while($row = mysqli_fetch_assoc($get_tracking_charts)) {
      $tref = $row["slt_tracking_referral"];
    }
    $direct_query = "SELECT * FROM tracking 
      WHERE slt_tracking_trackid = '$track' 
      AND slt_tracking_referral = '' 
      ORDER BY slt_tracking_time DESC"; 
    $direct = mysqli_query($conn, $direct_query);
    $organic_query = "SELECT * FROM tracking
      WHERE slt_tracking_trackid = '$track' 
      AND slt_tracking_referral 
      LIKE '%google%'
      OR slt_tracking_trackid = '$track'
      AND slt_tracking_referral 
      LIKE '%yahoo%'
      OR slt_tracking_trackid = '$track'
      AND slt_tracking_referral 
      LIKE '%bing%'
      OR slt_tracking_trackid = '$track' 
      AND slt_tracking_referral 
      LIKE '%ask%'
      OR slt_tracking_trackid = '$track' 
      AND slt_tracking_referral 
      LIKE '%duckduckgo%'
      ORDER BY slt_tracking_time DESC"; 
    $organic = mysqli_query($conn, $organic_query);
    $social_query = "SELECT * FROM tracking 
      WHERE slt_tracking_trackid = '$track' 
      AND slt_tracking_referral 
      LIKE '%facebook%' 
      OR slt_tracking_trackid = '$track'
      AND slt_tracking_referral
      LIKE '%twitter%'
      OR slt_tracking_trackid = '$track'
      AND slt_tracking_referral
      LIKE '%instagram%'
      OR slt_tracking_trackid = '$track'
      AND slt_tracking_referral
      LIKE '%t.co%'
      OR slt_tracking_trackid = '$track'
      AND slt_tracking_referral
      LIKE '%fb.com%'
      ORDER BY slt_tracking_time DESC";
    $social = mysqli_query($conn, $social_query); 
    $direct_total = mysqli_num_rows($direct);
    $organic_total = mysqli_num_rows($organic);
    $social_total = mysqli_num_rows($social);
  
/*  FOR TESTING LOCALE
  $gets_locale = mysql_query("SELECT * FROM tracking WHERE slt_tracking_trackid = '$track' ORDER BY slt_tracking_time DESC");
  while($row = mysql_fetch_assoc($gets_locale)) {
  $ip = $row['slt_tracking_ipaddr']; 
  $country = $row['slt_tracking_country'];
  $locale = mysql_query("SELECT * FROM tracking WHERE slt_tracking_trackid = '$track' AND slt_tracking_country = '$country' ORDER BY slt_tracking_time DESC");
  $locale_total = mysql_num_rows($locale);
  $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
  if($query && $query['status'] == 'success') {
      echo '[\''.$query['country'].'\', \''.$locale_total.'\'],';
  } else {
    
  }
}  
*/
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
        ["Social", <?php echo $social_total ?>, "#005ecf"],
        ["Direct", <?php echo $direct_total ?>, "#bb0000"],
        ["Organic", <?php echo $organic_total ?>, "#f0ad4e"]
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
  <script type="text/javascript">
    
    google.charts.load('upcoming', {'packages':['geochart']});
    google.charts.setOnLoadCallback(drawRegionsMap);
      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable([
          ['Country', 'Popularity'],
<?php   
  $gets_locale_query = "SELECT * FROM tracking WHERE slt_tracking_trackid = '$track' ORDER BY slt_tracking_time DESC";
  $gets_locale = mysqli_query($conn, $gets_locale_query);
  while($row = mysqli_fetch_assoc($gets_locale)) {
  $ip = $row['slt_tracking_ipaddr']; 
  $country = $row['slt_tracking_country'];
  $locale_query = "SELECT * FROM tracking WHERE slt_tracking_trackid = '$track' AND slt_tracking_country = '$country' ORDER BY slt_tracking_time DESC";
  $locale = mysqli_query($conn, $locale_query);
    $locale_total = mysqli_num_rows($locale);
    
  $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
  if($query && $query['status'] == 'success') {
      echo '[\''.$query['country'].'\', \''.$locale_total.'\'],';
  } else {
    
  }
}
?>
        ]);
      //document.getElementById('mape').innerHTML = "<table id=\"GeoResults\"></table>";
         var options = {};
    var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));
    chart.draw(data, options);
  };
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
      <legend style="text-align:left;padding:3px;"><?php  if($track == '') { 
        echo 'Active Links'; 
        } else { 
          ?>Link Statistics<?php } ?> 
          <?php  if($track == '') { } else {?>
          <a class="btn btn-default btn-xs" onclick="tableview()" id="tbl" href="javascript:void(0);"><i class="fa fa-table" aria-hidden="true"></i> Table View</a>
          <a style="display:none;" class="btn btn-default btn-xs" onclick="listview()" id="liv" href="javascript:void(0);"><i class="fa fa-table" aria-hidden="true"></i> List View</a> 
          <?php }; ?><?php  if($track == '') { } else {?> 
          <a class="btn btn-default btn-xs" onclick="barview()" id="bchart" href="javascript:void(0);"><i class="fa fa-bar-chart" aria-hidden="true"></i> Bar Chart</a>
          <a style="display:none;" class="btn btn-default btn-xs" onclick="cakeview()" id="pchart" href="javascript:void(0);"><i class="fa fa-pie-chart" aria-hidden="true"></i> Pie Chart</a> <?php }; ?>
          <?php  if($track == '') { } else {?> 
          <a class="btn btn-default btn-xs" onclick="mapview()" id="smap" href="javascript:void(0);"><i class="fa fa-globe" aria-hidden="true"></i> Show Map</a>
          <a style="display:none;" class="btn btn-default btn-xs" onclick="hidemap()" id="hmap" href="javascript:void(0);"><i class="fa fa-globe" aria-hidden="true"></i> Hide Map</a> <?php }; ?>
          
          <?php  if($track == '') { } else {?> 
            <div style="float:right;margin-top:3px;margin-right: 3px;" class="fb-share-button" data-href="<?php echo $myhost; ?><?php echo $app_path; ?>/?src=<?php echo $track; ?>" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $myhost; ?><?php echo $app_path; ?>/?src=<?php echo $track; ?>&amp;src=sdkpreparse">Share</a></div>
            <div style="float:right;margin-top:3px;margin-right: 3px;" class="fb-send" data-href="<?php echo $myhost; ?><?php echo $app_path; ?>?src=<?php echo $track; ?>"></div>
            <iframe src="https://platform.twitter.com/widgets/tweet_button.html?size=2&amp;url=<?php echo $myhost; ?><?php echo $app_path; ?>/?src=<?php echo $track; ?>&amp;via=marcosraudkett&amp;text=Check this out!" data-size="default" width="100" height="48" title="Twitter Tweet Button" style="float:right;margin-bottom:-33px;border: 0; overflow: hidden;margin-right:-37px;margin-top:3px;"></iframe>
          <?php }; ?>
          </legend> 
      <?php 
         if($track == '') {
          include ("includes/links.php");
        } else {
          $get_tracking_query = "SELECT * FROM tracking WHERE slt_tracking_trackid = '$track' ORDER BY slt_tracking_time DESC LIMIT 0, 125";
          $get_tracking = mysqli_query($conn, $get_tracking_query);

          $get_tracking_table_query = "SELECT * FROM tracking WHERE slt_tracking_trackid = '$track' ORDER BY slt_tracking_time DESC LIMIT 0, 125";
          $get_tracking_table = mysqli_query($conn, $get_tracking_table_query);

          $get_links_query = "SELECT * FROM links WHERE slt_link_userid = '$userid' AND slt_link_trackingid = '$track'";
          $get_links = mysqli_query($conn, $get_links_query);

          $get_link = mysqli_fetch_assoc($get_links);
          $get_tracking_amount = mysqli_num_rows($get_tracking);
            echo '<div id="onmap" style="display:none;height:500px;"><div id="regions_div" style="display:hidden;width: 700px; height: 500px;"></div></div>';
            echo '<div id="piechart" style="width: 300px; height: 200px;"></div><br>';
            echo '<div style="display:none;" id="columnchart_values" style="width: 400px; height: 100px;"></div>';
            echo '<table class="table"><thead><tr><th>Link</th><th>Tracking Link</th><th style="white-space:nowrap;">Unique Visitors</th></tr></thead>
                  <tbody><tr><td style="font-style:italic;">'.$get_link["slt_link_baseurl"].'</td>';
            echo '<td style="font-style:italic;">'.$get_link["slt_link_url"].'</td>';
            echo '<td style="border-left:1px solid #dc3912;border-bottom:1px solid #dc3912;background:#dbffdb;text-align:center;white-space:nowrap;">'.$get_tracking_amount.'</td></tr></tbody></table><br><br>';
          echo '<div id="listview">
                Showing 125 Newest visitors | new -> old';
          while($row = mysqli_fetch_assoc($get_tracking)) {
          
            $query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
            echo '<table id="#GeoResults"></table><div class="well" style="text-align:left;">';
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
          echo '<table class="table table-striped table-bordered table-hover">';
          echo '<thead>';
          echo '<tr>
                  <th>IP Address</th>
                  <th>Referral</th>
                  <th>Visit Time</th>
                </tr>
                <tr>
                  <tbody>';
          while($rows = mysqli_fetch_assoc($get_tracking_table)) {
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
  <p style="display:inline;">Simple Link Tracker</p>&nbsp;<a class="btn btn-default" href="func/signout.php">Sign Out</a>
</footer>
<script type="text/javascript">
function mapview() {
   $("#onmap").show("#onmap");
   $("#smap").hide("mypanel.php #smap");
   $("#hmap").show("mypanel.php #hmap");
   $("#piechart").hide("mypanel.php #piechart");
   $("#columnchart_values").hide("mypanel.php #columnchart_values");
   drawRegionsMap();
   drawRegionsMap().load();
}
function hidemap() {
   $("#onmap").hide("#onmap");
   $("#piechart").show("mypanel.php #piechart");
   $("#hmap").hide("mypanel.php #hmap");
   $("#smap").show("mypanel.php #smap");
   drawRegionsMap();
}
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
$(document).ready(function() {
  $('#tbl').DataTable();
});
</script>
</center>
<!-- LOAD FB -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<!-- LOAD ANIM -->
<script src="http://mvrclabs.info/se/labcode/third/jQuery-2.1.4.min.js"></script>
<script src="http://mvrclabs.info/se/labcode/showhide.js"></script>
<!-- JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.12/js/dataTables.bootstrap.min.js"></script>
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
