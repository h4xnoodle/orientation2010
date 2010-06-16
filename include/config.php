<?php 
global $names;
mysql_connect('localhost','orient2010','V1ct0ri@.CB');
mysql_select_db('orientation2010');

function getTeams($types=array('leader','other')) {
	$query = "SELECT * FROM teams type WHERE";
	foreach($types as $t) {
		$query .= " type='".$t."' OR";
	}
	$query = substr($query,0,-3);
	$query .= " ORDER BY type";
	$result = mysql_query($query);
	if($result) {
		while($t = mysql_fetch_assoc($result))
			$teams[] = $t;
	} else {
		exit("No teams?");
	}
	return $teams;
}

$names = array(
	'main'=>"Welcome!", 
	'faq'=>"Frequently Asked Questions",
	'events'=>"Events",
	'cheers'=>"Cheers",
	'pictures'=>"Pictures",
	'pinktie'=>"The Pink Tie Story",
	'sponsors'=>"Sponsors",
	'contact'=>"Contact Us"
	);
$showteams = false;
if(!$showteams) {
	$teams = array(
		"???????",
		"?????",
		"??????",
		"????????",
		"??????",
		"????????",
		"?????",
		"?????????",
	"???????",
	"???????",
	"??????",
	"??????",
	"???????",
	"???????",
	"??????",
	"??????????", // SE team
	"Elite Four",
	"FOC",
	"Team Rocket",
	"Gym Leaders"
	);
} else {
	$moo = getTeams();
	foreach($moo as $team)
		$teams[] = $team['displayname'];
}

// Init db connection
 ?>
