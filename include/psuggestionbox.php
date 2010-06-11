<?php

// Suggestion box form processing

// FEATURES
//	- Cookie to time submissions (no repeated entries in a short time)
//	- Math captcha - ensure a submission is by a human or a smart script

session_start();
setcookie('o_suggestionbox',true,time()+60*60);

mysql_connect('localhost','orient2010','V1ct0ri@.CB');
mysql_select_db('orientation2010');

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
		$result = mysql_query("INSERT INTO sbox (suggestion) VALUES (\"".$_POST['idea']."\")");
		echo mysql_error();
		if($result) {
			$_SESSION['o_sug'] = "Suggestion added!";	
		} else {
			mail('h4xnoodle@gmail.com','Suggestion box','Suggestion-adding horribly failed!');
			errReset("Suggestion failed to add :(");
		}
	}
	header("Location: ../main.php");
}
?>
