<?PHP

$x_IN_FILE = 1;
include('functions.php');
htmlheader('Contact Us');

if ($_GET['got'] == 'it') {
	
	echo '<p>Thank you - your message has been received. You should receive a reply within three business days.</p>';
	
} else {
	
	if ($_GET['got'] == 'anerror') {
		echo '<blockquote><p>You <b>must</b> fill in all fields.</p></blockquote>';
	}
	
?>
<p>Please fill out the following form.</p>
<form action="/contact-form.php" method="post" name="Submit">

<table cellspacing="5">

<tr><td>Name: </td>

<td><input type="text" size="30" value="" name="nick" /></td></tr>

<tr><td>Email:</td>
<td><input type="text" size="30" value="" name="email" /></td></tr>

<tr><td valign="top">Message:</td><td>
<textarea name="message" rows="8" cols="40"></textarea></td></tr>

<tr>
<td></td>
<td><input type="submit" value="Send Message &raquo;" /></td></tr>

</table></form>
<?PHP } 

htmlfooter();


?>