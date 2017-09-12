Tested with PHP (v5.4) and MySQL (v5.5)
if you're running a newer version of PHP <5.4 then this link tracker will not work on your server.
or you will have to change to MySQLi or PDO and you will end up updating the whole code.

You can either use the web installer inside "installer" folder to install it.
or you can manually do it.

Web Installer will:

	+Setup/Create MySQL tables.
	+Setup/Create Configuration File. (you might have to check the app path)

it will do everything required to run this.

if you have any questions or trouble about this then please email me at
projects@marcosraudkett.com
https://marcosraudkett.com/#join

don't forget to signup to my updates, I will probably be updating this script sometime soon,
so when you're signed up you will receive a direct download link to your email.

---------------------------
in order for the installer to work it has to be inside the app folder not outside! -> app/installer <-
and if you're placing linktracker inside a subfolder then you must edit class/config and insert it manually later.


Current Features:
	+Create/Delete Links
	+Analytics/Statistics (Pie Chart, Bar Chart + Map Charts)
	+IP Logged only once. (unique visitors)
	+Some BOTS blocked.
	+Detect traffic source: direct, organic, social (charts)
	+Tweet, Send & Share buttons.
	+Table + List view.
	+Easy Interface.
	+Track info: IP Address, Country, Region, Zip Code, Latitude, Longitude, Referral Page, Useragent, Visit Time...
	+Location data provided by ip-api.com (Country, City, Region, Zip, Lat, Lon).
	+Bookmark Widget (drag and drop to bookmark and later just hit shorten and it will shorten the page you are on).

Working on:
	+Heatmap Analytics.
	+Mouse Movement Analytics.
	+Shorten & Track Google Chrome Extension.
	+Better BOT blocking & both total & unique visitors.
	+Make all functions work with AJAX and JavaScript.
	+Admin Panel speed.



Other:

You can easily change the "?src=longmd5hash" into "/md5hash" in .htaccess with this code:

	RewriteRule ^home?$ index.php.php?src=$1 [L]
	RewriteCond %{REQUEST_FILENAME} !-f
	RewriteCond %{REQUEST_FILENAME} !-d
	RewriteRule ^(.*) index.php?src=$1 [L]
	
So you don't need the "?src=" part

and also if you wish to make the md5 hash smaller in length just change: 
	$hash = md5( rand( 0, 1000 ) . rand( 0, 1000 ) . rand( 0, 1000 ) . rand( 0, 1000 ) );
into something like this:
	$hash = substr(md5( rand( 0, 1000 ) . rand( 0, 1000 ) . rand( 0, 1000 ) . rand( 0, 1000 ) ),0, 7);
That will decrease the length to 7 characters --------------------------------------------------------^^

Check out http://whx.io/ <- all the same features.
