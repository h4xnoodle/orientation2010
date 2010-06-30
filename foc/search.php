<?php 
session_start();

include "functions.php";
include_once "header.php";

if($_SESSION['foc'] == "true") {

if($_POST['searchthings']) {
	$results = searchNames($_POST['search']);

	if(!$results)
		echo "No results for that!";
	else {
		echo "<table class=\"search\">";
		echo "<tr style=\"background-color:#ddd;\"><td>ID</td><td>FIRST NAME</td><td>LAST NAME</td><td>PREFERRED NAME</td><td>UWNAME</td></tr>";
		foreach($results as $result) {
			$row = ($i % 2 == 0) ? "even" : "odd";
			echo "<tr class=\"".$row."\"><td><a href=\"info.php?app=".$result['lid']."\">".$result['lid']."</a></td><td>".$result['fname']."</td><td>".$result['lname']."</td><td>".$result['pname']."</td><td>".$result['uwname']."</td></tr>\n";
			$i++;
		}
		echo "</table>";
	}
}
} //foc session
mysql_close();
include "footer.php";
?>
