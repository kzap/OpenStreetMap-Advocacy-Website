<?PHP

$x_IN_FILE = 1;
include('functions.php');

$mysqlerror=1;
$data = file('data.txt');


$sql_query = " TRUNCATE TABLE `$table`  ";
queryDatabase($sql_query);

//1	10.9	119.25	Anchorage Island	osm-id 302034523		place:island	10/4/2008	23:30:49
//5904,7.21019,124.24505,"Cotabato City","osm-id 244475001",,"City (Large)",01/28/09,03:43:42 AM
//  0      1        2           3                 4         5           6         7
unset($data[0]);
foreach ($data as $k=>$v) {
	$temp = explode(',',$v);
	$lat = $temp[1];
	$lng = $temp[2];
	
	$temp[3] = substr($temp[3],1,strlen($temp[3])-2);
	$temp[4] = substr($temp[4],1,strlen($temp[4])-2);
	$temp[6] = substr($temp[6],1,strlen($temp[6])-2);
	$temp[7] .= ' '.$temp[8];
	
	$place = quote_smart($temp[3]);
	
	$osm = str_replace('osm-id ','',$temp[4]);
	$osm = (int)$osm;
	
	$temp[6] = str_replace('place:','',$temp[6]);
	$temp[6] = str_replace('_',' ',$temp[6]);
	$temp[6] = ucwords($temp[6]);
	
	$osm_desc = quote_smart($temp[6]);
	$updated = quote_smart($temp[7]);
	
	$sql_query = "INSERT INTO `$table` SET place='$place', lat=$lat, lng=$lng, osmid=$osm, osmdesc='$osm_desc', updated='$updated'";
	queryDatabase($sql_query);
	echo '.';
}