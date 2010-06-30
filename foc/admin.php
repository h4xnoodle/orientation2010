<?php
session_start();

include_once("header.php");

if($_SESSION['foc'] == "true") {
?>
<h1>Changelog + Info</h1>
<p>Welcome to the FOC dashboard :)</p>
<p>Navigation is on the left now, instead of the top.</p>
<h2>Changelog File Output</h2>
<?php
	if(file_exists('../CHANGELOG')) {
		echo "<pre class='changelog'>";
		echo file_get_contents('../CHANGELOG');
		echo "</pre>";
	} else {
		echo "CHANGELOG file does not exist.";
	}
} else {
	echo "<p>Not logged in.</p>";
	echo "<p>Return to <a href='index.php'>index</a>";
}
include_once("footer.php");
?>
