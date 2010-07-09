<?php
session_start();
include "functions.php";
include "header.php";

if($_SESSION['foc'] == true) {
echo "<h1>Suggestion Box Admin</h1>";
echo "<p>Here you can 'fave', and delete entries from the suggestion box. Newest and bolded at the top.</p><hr />";

// TODO: Delete, fave, unfave; style
if($_POST['delete']) {
	$gimme = $_POST['del'];
	$success = true;
	foreach($gimme as $k=>$v) {
		$result = mysql_query("DELETE FROM sbox WHERE id='".$k."'");
		if(!$result) {
			$success = false;
			break;
		}
	}
	if($success)
		echo "<p>".count($gimme)." entries deleted forever.";
	else
		echo "<p>There was an error. Contact Bex -- this should work without a problem!<br /><br />Email this to her:<br />".mysql_error()."</p>";
} else if($_POST['fave']) {
	$gimme = $_POST['del'];
	$success = true;
	foreach($gimme as $k=>$v) {
		$result = mysql_query("UPDATE sbox SET fave=1 WHERE id='".$k."'");
		if(!$result) {
			$success = false;
			break;
		}
	}
	if($success)
		echo "<p>".count($gimme)." entries marked as faves (appear at top and bolded).";
	else
		echo "<p>There was an error. Contact Bex -- this should work without a problem!<br /><br />Email this to her:<br />".mysql_error()."</p>";
}
$suggestions = getSuggestions();
if($suggestions) {
	echo "<form action='".$_SERVER['PHP_SELF']."' method='post' onsubmit='return confirm(\"Are you sure??\")'>\n";
	foreach($suggestions as $s) {
		echo $s['fave'] ? "<p class='fave'>" : "<p>";
		echo "<input type='checkbox' name='del[".$s['id']."]' value='".$s['suggestion']."' /> ".$s['suggestion']." <em style='font-size:80%;color:#999;'>at ".$s['time']."</em></p>\n";
	}
	echo "<input type='submit' name='fave' value='Fave!' /> <input type='submit' name='delete' value='Delete?' />";
	echo "</form>\n";
} else {
	echo "No suggestions entered!";
}
} //session
else {
	echo "Please <a href='index.php'>login</a>";
}
include "footer.php";
?>
