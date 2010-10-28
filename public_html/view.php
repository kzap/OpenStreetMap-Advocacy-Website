<?PHP

ob_start();
$x_IN_FILE = 1;
include('functions.php');

$place = quote_smart($_GET['visit']);

if ($_GET['custom'] == 1) {
	$row['lat'] = (float)$_GET['lat'];
	$row['lng'] = (float)$_GET['lon'];
	$zoom = (int)$_GET['z'];
	$row['place'] = 'All of Philippines';
	htmlheader('Philippines Map','Philippines Map');
} else {
	if ($place != 'all') {
		$sql_query = "SELECT * FROM `$table` WHERE place='$place'";
		$results = mysql_query($sql_query);
		
		if (mysql_num_rows($results) == 0) {
			Header("Location: $url?q=".urlencode($place)."&place=notfound");
			exit;
		}
		$row = mysql_fetch_assoc($results);
		$zoom = 13;
	} else {
		$row['place'] = 'All of Philippines';
		$row['lat'] = 13;
		$row['lng'] = 123;
		$zoom = 6;
	}
	htmlheader('View Map of '.$row['place'],'View Map of '.$row['place'],$row['place']);
}

$width = 980;
$height = 550;

?>

<div style="float:right;" id="xlink"></div>
<?PHP if ($row['place'] != 'All of Philippines') { ?>
	<table cellpadding="5" cellspacing="3">
		<tr><td><b>Description:</b></td><td><?PHP echo $row['osmdesc']; ?></td></tr>
		<tr><td><b>Last Updated:</b></td><td><?PHP echo $row['updated']; ?></td></tr>
	</table>
<?PHP } ?>	
<br />

<div id="map" style="border:1px black solid; width:<?PHP echo $width; ?>px; height:<?PHP echo $height;?>px; margin:0;"></div>

<script type="text/javascript">
<!--
function updateLink() {
	zoom = map.getZoom();
	lat = (map.getCenter().lat());
	lng = (map.getCenter().lng());
	var linky = '<a href="http://openstreetmap.org.ph/map/c/'+lat+'/'+lng+'/'+zoom+'/">Link to this Map</a>';
	var linky = linky.replace('&lt;','<');
	var linky = linky.replace('&gt;','>');
	
	var widgetlinky = '<a href="http://openstreetmap.org.ph/widget/c/'+lat+'/'+lng+'/'+zoom+'/">Put on your Website</a>';
	var widgetlinky = widgetlinky.replace('&lt;','<');
	var widgetlinky = widgetlinky.replace('&gt;','>');
	
	document.getElementById('xlink').innerHTML = linky;	
	document.getElementById('widgetlink').innerHTML = widgetlinky;	
}

//-->
</script>


    <script type="text/javascript">
    //<![CDATA[
    
    if (GBrowserIsCompatible()) { 

      // A function to create the marker and set up the event window
      // Dont try to unroll this function. It has to be here for the function closure
      // Each instance of the function preserves the contends of a different instance
      // of the "marker" and "html" variables which will be needed later when the event triggers.    
    // Display the map, with some controls and set the initial location 
	var map = new GMap2(document.getElementById("map"));
	map.addControl(new GSmallMapControl());
	map.addControl(new GMapTypeControl());
//Custom function for fetchng tiles from OSM server
CustomGetTileUrl=function(a,b){
return 'http://a.tile.openstreetmap.org/'+b+'/'+a.x+'/'+a.y+'.png';
}
var copyright = new GCopyright(1,
                              new GLatLngBounds(new GLatLng(-90, -180), 
                                                new GLatLng(90, 180)),
                              0,
                              "<a href=\"http://www.openstreetmap.org/\" style=\"color:black;\">OpenStreetMap</a>");
	var copyrightCollection = new GCopyrightCollection('Data by ');
	copyrightCollection.addCopyright(copyright);
	var tilelayers = [new GTileLayer(copyrightCollection,1,17)];
	tilelayers[0].getTileUrl = CustomGetTileUrl;
	var osmmap = new GMapType(tilelayers, G_SATELLITE_MAP.getProjection(), 'Map');
	map.addMapType(osmmap);
	map.removeMapType(G_HYBRID_MAP);
	map.removeMapType(G_NORMAL_MAP);
	map.removeMapType(G_SATELLITE_MAP);
	map.addMapType(G_SATELLITE_MAP);	//easy way of making sure it is OSM / Satellite
	map.setCenter(new GLatLng(<?PHP echo $row['lat']; ?>,<?PHP echo $row['lng']; ?>), <?PHP echo $zoom; ?>, osmmap);
    }

  var listener = GEvent.addListener(
    map, "moveend", function() {
      updateLink();
  });



    //]]>
    </script>

</body>
</html>

<?PHP

htmlfooter();

?>