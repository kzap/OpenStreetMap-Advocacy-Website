<?PHP
header ("content-type: text/xml");

$x_IN_FILE = 1;
include('functions.php');


echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<urlset

      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"

      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"

      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9

            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

<url><loc>http://openstreetmap.org.ph/map/</loc></url>
<url><loc>http://openstreetmap.org.ph/contact.php</loc></url>
<url><loc>http://openstreetmap.org.ph/widget/</loc></url>


<?PHP

$sql_query = "SELECT `place` FROM `$table` WHERE `osmdesc` LIKE 'city%'";
$results = mysql_query($sql_query);
while ($row = mysql_fetch_assoc($results)) {
	echo '<url><loc>http://openstreetmap.org.ph/map/'.urlencode(str_replace(' ','+',strtolower($row['place']))).'</loc></url>'."\n";
	echo '<url><loc>http://openstreetmap.org.ph/widget/'.urlencode(str_replace(' ','+',strtolower($row['place']))).'</loc></url>'."\n";
}

$sql_query = "SELECT `place` FROM `$table` WHERE `osmdesc` NOT LIKE 'city%'";
$results = mysql_query($sql_query);
while ($row = mysql_fetch_assoc($results)) {
	echo '<url><loc>http://openstreetmap.org.ph/map/'.urlencode(str_replace(' ','+',strtolower($row['place']))).'</loc></url>'."\n";
	echo '<url><loc>http://openstreetmap.org.ph/widget/'.urlencode(str_replace(' ','+',strtolower($row['place']))).'</loc></url>'."\n";
}

echo "\n</urlset>";
