<?PHP

$x_IN_FILE = 1;
include('functions.php');

$place = quote_smart($_GET['visit']);

$sql_query = "SELECT * FROM `$table` WHERE place='$place'";
$results = mysql_query($sql_query);
$row = mysql_fetch_assoc($results);


//14.624389  - 14.5925 = 0.031889
//14.624389 - 14.60846 =  0.015929
//120.978706 - 121.0293 = 0.050594
//120.95341 - 120.978706 = 0.025296
//$latdiff = 0.015929;
//$lngdiff = 0.025296;

?>
<script type="text/javascript">
<!--

var width = 400;
var height = 300;
var title = '<?PHP echo $place; ?>';
var lat = <?PHP echo $row['lat']; ?>;
var lng = <?PHP echo $row['lng']; ?>;

var latdiff = width / 16801.0752688;
var lngdiff = height / 21972.502982;
lat1 = lat - latdiff;
lat2 = lat + latdiff;
lng1 = lng - lngdiff;
lng2 = lng + lngdiff;

function updateExample() {
	
	width = document.getElementById('width').value;
	height = document.getElementById('height').value;

	var latdiff = width / 16801.0752688;
	var lngdiff = height / 21972.502982;
	lat1 = lat - latdiff;
	lat2 = lat + latdiff;
	lng1 = lng - lngdiff;
	lng2 = lng + lngdiff;
	
	var url = 'http://www.mapabsas.com/map.php?address=Uruguay+229&width='+width+'&height='+height+'&lang=en';
	var url = 'http://www.openstreetmap.org/export/embed.html?bbox='+lng1+','+lat1+','+lng2+','+lat2+'&layer=mapnik';
	var code = '&lt;iframe width="'+width+'" height="'+height+'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://www.openstreetmap.org/export/embed.html?bbox='+lng1+','+lat1+','+lng2+','+lat2+'&layer=mapnik" style="border: 1px solid black"&gt;Visit &lt;a href="http://openstreetmap.org.ph/"&gt;Philippines Open Street Map&lt;/a&gt;&lt;/iframe&gt;';
	var code2 = code.replace('&lt;','<');
	var code2 = code2.replace('&gt;','>');
	
	document.getElementById('xample').innerHTML = code2;
	document.getElementById('xample_html').innerHTML = code;
	
	var temp = lng1+'|'+lat1+'|'+lng2+'|'+lat2;
	document.getElementById('debug').innerHTML = temp;
	
}

//-->
</script>
<table>
	<tr>
		<td><strong>Height:</strong></td>
		<td><input type="text" style="width: 100px" id="height" value="300" onblur="updateExample();"> (pixels)</td>
	</tr>
	<tr>
		<td><strong>Width:</strong></td>

		<td><input type="text" style="width: 100px" id="width" value="400" onblur="updateExample();"> (pixels)</td>
	</tr>
</table>


<table>
<tr>
<td valign="top" width="275">
<h2>Copy Paste HTML</h2>
<textarea id="xample_html" readonly="readonly" onClick="this.focus();this.select()" rows="6" cols="90" style="width:650px; height: 100px;"></textarea>
</td>
</tr><tr>
<td valign="top">
<h2>Looks Like</h2>
<span id="xample"></span>
</td>
</tr></table>

<textarea id="debug" readonly="readonly" onClick="this.focus();this.select()" rows="6" cols="90" style="width:650px; height: 100px;"></textarea>

<br />
<a href="http://openstreetmap.org.ph/" style="font-size: 14px;">&laquo; OpenStreetmap.org.ph</a>


<script type="text/javascript">
<!--
updateExample();
//-->
</script>


<?PHP


?>
120.96505257142859|14.600580999999977|120.99235942857142|14.648197000000025