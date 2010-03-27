<?php
session_start();

include_once("header.php");

if($_SESSION['foc'] == "true") {

	echo "<p>This is the admin section for the 2010 FOC.</p>";
	echo "<p>Let me know if there are any issues! - Rebecca</p>";	

} else {
	echo "<p>Not logged in.</p>";
	echo "<p>Return to <a href='index.php'>index</a>";
}
include_once("footer.php");
?>
