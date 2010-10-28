<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Description" content="The most update to date and accurate street map of <?=($widget?$widget:'the Philippines');?>. Community collaboration to the max, map your area today!">
<meta name="Keywords" content="philippines,map,openstreetmap,enthropia,filipino,filipinos,supported,dagupan,angeles,baguio,boracay,davao,manila,bacolod,cebu,cotabato,danao,editor,iloilo,laoag,lucena,makati,malaybalay,mapping,martires,naga,olongapo,ormoc,pablo,san,surigao,tacloban,tagaytay,tagbilaran,tanauan,trece,urdaneta,cities,community,island,osm">
<link rel="shortcut icon" href="http://openstreetmap.org.ph/favicon.ico" type="image/x-icon" />
<title>Open Street Map Philippines - Mapping the Philippines</title>
<link href="styles.css" rel="stylesheet" type="text/css" />
<script src="/includes/js/prototype.js" type="text/javascript"></script>
<script src="/includes/js/effects.js" type="text/javascript"></script>
<script src="/includes/js/controls.js" type="text/javascript"></script>
<style type="text/css"><!--
div#update {
      position:absolute;
      width:250px;
      background-color:white;
      color: black;
      border:1px solid #888;
      margin:0px;
      padding:0px;
      z-index:10000000;
}
div#update ul {
      list-style-type:none;
      margin:0px;
      padding:0px;
}
div#update ul li.selected { background-color: #ffb;}
div#update ul li {
      list-style-type:none;
      display:block;
      margin:0;
      padding:2px;
      height:22px;
      cursor:pointer;
}
--></style>
</head>

<body>

<div id="Container">

	<div id="Header">
    	<div class="logo"><a href="http://openstreetmap.org.ph"><img src="images/logo.png" alt="OpenStreetMap Philippines - Filipino Map" /></a></div>
    	<h1>Welcome to OpenStreetMap Philippines, where we encourage all fellow Filipinos to contribute to the OpenStreetMap Project.</h1>
        <h2>This website serves as an advocacy site so that we can all work together to create a free open-source map for the entire Philippines. Join the effort.</h2>
    </div><!-- Content -->

  <div id="Content">    
   	  <?PHP if ($_GET['place'] == 'notfound') { echo '<center><b style="color: red; font-size: 14px;">That Location was Not Found</b></center><br />'; } ?>
		<div class="box1">
    
    <p>See a <a href="/map/">map of the Philippines</a><br />
     	<br /></p>
		  
		  <form name="form1" method="get" action="visit_place.php" id="Search">
          <input type="text" id="_search" class="search" name="visit" value="Enter a Location to Find" onfocus="this.value = (this.value=='Enter a Location to Find')? '' : this.value;" />
		        <div id="update" style="display: none; position:absolute;"></div>
				<script type="text/javascript">
          			new Ajax.Autocompleter('_search','update','/remote.php', { tokens: ',', indicator: 'indicator', 
					updateElement: function(e) {
						if (e.title) {
							$('_search').value = e.title;
							$('Search').submit();
						}
						return false;
          			} } 
          			);
				</script>
          <input type="image" class="button" src="images/form-button.png" /><br /><span id="indicator" style="color:#000; display:none;">Looking up...</span>
    </form>

		  
		</div>
		<div class="box2">
        
          <p>Love mapping? Get involved asap!</p>
          <br />
          <p>Choose the user friendly online editor or download a desktop editor for power users.<br /><br />
          <a href="http://wiki.openstreetmap.org/index.php/Getting_Involved">Get started</a> adding to the OSM Project.</p>
		</div>
        
		<div class="box3">
        
          <p>OpenStreetMap is more than just a map - it is a homegrown community.</p><br />
          <p>Find out more on how we work and help each other out. Visit our <a href="http://wiki.openstreetmap.org/index.php/WikiProject_Philippines">wiki site</a> or check out our <a href="/blog/">blog</a>, <a href="http://www.facebook.com/OSMPH">facebook</a>, and <a href="http://lists.openstreetmap.org/listinfo/talk-ph">mailing list</a>.</p>
		</div>

  </div><!-- End Content -->

