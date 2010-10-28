<?PHP

if (empty($_POST['nick']) || empty($_POST['email']) || empty($_POST['message'])) {
        Header ("Location: http://openstreetmap.org.ph/contact.php?got=anerror");                 //go to wherever the list is located
        ob_end_flush();
        exit;
}

if (!isSet($_POST['nick'])) {
        Header ("Location: http://openstreetmap.org.ph/contact.php?got=anerror");                 //go to wherever the list is located
        ob_end_flush();
        exit;
}
if (!isSet($_POST['email'])) {
        Header ("Location: http://openstreetmap.org.ph/contact.php?got=anerror");                 //go to wherever the list is located
        ob_end_flush();
        exit;
}
if (!isSet($_POST['message'])) {
        Header ("Location: http://openstreetmap.org.ph/contact.php?got=anerror");                 //go to wherever the list is located
        ob_end_flush();
        exit;
}

$realIP = getIP();
$realIP = long2ip($realIP);

$message = "
------------------------------------------

Name: $_POST[nick]
Email: $_POST[email]
";


$_POST['message'] = stripslashes($_POST[message]);

$message .= "

Message: $_POST[message]

IP: $realIP

------------------------------------------";

//We need to make sure this is not used to spam.
$message = str_replace('bcc:','',$message);
$x = substr_count($message,'@');
if ($x > 2)
    die("Shoo");
$find = 'This is a multi-part message in MIME format';
$pos = strpos($message, $find);
if ($pos === false) {
} else {
    die("Sorry, you cannot input MIME format in the email.");
}

$pos = strpos($message,'[/url]');
if ($pos === false) {
} else {
        //it was found
        die("no no");
}
$pos = strpos($message,'[url]');
if ($pos === false) {
} else {
        //it was found
        die("no no");
}


$x = substr_count($message,'http://');
if ($x > 4)
	die('You cannot have more than 4 links in your message');


$headers = "From: $_POST[nick] <$_POST[email]>" . "\r\n" . "Reply-To: $_POST[email]" . "\r\n" . 'X-Mailer: PHP/' . phpversion();
mail("ahmed@loadedweb.com","Open Street Map PH",$message,$headers);



//We must also notify user that we have recieved their email
$message = "Hello $_POST[nick],
    
Thank you for contacting us. We have received your email, and if a reply is required, we will reply as soon as possible.

-OpenStreetMap PH";

mail("$_POST[nick]","Message Received by Open Street Map PH",$message,$noreply);


Header ("Location: http://openstreetmap.org.ph/contact.php?got=it");                //go to wherever the list is located
ob_end_flush();

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