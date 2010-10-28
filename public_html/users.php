<?PHP

$x_IN_FILE = 1;
include('functions.php');
ini_set("max_execution_time","0");
ini_set("memory_limit","-1");

htmlheader('Users');


$data = file('ref.txt');

foreach ($data as $k=>$v) {
	$temp = explode('|',$v,2);
	
	$url = $temp[1];
	if (strlen($url) > 1) {
		$info = parse_url($url);
		$host = $info['host'];
		$host = strtolower($host);
		
		$host = str_replace('http://','',$host);
		$host = str_replace('/','',$host);
		$host = str_replace('www.','',$host);
		
		$urls[$host][$url]++;
	}
}

foreach ($urls as $k=>$v) {
	arsort($v);
	echo '<b>'.$k.'</b>';
	$x = 0;
	echo '<ul>';
	foreach ($v as $k2=>$v2) {
		$x++;
		if ($x < 5) {
			echo '<li style="margin-left:15px;"><a href="'.$k2.'">'.$k2.'</a> <small>('.$v2.')</small></li>';
		}
	}
	echo '</ul><br /><br />';
}


htmlfooter();


?>