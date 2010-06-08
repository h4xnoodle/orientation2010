<?php
session_start();
include "functions.php";
include "header.php";
echo "<h1>Suggestion Box Admin</h1>";
echo "<p>Here you can 'fave', 'unfave', and delete entries from the suggestion box.</p>";

// TODO: Delete, fave, unfave; style
if($_POST['delete']) {
	$gimme = $_POST['del'];
	echo "<p>".count($gimme)." entries would have been deleted if this was implemented!";
} else if($_POST['fave']) {
	$gimme = $_POST['del'];
	echo "<p>".count($gimme)." entries would have been faved if this was implemented!";
}
$suggestions = getSuggestions();
if($suggestions) {
	echo "<form action='".$_SERVER['PHP_SELF']."' method='post' onsubmit='return confirm(\"YOU SURE?\")' />\n";
	foreach($suggestions as $s) {
		echo $s['fave'] ? "<p class='fave'>" : "<p>";
		// TODO: Uuuughhhhhh searching by the timestamp... :(
		echo "<input type='checkbox' name='del[".$s['time']."]' value='".$s['idea']."' /> ".$s['idea']." <em>at</em> ".$s['time']."</p>\n";
	}
	echo "<input type='submit' name='fave' value='Fave!' /> <input type='submit' name='delete' value='Delete?' />";
	echo "</form>\n";
} else {
	echo "No suggestions entered!";
}
include "footer.php";
?>