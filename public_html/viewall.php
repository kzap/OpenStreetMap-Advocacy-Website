<?PHP

ob_start();
$x_IN_FILE = 1;
include('functions.php');
include('locations.array.php');

htmlheader('Maps of Philippine Provinces, Cities & Municipalities','Maps of Philippine Provinces, Cities & Municipalities');

$i = 0;
echo '<table width="100%"><tr>';
foreach($locations[0]['regions'] as $region) {
	if ($region['name'] == 'Metro Manila') {
		$i++;
		if ($i == 1 || ($i > 1 && ($i-1)%(count($locations[0]['regions'])/3) == 0)) { echo '<td valign="top" align="left">'; }
		echo '<h2 style="display: inline;">'.str_replace('ñ', '&ntilde;', $region['name']).'</h2>:<ul>';
		foreach($region['cities'] as $city) {
			$sql_query = "SELECT * FROM `$table` WHERE `place` = '" . mysql_escape_string($city['name']) . "' OR `place` = '".mysql_real_escape_string(str_replace(array('City of ',' City'), '', $city['name']).' City')."' LIMIT 1";
			$results = mysql_query($sql_query);
			$row = mysql_fetch_assoc($results);
			echo '<li>';
			if (mysql_num_rows($results)) { echo '<a href="/map/'.urlencode(str_replace(' ','+',strtolower($row['place']))).'">'; }
			else { echo '<a href="/map/'.urlencode(str_replace(' ','+',strtolower($city['name']))).'">'; }
			echo '<h3 style="display: inline; font-weight: normal;">'.str_replace('ñ', '&ntilde;', $city['name']).'</h3>';
			echo '</a>';
			echo '</li>';
		}
		echo '</ul><br />';
		if ($i > 1 && $i%(count($locations[0]['regions'])/3) == 0) { echo '</td>'; }
	}
}
foreach($locations[0]['regions'] as $region) {
	if ($region['name'] != 'Metro Manila') {
		$i++;
		if ($i > 1 && ($i-1)%(count($locations[0]['regions'])/3) == 0) { echo '<td valign="top" align="left">'; }
		echo '<h2 style="display: inline;">'.str_replace('ñ', '&ntilde;', $region['name']).'</h2>:<ul>';
		foreach($region['cities'] as $city) { 
			$sql_query = "SELECT * FROM `$table` WHERE `place` = '" . mysql_escape_string($city['name']) . "' OR `place` = '".mysql_real_escape_string(str_replace(array('City of ',' City'), '', $city['name']).' City')."' LIMIT 1";
			$results = mysql_query($sql_query);
			$row = mysql_fetch_assoc($results);
			echo '<li>';
			if (mysql_num_rows($results)) { echo '<a href="/map/'.urlencode(str_replace(' ','+',strtolower($row['place']))).'">'; }
			else { echo '<a href="/map/'.urlencode(str_replace(' ','+',strtolower($city['name']))).'">'; }
			echo '<h3 style="display: inline; font-weight: normal;">'.str_replace('ñ', '&ntilde;', $city['name']).'</h3>';
			echo '</a>';
			echo '</li>';
		}
		echo '</ul><br />';
		if ($i > 1 && $i%(count($locations[0]['regions'])/3) == 0) { echo '</td>'; }
	}
}
echo '</tr></table>';

htmlfooter();

?>