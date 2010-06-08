<?php

// Suggestion box form processing

// FEATURES
//	- Cookie to time submissions (no repeated entries in a short time)
//	- Math captcha - ensure a submission is by a human or a smart script
//	- Read/Write from XML file

session_start();
setcookie('o_suggestionbox',true,time()+60*60);
$xmlfile = "suggestions.xml";

// Check that file exists and is writable
if(!file_exists($xmlfile) || !is_writable($xmlfile)) {
	$fp = fopen($xmlfile,'a') or die("Cannot create ".$xmlfile." in ". $_SERVER['DOCUMENT_ROOT']);
	if(!$fp) {
		mail('h4xnoodle@gmail.com', 'Oweek site fail', 'Couldnt create XML file on server');
		exit("Cannot create ".$xmlfile);
	}
	fwrite($fp,"<?xml version=\"1.0\"?>\n<ideas>\n</ideas>");
}
			
// Reset the cookie and set session error message
function errReset($msg) {
	$_SESSION['o_sug'] = $msg;
	setcookie('o_suggestionbox',false);
}

// Process suggestion submission
if($_POST['submit']) {
	// Check that correct answer was supplied
	if($_POST['ans'] != $_POST['anschk']) {
		errReset("You ain't no mathie! Correctly answer the addition question.");
	// Check the 'recently suggested' cookie
	} elseif ($_COOKIE['o_suggestionbox']) {
		errReset("Please try not to submit more than one suggestion every minute. :)");
	// Check that the suggestion is between 0 and 200 chars in length
	} elseif ($_POST['idea'] == "" || strlen($_POST['idea'])>200) {
		errReset("Please enter a suggestion that is greater than 0 but less than 200 characters :)");
	} else {
		$xml = new DOMDocument('1.0');
		$xml->load($xmlfile);
		$root = $xml->documentElement;
		$new = $xml->createElement('idea', $_POST['idea']);
		$new->setAttribute('time',date('Y-m-d H:i:s'));
		$new->setAttribute('fave',false);
		$root->appendChild($new);
		unset($_POST);
		if($xml->save($xmlfile)) {
			$_SESSION['o_sug'] = "Suggestion added!";	
		} else {
			mail('h4xnoodle@gmail.com','Suggestion box','Suggestion-adding horrible failed!');
			errReset("Suggestion failed to add :(");
		}
	}
	header("Location: ../main.php");
}
?>