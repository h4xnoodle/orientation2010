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
	if(mysql_num_rows($result)) {
		$row = mysql_fetch_assoc($result);
		return $row['displayname'];
	} else {
		return "Invalid, false, DNE, etc.";
	}
}

function getTeamProfiles($teamRef) {
	$get_leaders = "SELECT * FROM leader_profiles JOIN leaders ON leader_profiles.lid=leaders.id WHERE leaders.team=(SELECT tid FROM teams WHERE refname='".$teamRef."') ORDER BY lpos DESC,lname ASC";
	$result = mysql_query($get_leaders);
	if(mysql_num_rows($result)) {
	while($row = mysql_fetch_assoc($result))
		$profiles[] = $row;
	return $profiles;
	} else {
		return false;
	}
}

function showAllTeamsList($type="") {
	$query = "SELECT refname,displayname FROM teams";
	$query .= ($type != "") ? " WHERE type='".$type."'" : "" ;
	$result = mysql_query($query);
	if($result) {
		while($row = mysql_fetch_assoc($result)) {
			echo "<li><a href='teams.php?".$row['refname']."' title='".$row['displayname']."'>".$row['displayname']."</a></li>";
		}
	} else {
		echo "<li>No teams to show.</li>";
	}
}

// LOL
function isHeadLeader($positionNumber) {
	return ($positionNumber == 2) ? true : false;
}

function displayLogo($teamref) {
	if(file_exists("imgs/team_logos/".$teamref.".png")) {
		echo "<center><img src=\"imgs/team_logos/".$teamref.".png\" title='".$teamref."' /></center>";
	}
}

if($_SERVER['QUERY_STRING'] == "gym_leaders") {
	echo "<h1>Gym Leaders (Black ties)</h1>";
	displayLogo($_SERVER['QUERY_STRING']);
	echo "<p>Select a city!</p>";
	echo "<ul class='allteams'>";
	showAllTeamsList($options="blacktie");
	echo "</ul>";
} elseif($_SERVER['QUERY_STRING'] == "missingno") {
	echo "<h1>Team: ".getTeamDisplay($_SERVER['QUERY_STRING'])." (Software Engineering)</h1>";
	displayLogo($_SERVER['QUERY_STRING']);
	echo "<p>The software engineer profiles coming soon!</p>";
} elseif($_SERVER['QUERY_STRING']) {
	echo "<h1>Team: ".getTeamDisplay($_SERVER['QUERY_STRING'])."</h1>";
	displayLogo($_SERVER['QUERY_STRING']);
	$profiles = getTeamProfiles($_SERVER['QUERY_STRING']);
	$fields = array('nickname'=>"People call me",'termprog'=>"My term/program",'hometown'=>"I'm from",'fave_atk'=>"My fave Pokemon attack is",'fave_series'=>"My fave Pokemon series is",'loveuw'=>"What I love about UW",'advice'=>"My advice to first-years");
	if($profiles) {
		foreach($profiles as $p) {
			echo "<div class='profile'>";
			echo "<h2>".$p['pname']." ".$p['lname'];
			echo (isHeadLeader($p['lpos'])) ? " <span>- Head Leader</span></h2>" : "</h2>"; 
			if($p['nickname'] != "" && $p['loveuw'] != "" && $p['advice'] != "") {
				foreach($fields as $field=>$display) {
					echo "<p><b>".$display.": </b>";
					echo ($p[$field] != "") ? $p[$field] : "N/A" ;
					echo "</p>";
				}
			} else {
				echo "<p>I haven't filled out my profile yet!</p>";
			}
			echo "</div>";
		}
	} else {
		echo "<p>This team has no members/no profiles completed!</p>";
	}

} else {
	// List all teams
	echo "<h1>All Teams</h1>";
	echo "<ul class='allteams'>";
	showAllTeamsList();
	echo "</ul>";
}

include "footer.php";
?>


