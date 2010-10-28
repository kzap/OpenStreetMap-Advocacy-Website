<?php
$x_IN_FILE = 1;
ob_start();
include_once('functions.php');
ob_end_flush();

$cities = array();
$places = array();

if (trim(@$_REQUEST['visit']) != '') {
	$place = quote_smart($_REQUEST['visit']);
	$sql_query = "SELECT * FROM `$table` WHERE `place` LIKE '" . $place . "%' AND `osmdesc` LIKE 'City%' LIMIT 20";
	$result = mysql_query($sql_query);
	while ($row = mysql_fetch_array($result)) {
		$cities[$row['place']] = array('name' => $row['place'], 'type' => $row['osmdesc']);
	}
	
	$sql_query = "SELECT * FROM `$table` WHERE `place` LIKE '" . $place . "%' AND `osmdesc` NOT LIKE 'City%' LIMIT 20";
	$result = mysql_query($sql_query);
	while ($row = mysql_fetch_array($result)) {
		$places[$row['place']] = array('name' => $row['place'], 'type' => $row['osmdesc']);
	}
}

echo '<ul>';
if (count($cities) || count($places)) {
	$i = 0;
	if (count($cities)) {
		echo '<li><b>Cities:</b></li>';
		foreach($cities as $val) {
			$i++;
			if ($i <= 20) { echo '<li title="'.$val['name'].'" id="'.$val['type'].'">'.$val['name'].'</li>'; }
		}
	}
	if (count($places) && $i+1 <= 20) {
		echo '<li><b>Other Places:</b></li>';
		foreach($places as $val) {
			$i++;
			if ($i <= 20) { echo '<li title="'.$val['name'].'" id="'.$val['type'].'">'.$val['name'].'</li>'; }
		}
	}
}
echo '</ul>';
