# Simple Link Tracker

# Works on
Tested with PHP (v5.4) and MySQL (v5.5)
You can demo this @ https://marcosraudkett.com/mvrclabs/linktracker/

demo account for this project:
- user: admin@slt.com
- pass: 123123

# Newer Versions
if you're running a newer version of PHP <5.4 then this link tracker will not work on your server.
or you will have to change to MySQLi or PDO and you will end up updating the whole code.
And if you're running on newer MySQL <5.5 then you will need to update NOT NULL fields to NULL


# Installation (installer)
You can either use the web installer inside "installer" folder to install it.
or you can manually do it.

Web Installer will:

	+Setup/Create MySQL tables.
	+Setup/Create Configuration File. (you might have to check the app path)

it will do everything required to run this.

Installer will be located at:
http://mysite.com/app-path/installer/ If installer does not work then try the [manual installation](https://github.com/marcosraudkett/Link-Tracker/blob/master/README.md#installation-manual--without-installer)

if you have any questions or trouble about this then please email me at
projects@marcosraudkett.com
https://marcosraudkett.com/#join

don't forget to signup to my updates, I will probably be updating this script sometime soon,
so when you're signed up you will receive a direct download link to your email.

---------------------------
> in order for the installer to work it has to be inside the app folder not outside! -> app_folder/installer <-
> and if you're placing linktracker inside a subfolder then you must edit class/config and insert it manually later.

# Installation (manual / without installer)

1. Create 3 tables to MySQL (users, links, tracking):
 * "users" rows:
   * slt_link_id, type: int(11), NOT NULL, auto_increment (PRIMARY KEY)
   * slt_link_url, type: varchar(255), NULL
   * slt_link_baseurl, type: varchar(255), NULL
   * slt_link_userid, type: varchar(255), NULL
   * slt_link_trackingid, type: varchar(255), NULL
   * slt_link_total, type: varchar(255), NULL
   * slt_link_created, type: timestamp, NOT NULL, default: CURRENT_TIMESTAMP
 * "links" rows:
   * slt_tracking_id, type: int(11), NOT NULL, auto_increment (PRIMARY KEY)
   * slt_tracking_trackid, type: varchar(255), NOT NULL
   * slt_tracking_ipaddr, type: varchar(255), NULL
   * slt_tracking_country, type: varchar(255), NULL
   * slt_tracking_region, type: varchar(255), NULL
   * slt_tracking_city, type: varchar(255), NULL
   * slt_tracking_zip, type: varchar(255), NULL
   * slt_tracking_lat, type: varchar(255), NULL
   * slt_tracking_lon, type: varchar(255), NULL
   * slt_tracking_referral, type: varchar(255), NULL
   * slt_tracking_useragent, type: varchar(255), NULL
   * slt_tracking_time, type: timestamp, NOT NULL, default: CURRENT_TIMESTAMP
 * "tracking" rows:
   * slt_user_id, type: int(11), NOT NULL, auto_increment (PRIMARY KEY)
   * slt_user_email, type: varchar(255), NOT NULL
   * slt_user_password, type: varchar(255), NOT NULL
   * slt_user_created, type: timestamp, NOT NULL, default: CURRENT_TIMESTAMP
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
* Mouse Movement Analytics.
* Shorten & Track Google Chrome Extension.
* Better BOT blocking & both total & unique visitors.
* Make all functions work with AJAX and JavaScript.
* Admin Panel speed.



# Other

You can easily change the "?src=longmd5hash" into "/md5hash" in .htaccess with this code:

	RewriteRule ^home?$ index.php.php?src=$1 [L]
	RewriteCond %{REQUEST_FILENAME} !-f
	RewriteCond %{REQUEST_FILENAME} !-d
	RewriteRule ^(.*) index.php?src=$1 [L]
	
So you don't need the "?src=" part

> and also if you wish to make the md5 hash smaller in length just change: <br>
> $hash = md5( rand( 0, 1000 ) . rand( 0, 1000 ) . rand( 0, 1000 ) . rand( 0, 1000 ) ); <br>
> into something like this: <br>
> $hash = substr(md5( rand( 0, 1000 ) . rand( 0, 1000 ) . rand( 0, 1000 ) . rand( 0, 1000 ) ),0, 7); <br>
> That will decrease the length to 7 characters ---------------------------------------------^^

Check out http://whx.io/ <- all the same features.
