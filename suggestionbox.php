<?php

// Suggestion box form processing

// FEATURES
//	- Cookie to time submissions (no repeated entries in a short time)
//	- Math captcha - ensure a submission is by a human or a smart script
//	- Read/Write from XML file

$s_one = rand(1,20);
$s_two = rand(5,31);
setcookie('lalala',true,time()+60);
if($_POST['submit']) {
	if($_POST['ans'] != $_POST['anschk']) {
		echo "You ain't no mathie!";
	//} elseif ($_COOKIE['suggestionbox']) {
	//	echo "Please try not to submit more than one suggestion every 5 minutes. :)";
	} else {
		if($_POST['idea'] == "" || strlen($_POST['idea'])>200)	
			echo "Please enter a suggestion that is greater than 0 but less than 200 characters :)";
		else {
			$xml = new DOMDocument('1.0');
			$xml->load('suggestions.xml');
			$root = $xml->documentElement;
			$new = $xml->createElement('idea', $_POST['idea']);
			$new->setAttribute('time',date('Y-m-d H:i:s'));
			$root->appendChild($new);
			unset($_POST);
			if($xml->save('suggestions.xml'))
				// Hmm.. must be done before any ouput
				//setcookie('suggestionbox',true,time()+60*60*5); // Expire in 5 mins
				echo "Suggestion added!";	
			else
				echo "Suggestion failed to add :(";
		}
	}
} else {
	// Using SimpleXML for quick reading -- put this in FOC section later
	if(file_exists('suggestions.xml'))
		$sxe = simplexml_load_file('suggestions.xml');
	else
		exit('Cannot load file');
	echo "Ideas so far:<br /><br />";
	foreach($sxe->children() as $idea)
		echo $idea."<br/ >";
}
?>
<html>
<head>
<style type="text/css">
	p {
		font-family:sans-serif;
	}
	form input {
		padding:2px;
	}
</style>
</head>
</body>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
	<input type="hidden" name="ans" value="<?php echo $s_one+$s_two; ?>" />
	<p>Suggestion:<br />
	<textarea name="idea"></textarea></p>
	<p><?php echo $s_one . " + ". $s_two; ?> is? <input type="text" style="width:40px;" name="anschk" /></p>
	<p><input type="submit" name="submit" value="Enter!" /></p>
</form>
</body>
</html>