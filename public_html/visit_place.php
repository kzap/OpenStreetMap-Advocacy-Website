<?PHP

$x_IN_FILE = 1;
include('functions.php');

$place = quote_smart($_GET['visit']);

$sql_query = "SELECT * FROM `$table` WHERE place LIKE '$place%' LIMIT 1";
$results = mysql_query($sql_query);

if (mysql_num_rows($results)) {
	$row = mysql_fetch_assoc($results);
	$p = urlencode(strtolower($row['place']));
	header("Location: http://openstreetmap.org.ph/map/$p?q=".urlencode($place));
} else {
	header("Location: $url?q=".urlencode($place)."&place=notfound");
}

?>