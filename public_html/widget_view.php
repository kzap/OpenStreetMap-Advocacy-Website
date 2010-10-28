<?PHP

$filename = 'ref.txt';
$ts = time();
$handle = fopen($filename,'a');
fwrite($handle,"$ts|$_SERVER[HTTP_REFERER]\n");
fclose($handle);

$lat = (float)$_GET['lat'];
$lon = (float)$_GET['lon'];
$zoom = (int)$_GET['z'];
$width = (int)$_GET['w'];
$height = (int)$_GET['h'];
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" style="padding:0px:margin:0px;">
<head>
<title>Map of <?PHP echo $lat.','.$lon;?></title>
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAz_gyLz9E6fWZuYhbc0ZfWhRIppCAOTxyEpuL2Yb69ImKt0UnThRRhcPsvuQv36PQ7vRZyTAw8d3Y2Q" type="text/javascript"></script>

</head>

<body onunload="GUnload();" style="margin:0;padding:0;">


<div id="map" style="border:0; width:<?PHP echo $width; ?>px; height:<?PHP echo $height;?>px; margin:0;"></div>

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
	map.setCenter(new GLatLng(<?PHP echo $lat; ?>,<?PHP echo $lon; ?>), <?PHP echo $zoom; ?>, osmmap);
    }

    //]]>
    </script>

</body>
</html>
