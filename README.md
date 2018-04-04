# Simple Link Tracker

## Update November 15, 2017
Updated from MySQL to MySQLi which means
it should also run on newer PHP versions now.
<5.4 and MySQL aswell <5.5

# Works on
Tested with PHP (v5.4) and MySQL (v5.5)
November 15, 2017 updated from MySQL to MySQLi.

# Installation (Web installer)
You can either use the web installer inside "installer" folder to install it.
or you can manually do it.

Web Installer will:

	+Setup/Create MySQL tables.
	+Setup/Create Configuration File. (you might have to check the app path)

it will do everything required to run this.

Installer will be located at:
http://mysite.com/app-path/installer/ If installer does not work then try the [manual installation](https://github.com/marcosraudkett/Link-Tracker/blob/master/README.md#installation-manual--without-installer)

---------------------------
> in order for the installer to work it has to be inside the app folder not outside! -> app_folder/installer <-
> and if you're placing linktracker inside a subfolder then you must edit class/config and insert it manually later.

# Installation (manual / without installer)
> works with all MySQL versions!
1. Create 3 tables to MySQL (users, links, tracking): ([Database File](https://github.com/marcosraudkett/Link-Tracker/tree/master/linktracker/Installer/database))
 * "users" rows:
   * slt_link_id, type: int(11), **NOT NULL**, auto_increment (PRIMARY KEY)
   * slt_link_url, type: varchar(255), NULL
   * slt_link_baseurl, type: varchar(255), NULL
   * slt_link_userid, type: varchar(255), NULL
   * slt_link_trackingid, type: varchar(255), NULL
   * slt_link_total, type: varchar(255), NULL
   * slt_link_created, type: timestamp, **NOT NULL**, default: CURRENT_TIMESTAMP
 * "links" rows:
   * slt_tracking_id, type: int(11), **NOT NULL**, auto_increment (PRIMARY KEY)
   * slt_tracking_trackid, type: varchar(255), **NOT NULL**
   * slt_tracking_ipaddr, type: varchar(255), NULL
   * slt_tracking_country, type: varchar(255), NULL
   * slt_tracking_region, type: varchar(255), NULL
   * slt_tracking_city, type: varchar(255), NULL
   * slt_tracking_zip, type: varchar(255), NULL
   * slt_tracking_lat, type: varchar(255), NULL
   * slt_tracking_lon, type: varchar(255), NULL
   * slt_tracking_referral, type: varchar(255), NULL
   * slt_tracking_useragent, type: varchar(255), NULL
   * slt_tracking_time, type: timestamp, **NOT NULL**, default: CURRENT_TIMESTAMP
 * "tracking" rows:
   * slt_user_id, type: int(11), **NOT NULL**, auto_increment (PRIMARY KEY)
   * slt_user_email, type: varchar(255), **NOT NULL**
   * slt_user_password, type: varchar(255), **NOT NULL**
   * slt_user_created, type: timestamp, **NOT NULL**, default: CURRENT_TIMESTAMP
2. Update config.php file inside class folder "class/config.php"
 * set all mysql information (hostname, username, password & name)
 * set the "mylink" path to your full domain: http://mydomain.com/
 * set app path that comes right after the domain like: "linktracker/"
3. You're all set.

# Features
Current Features:
* Create/Delete Links
* Analytics/Statistics (Pie Chart, Bar Chart + Map Charts)
* IP Logged only once. (unique visitors)
* Some BOTS blocked.
* Detect traffic source with charts: 
  * direct
  * organic
  * social
* Social Buttons
  * Tweet
  * Facebook Send
  * Facebook Share
* Table + List view.
* Easy Interface.
* Track info: 
  * IP Address
  * Country
  * Region
  * Zip Code
  * Latitude
  * Longitude
  * Referral Page
  * Useragent
  * Visit Time
* Location data provided by ip-api.com 
  * Country
  * City
  * Region
  * Zip
  * Lat
  * Lon
* Bookmark Widget (drag and drop to bookmark and later just hit shorten and it will shorten the page you are on).

Working on:
* Heatmap Analytics.
* Better BOT blocking & both total & unique visitors.
* Make all functions work with AJAX and JavaScript.
* Speed up the Admin Panel.
* Password encrypted links.
* Grab Title + Description from target link (source). (You could modify my Gist: [Website Crawler](https://gist.github.com/marcosraudkett/fa3715752e550c2714279435217617d7) to work with Link Tracker)
* User can add a custom ending.
* Feature that requires user to enable GeoLocation in order to continue.



# Other

You can easily change the "**?src=longmd5hash**" into "**/md5hash**" in .htaccess with this code:

	RewriteRule ^home?$ index.php.php?src=$1 [L]
	RewriteCond %{REQUEST_FILENAME} !-f
	RewriteCond %{REQUEST_FILENAME} !-d
	RewriteRule ^(.*) index.php?src=$1 [L]
	
So you don't need the "**?src=**" part

> and also if you wish to make the md5 hash smaller in length just change: <br>
> $hash = md5( rand( 0, 1000 ) . rand( 0, 1000 ) . rand( 0, 1000 ) . rand( 0, 1000 ) ); <br>
> into something like this: <br>
> $hash = substr(md5( rand( 0, 1000 ) . rand( 0, 1000 ) . rand( 0, 1000 ) . rand( 0, 1000 ) ),0, 7); <br>
> That will decrease the length to 7 characters ---------------------------------------------^^

Check out http://whx.io/ <- all the same features.

if you have any questions or trouble about this then please email me at
projects@marcosraudkett.com
https://marcosraudkett.com/#join

don't forget to signup to my updates, I will probably be updating this script sometime soon,
so when you're signed up you will receive a direct download link to your email.
