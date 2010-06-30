<?php

session_start();
include "functions.php";
include "header.php";

function getNiceSize($uggysize) {
	switch($uggysize) {
		case 'w_XS':	$nice = "Women's XS"; break;
		case 'w_S':	$nice = "Women's S"; break;
		case 'w_M': $nice = "Women's M"; break;
		case 'w_L': $nice = "Women's L"; break;
		case 'w_XL':	$nice = "Women's XL"; break;
		case 'w_XXL':	$nice = "Women's XXL"; break;
		case 'w_3X':	$nice = "Women's 3X"; break;

		case 'm_XS': $nice = "Men's XS"; break;
		case 'm_S': $nice = "Men's S"; break;
		case 'm_M': $nice = "Men's M"; break;
		case 'm_L': $nice = "Men's L"; break;
		case 'm_XL': $nice = "Men's XL"; break;
		case 'm_XXL': $nice = "Men's XXL"; break;
		case 'm_3X': $nice = "Men's 3X"; break;
		case 'm_4X': $nice = "Men's 4X"; break;
		case 'm_5X': $nice = "Men's 5X"; break;
	}
	return $nice;
}

function getCounts() {
	$query = "SELECT COUNT(size_shirt) FROM leaders";
	return mysql_num_rows(mysql_query($query));
}

function displayAllSizing($sort="size_shirt") {
	$query = "SELECT fname,lname,size_shirt FROM leaders WHERE size_shirt != \"\" ORDER BY ".$sort." ASC";
	$result = mysql_query($query);
	if($result) {
		echo "<table style='width:80%;'>";
		echo "<tr><th style='text-align:left;background:#ccc;'>First Name</th><th style='text-align:left;background:#ccc;'>Last Name</th><th style='text-align:left;background:#ccc;'>Shirt Size</th></tr>";
		while($row = mysql_fetch_assoc($result)) {
			$size_shirt = getNiceSize($row['size_shirt']);
			echo "<tr style='margin:3px 0;'><td>".$row['fname']."</td><td>".$row['lname']."</td><td>".$size_shirt."</td></tr>\n";
		}
		echo "</table>";
	} else {
		echo "No size information.";
	}
}

if($_SESSION['foc'] == true) {
	echo "<h1>Misc. Tools</h1>";

	switch($_GET['tool']) {
		case 'sizing':
			echo "<h2>Sizing information</h2>";
			echo "<p><b>".getCounts()."</b> out of <b>".getNumLeaders()."</b> leaders have submitted sizes.</p>";
			echo "<p>Sort by: <a href='misctools.php?tool=sizing&sort=size_shirt'>shirt size</a> <a href='misctools.php?tool=sizing&sort=lname'>last name</a></p>";
			displayAllSizing("size_shirt");
			getCounts();
			break;

		case 'add_sponsor':
			echo "<h2>Add a sponsor</h2>";
			echo "<p>Coming soon!</p>";
			break;
		default:
			echo "<p>Choose one of the tools to the left or below:</p>";
			echo "<p><a href='misctools.php?tool=add_sponsor'>Add a sponsor</a>, <a href='misctools.php?tool=sizing'>View submitted sizing information</a></p>";
	}

} else {
	echo "Please <a href='index.php'>Login</a></p>";
}
include "footer.php";
?>
