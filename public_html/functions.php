<?php

//Make sure it was called inside a file.
if ($x_IN_FILE != 1)
  exit;

$table = 'places';
$url = 'http://openstreetmap.org.ph/';

$mySQL_Address = '127.0.0.1';
$mySQL_User = "openstreet_user";                                       //Username to login to MySQL server
$mySQL_Password = "PBIY8g7byu#lvu";                                   //Password to login to MySQL server
$databaseName = "openstreet";                             //Name of database already created on MySQL server

//Connect to MySQL and database
$databaseConnection = mysql_connect($mySQL_Address,$mySQL_User,$mySQL_Password) or die ("Unable to connect to MySQL server.");
$db = mysql_select_db($databaseName) or die ("Unable to select requested database.");


$googlemapapi = 'ABQIAAAAz_gyLz9E6fWZuYhbc0ZfWhRIppCAOTxyEpuL2Yb69ImKt0UnThRRhcPsvuQv36PQ7vRZyTAw8d3Y2Q';







//Get rid of all magic quotes
if (get_magic_quotes_gpc())
{
	if (!empty($_GET))    { $_GET    = strip_magic_quotes($_GET);    }
	if (!empty($_POST))   { $_POST   = strip_magic_quotes($_POST);   }
	if (!empty($_COOKIE)) { $_COOKIE = strip_magic_quotes($_COOKIE); }
}




function getIP() {
	if (getenv('HTTP_CLIENT_IP')) {
	$ip = getenv('HTTP_CLIENT_IP');
	}
	elseif (getenv('HTTP_X_FORWARDED_FOR')) {
	$ip = getenv('HTTP_X_FORWARDED_FOR');
	}
	elseif (getenv('HTTP_X_FORWARDED')) {
	$ip = getenv('HTTP_X_FORWARDED');
	}
	elseif (getenv('HTTP_FORWARDED_FOR')) {
	$ip = getenv('HTTP_FORWARDED_FOR');
	}
	elseif (getenv('HTTP_FORWARDED')) {
	$ip = getenv('HTTP_FORWARDED');
	}
	else {
	$ip = $_SERVER['REMOTE_ADDR'];
	}
	
	$ip = ip2long($ip);
	
	return $ip;
}

// Quote variable to make safe
function quote_smart($value) {
	
	$value = trim($value);
	
   // Assumes Stripslashes - we utf-8 it
   return htmlspecialchars($value,ENT_QUOTES, 'UTF-8');

}

//Used to go from utf-8 ---> simple.
function quote_decode ($str) {
   $x = strtr($str, array_flip(get_html_translation_table(HTML_SPECIALCHARS, ENT_QUOTES)));
   return str_replace('&#039;',"'",$x);
}


//Does not allow the browser to cache anything
function noCache()
{
	header('P3P: CP="NOI ADM DEV PSAi COM NAV OUR OTRo STP IND DEM"');      //IE6 Cookies
	header("Expires: Sun 10 Feb 1983 05:00:00 GMT");                     // Date in the past
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");        // always modified
	header("Cache-Control: no-store, no-cache, must-revalidate");  // HTTP/1.1
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");                          // HTTP/1.0
}



//Quick code to print out the values and keys of an array
function printArray($arr,$arrayName="")
{
	
	if ($arrayName != "") {
		echo "<br /> PRINTING ARRAY --[$arrayName]: <br />";
	}
	else {
		echo '<br /> PRINTING ARRAY: <br />';
	}
		
	foreach($arr as $k => $v) {
	    echo '[\'' . $k . '\'] => .' . $v . '.<br />' . "\n";
	}

	if ($arrayName != "") {
		echo "END ARRAY --[$arrayName] <br />";
	}
	else {
		echo 'END ARRAY <br />';
	}
}

//Querys the database with a string - used to update databse [does NOT return values]
function queryDatabase($sql_query)
{
        global $mysqlerror;

        if (@mysql_query($sql_query)) {
                //Successfull - do not display anything
        }
        else {
			echo 'Error occured with the database.';
			if ($mysqlerror) {
				echo "<br><br>\n\n Query: $sql_query <br><br>";
				echo "\nError:".mysql_error();
				echo "\n\n";
			}
        }
}

function addSlashesArray($arr)
{

	foreach ($arr as $k => $v)
	{

		if (is_array($v)) {
			$arr[$k] = addSlashesArray($v);
		}
		else {
			$arr[$k] = addslashes($v);
		}
	}
	return $arr;
}


//This gets rid of the damn 'magic quotes'
function strip_magic_quotes($arr)
{
	foreach ($arr as $k => $v)
	{
		if (is_array($v)) {
			$arr[$k] = strip_magic_quotes($v);
		}
		else {
			$arr[$k] = stripslashes($v);
		}
	}
	return $arr;
}


function htmlheader($title, $h1='',$widget='',$meta='') {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
<meta name="Description" content="The most update to date and accurate street map of <?=($widget?$widget:'the Philippines');?>. Community collaboration to the max, map your area today!">
<meta name="Keywords" content="philippines,map,openstreetmap,enthropia,filipino,filipinos,supported,dagupan,angeles,baguio,boracay,davao,manila,bacolod,cebu,cotabato,danao,editor,iloilo,laoag,lucena,makati,malaybalay,mapping,martires,naga,olongapo,ormoc,pablo,san,surigao,tacloban,tagaytay,tagbilaran,tanauan,trece,urdaneta,cities,community,island,osm">
<link rel="shortcut icon" href="http://openstreetmap.org.ph/favicon.ico" type="image/x-icon" />
<title><?PHP echo $title; ?> - Open Street Map Philippines</title>
<link href="/styles.css" rel="stylesheet" type="text/css" />
<script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=ABQIAAAAz_gyLz9E6fWZuYhbc0ZfWhRIppCAOTxyEpuL2Yb69ImKt0UnThRRhcPsvuQv36PQ7vRZyTAw8d3Y2Q" type="text/javascript"></script>
</head>
<body onunload="GUnload()">

<div id="Container">

	<div id="Header">
    	<div class="logo"><a href="http://openstreetmap.org.ph"><img src="/images/logo.png" alt="OpenStreetMap Philippines - Filipino Map" /></a></div>
    	<h1>Welcome to OpenStreetMap Philippines, where we encourage all fellow Filipinos to contribute to the OpenStreetMap Project.</h1>
        <h2>This website serves as an advocacy site so that we can all work together to create a free open-source map for the entire Philippines. Join the effort.</h2>
    </div><!-- Content -->

  <div id="Content">
  <?PHP
  if ($h1 != '') {
  	echo '<h1>'.$h1;
  	if ($widget != '') {
  		$p = urlencode(strtolower($widget));
  		if ($p == 'all+of+philippines')
  			$p = '';
  		echo '<small> &nbsp; <span id="widgetlink"><a href="/widget/'.$p.'" rel="nofollow">Put on your Website</a></span></small>';
  	}
  	echo '</h1><br />';
  }
}


function htmlfooter() {
?>
</div>

	<div id="Footer">
	<div style="float:right;"><a href="http://www.use.com.ph/" title="Use.com.ph - Listing only Philippines Sites"><img style="border:none;" src="http://www.use.com.ph/img_1.gif" alt="Use.com.ph - Listing only Philippines Sites" /></a></div>
    &copy; 2008-<?PHP echo date("Y"); ?> OpenStreetMap.org.ph  |  <a href="/contact.php">Contact Us</a><br />
    Supported by <a href="http://www.enthropia.com.ph/">Enthropia Inc</a>
  </div><!--End Footer -->


</div><!-- #Container -->


<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-872660-7");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
</html>
<?PHP
}
?>