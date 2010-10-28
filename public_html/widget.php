<?PHP

ob_start();
$x_IN_FILE = 1;
include('functions.php');

$place = quote_smart($_GET['visit']);

if ($_GET['custom'] == 1) {
	$row['lat'] = (float)$_GET['lat'];
	$row['lng'] = (float)$_GET['lon'];
	$zoom = (int)$_GET['z']-1;
	$row['place'] = 'All of Philipppines';
} else {
	if ($place != 'all') {
		$sql_query = "SELECT * FROM `$table` WHERE place='$place'";
		$results = mysql_query($sql_query);
		
		if (mysql_num_rows($results) == 0) {
			Header("Location: $url?place=notfound");
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
}

//map.getZoom()

htmlheader('Widgetize '.$row['place']);
$p = urlencode(strtolower($row['place']));

?>
<script type="text/javascript">
<!--

var width = 400;
var height = 300;
var lat = <?PHP echo $row['lat']; ?>;
var lng = <?PHP echo $row['lng']; ?>;
var zoom = <?PHP echo $zoom; ?>;

function updateExample() {
	
	width = document.getElementById('width').value;
	height = document.getElementById('height').value;
	zoom = map.getZoom();
	
	lat = (map.getCenter().lat());
	lng = (map.getCenter().lng());

	var code = '&lt;iframe width="'+width+'" height="'+height+'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://openstreetmap.org.ph/widget-view/'+lat+'/'+lng+'/'+zoom+'/'+width+'/'+height+'/" style="border: 1px solid black"&gt;View the &lt;a href="http://openstreetmap.org.ph/map/<?PHP echo $p; ?>"&gt;Map of <?PHP echo $row['place'];?>&lt;/a&gt; or visit &lt;a href="http://openstreetmap.org.ph/"&gt;Philippines Open Street Map&lt;/a&gt;&lt;/iframe&gt;';
	var code2 = code.replace('&lt;','<');
	var code2 = code2.replace('&gt;','>');
	
	//document.getElementById('xample').innerHTML = code2;
	document.getElementById('xample_html').innerHTML = code;	
	document.getElementById('map').style.height=height+'px';
	document.getElementById('map').style.width=width+'px';
}

//-->
</script>
<table>
	<tr><td valign="top"><h2>Modify Size</h2><br />
		<table>
		<tr>
			<td><strong>Height:</strong></td>
			<td><input type="text" style="width: 50px" id="height" value="300" onblur="updateExample();"> (pixels)</td>
		</tr>
		<tr><td colspan="2">&nbsp;</td></tr>
		<tr>
			<td><strong>Width:</strong></td>
	
			<td><input type="text" style="width: 50px" id="width" value="400" onblur="updateExample();"> (pixels)</td>
		</tr>
		</table>
	</td>
	<td width="50">&nbsp;</td>
	<td valign="top">
	<h2>Copy Paste HTML</h2><br />
	<textarea id="xample_html" readonly="readonly" onClick="this.focus();this.select()" rows="6" cols="90" style="width:650px; height: 70px;"></textarea>
	</td></tr>
</table>


<br />
<h2>Looks Like</h2><br />
<span id="xample"></span>

<div id="map" style="border:1px solid black; width:400px; height:300px; margin:0;"></div>

<br />



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
	var copyrightCollection = new GCopyrightCollection('');
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

//Now refresh the copy-paste code.
updateExample();

  var listener = GEvent.addListener(
    map, "moveend", function() {
      updateExample();
  });


    //]]>
    </script>


<?PHP

htmlfooter();

?>