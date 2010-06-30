<?php

include "include/config.php";
include "header.php";

// Could just search $teams array...
function getTeamDisplay($ref) {
	if(is_numeric($ref))
		$query = "SELECT displayname FROM teams WHERE tid='".$ref."'";
	else
		$query = "SELECT displayname FROM teams WHERE refname='".$ref."'";
	$result = mysql_query($query);
	if($result) {
		$row = mysql_fetch_assoc($result);
		return $row['displayname'];
	} else {
		return "NO TEAM";
	}
}

function showAllTeamsList($options="") {
	$query = "SELECT refname,displayname FROM teams ORDER BY type";
	$result = mysql_query($query);
	if($result) {
		while($row = mysql_fetch_assoc($result)) {
			echo "<li><a href='teams.php?".$row['refname']."' title='".$row['displayname']."'>".$row['displayname']."</a></li>";
		}
	} else {
		echo "<li>No teams to show.</li>";
	}
}

if($_SERVER['QUERY_STRING']) {
	echo "<h1>Team: ".getTeamDisplay($_SERVER['QUERY_STRING'])."</h1>";

	echo "<p>Stay tuned for you leaders' profiles!</p>";

} else {
	// List all teams
	echo "<h1>All Teams</h1>";
	echo "<ul class='allteams'>";
	showAllTeamsList();
	echo "</ul>";
}

include "footer.php";
?>