<script type="text/javascript">
<!--
function toggleLink(id) {
	var html='';
	switch(id) {
		case 2:
			html = '&lt;a href="http://openstreetmap.org.ph/" title="Open Street Map Philippines"&gt;&lt;img src="http://openstreetmap.org.ph/button1.gif" style="height:15px;width:88px;" alt="Open Street Map Philippines"&gt;&lt;/a&gt;';
			break;
		case 3:
			html = '&lt;a href="http://openstreetmap.org.ph/" title="Open Street Map Philippines"&gt;&lt;img src="http://openstreetmap.org.ph/button2.gif" style="height:15px;width:88px;" alt="Open Street Map Philippines"&gt;&lt;/a&gt;';
			break;
		case 4:
			html = '&lt;a href="http://openstreetmap.org.ph/" title="Open Street Map Philippines"&gt;&lt;img src="http://openstreetmap.org.ph/button3.gif" style="height:15px;width:88px;" alt="Open Street Map Philippines"&gt;&lt;/a&gt;';
			break;
		}
	document.getElementById('xample_code').innerHTML = html;
}
//-->
</script>


<div><br style="clear: both;"/><br style="clear: both;"/><br style="clear: both;"/>

<?PHP
$x_IN_FILE = 1;
include('functions.php');
$sql_query = "SELECT * FROM `$table` WHERE `osmdesc` = 'City (Large)'";
$results = mysql_query($sql_query);
while ($row = mysql_fetch_assoc($results)) { $cities[] = $row['place']; }
/*
$cities[] = 'Cotabato City';
$cities[] = 'Davao City';
$cities[] = 'Urdaneta City';
$cities[] = 'Baguio City';
$cities[] = 'Lipa';
$cities[] = 'Tanauan';
$cities[] = 'Surigao City';
$cities[] = 'Dagupan City';
$cities[] = 'Tarlac City';
$cities[] = 'Laoag City';
$cities[] = 'Trece Martires';
$cities[] = 'Olongapo';
$cities[] = 'Angeles City';
$cities[] = 'Cebu City';
$cities[] = 'Legaspi';
$cities[] = 'San Pablo';
$cities[] = 'Lucena City';
$cities[] = 'Danao City';
$cities[] = 'Naga';
$cities[] = 'Iloilo City';
$cities[] = 'Cagayan De Oro';
$cities[] = 'Bacolod City';
$cities[] = 'Ormoc';
$cities[] = 'Tagbilaran';
$cities[] = 'Malaybalay';
$cities[] = 'Tagaytay';
$cities[] = 'Puerto Princesa';
$cities[] = 'Tacloban';
$cities[] = 'General Santos City';
*/


?>

<table width="100%"><tr><td valign="top">
<h2 style="color:#4C4D4D">Link to OpenStreetMap.org.ph</h2><br style="clear: both;"/>
<table cellpadding="20">
<tr>
<td valign="top">
	<a href="" onclick="toggleLink(2); return false;""><img src="/button1.gif" style="width:88px;height:15px;border:0"></a><br /><br />
	<a href="" onclick="toggleLink(3); return false;""><img src="/button2.gif" style="width:88px;height:15px;border:0"></a><br /><br />
	<a href="" onclick="toggleLink(4); return false;""><img src="/button3.gif" style="width:88px;height:15px;border:0"></a><br /><br />
</td><td width="20">&nbsp;</td><td valign="top">
	<textarea id="xample_code" readonly="readonly" onClick="this.focus();this.select()" style="width:500px; height: 70px;"></textarea><br /><br />
	Click on any of the images on the left to get the HTML needed
</td>
</tr></table>

<script type="text/javascript">
<!--
//Startup
toggleLink(2);
//-->
</script>
</td><td valign="top" width="170">
<?PHP
echo '<h2 style="color:#4C4D4D">Major Cities</h2><br style="clear: both;"/>';
echo '<ul style="margin-left:15px;">';
echo '<li><a href="/map/manila">Manila Map</a></li>';
echo '<li><a href="http://www.boracay.com.ph/map/">Boracay Map</a></li>';
srand(time());
for ($i = 1; $i < 6; $i++) {
	$x = count($cities)-1;
	$random = (rand()%$x);
	$p = urlencode(strtolower($cities[$random]));
	if ($p != '')
		echo '<li><a href="/map/'.$p.'">'.$cities[$random].'</a></li>';
	unset($cities[$random]);
}
echo '<li><a href="/viewall.php">More Philippine Maps</a></li>';
echo '</ul>';
?>
</td></tr></table>

</div>

	<div id="Footer">
	
	<div style="float:right;"><a href="http://www.use.com.ph/" title="Use.com.ph - Listing only Philippines Sites"><img style="border:none;" src="http://www.use.com.ph/img_1.gif" alt="Use.com.ph - Listing only Philippines Sites" /></a></div>
	
    &copy; 2008-<?PHP echo date("Y"); ?> OpenStreetMap.org.ph  | <a href="/contact.php">Contact Us</a><br />
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
