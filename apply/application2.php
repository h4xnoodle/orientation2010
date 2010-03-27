<?php session_start(); ?>
<html>
<head>
<title>Math Orientation 2010 - Leader Application Form</title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>

<?php 

include("functions.php");

$MANUAL = true;

if($_SERVER['QUERY_STRING'] == "done") {
	echo "<h1 style=\"text-align:center;margin:200px 0 0 0;\">Thank you!</h1>";
	echo "<p style=\"text-align:center;\">Thanks for your application. You will hear back from us soon! Keep checking your email for important updates.</p>";
$_SESSION = array();
session_destroy();
exit();
}

echo "<h1>Leader Application";

// This is crappy - I know
switch($_SERVER['QUERY_STRING']) {
	case 'leader_app': echo "Positions"; break;
	case 'questions': echo "Personality Questions"; break;
	default: echo "Contact Information";
	}
?></h1>

<p>Your browser needs to accept a cookie in order to traverse the pages correctly.</p>
<p>The application form is split into 3 pages. The first page is general contact information, second page is your preferred positions for orientation 2010, and the third page contains the personality questions. Most fields are required when filling out the form.</p>

<p>At the moment, there is no save function. If you leave the page, only the last part you completed will be written to the database. Restarting the process again will remove your previous application.</p> <!-- not really, but this can be done. It adds it again atm -->

<!--<p>If you happen to fill out the application form again, it will <em>overwrite</em> your previous application with the new information.</p>-->

<hr />

<?php if($_SESSION['error'] == true){ 
	echo "<p style=\"color:red;font-weight:bold;\">Please make sure all fields are filled in as required.</p>";
	$_SESSION['error'] = false;
	}
	?>

<form method="post" action="processapp.php">

<?php 
switch($_SERVER['QUERY_STRING']) {
	
// Rankings
case 'leader_app': ?>

<input type="hidden" value="second" name="page" />
<?php $_SESSION['page'] = "second"; ?>
<div id="crazy">
<div id="left">
<?php

// Array of positions from the db
if($MANUAL) {
	$lpositions = array(
		0=>array('pid'=>1, 'position'=>'pinktie', 'position_name'=>"Pink tie"),
		1=>array('pid'=>2, 'position'=>'blacktie', 'position_name'=>"Black tie"));
	$cpositions = array();	
} else {
	$lpositions = getLeaderPositions();
	$cpositions = getCoordPositions();
}

echo "<p>Rate your preference of leadership positions from 0 to 1, 0 being the most desired. <b>Choose one for each rank. You may not receive your desired position if you rank it more than once. </b></p>";

$count = count($lpositions);
for($i=0; $i < $count; $i++) {
	echo $i." <select name=\"app[leader_".$i."]\">";
	foreach($lpositions as $p)
		echo "<option value=".$p['pid'].">".$p['position_name']."</option>";
	echo "</select><br />";
}

if(!$MANUAL) {
echo "<p>In the event that you are chosen to be interviewed for a co-ordinator position, please rate your preference on those positions below in the same manner as the above rating.</p>";

$count = count($cpositions);
for($i=0; $i < $count; $i++) {
	echo $i." <select name=\"app[co_".$i."]\">";
	foreach($cpositions as $p)
		echo "<option value=".$p['cid'].">".$p['position_name']."</option>";
	echo "</select><br />";
}
}
?>

<p><input type="submit" id="page" name="submit" value="Next Page" />
</div>
<div id="right">
<p><b>Pink Tie</b><br />
Pink Ties get to work closely with first year students, acting as a leader to the first years on each of the orientation week teams. Each team will have 6-8 Pink Ties, who are responsible for leading first years to events, acting as role models for first years, and promoting positive feelings throughout the week.</p>

<!--<p><b>Head Leader</b><br />
A Head Leader is essentially a leader of both the Pink Ties and first years on a team.  Responsibility and quick problem solving are important characteristics of a Head Leader as Pink Ties report to them.  Leader experience is preferred for this role but not required.</p>-->

<p><b>Black Tie</b><br />
The backbone of the entire week. Black Ties help set-up, run and take-down Math events during O-week. They also help run cross-campus events.</p>

<!--<p><b>Tie Guard</b><br />
Responsible for the well-being of the pink tie as well as all mobile materials that are required throughout the week. They are a communication hub for all events that involve the Faculty of Math. Works closely with FOC and Teamsters.</p>

<p><b>Teamsters</b><br />
Requirement: G license and 21 years of age or older
Responsible for Water and Material transportation on campus. Works closely with FOC and Tie Guard.</p>

<p><b>Coordinator</b><br />
Coordinators get to work closely with the FOC, and get to take ownership of a specific function in the planning of the week. Coordinator duties usually take place before orientation week, and coordinators are encouraged to apply to be a Pink Tie, Black Tie, Head Leader, Teamster, or Tie Guard during the week. If you are applying to be a coordinator, select your preferred coordinator position from the accompanying list.</p>

<p><b>Academic External Coordinator</b><br />
The Academic External Coordinator will be representing Math on a cross-campus committee to plan academic activities for students in all faculties. These activities will include JumpStart, and university welcome events.</p>

<p><b>Academic Internal Coordinator</b><br />
Responsible for the coordination of Academic Sessions, and the introduction of the Dean. This includes scheduling, communication with the Deans Office, and working closely with the Academic External Co-ordinator.</p>

<p><b>Activities Coordinator</b><br />
Responsible for the coordination of Central Registration, team building activities, and social programming.</p>

<p><b>Ask Me/Shuttle</b></br >
The Ask Me/Shuttle Coordinator will be working on a cross-campus committee responsible for the Ask Me booths on campus, and the Shuttle service during the week. Their duties will include leader recruitment and retention, and scheduling.</p>

<p><b>Earn Your Tie Coordinators</b><br />
The EYT Coordinator works during the winter and spring terms (mainly spring) to conceptualize and plan events for EYT. Communicate with Black Ties before the event (during the week) and teach them how to best run the mini events. </p>

<p><b>Food</b><br />
The Food Coordinator will look into planning menus for O-week events, both for leaders and first years. They will get a chance to work with food vendors, and represent Math Orientation on a cross-campus Food committee.</p>

<p><b>Move In</b></br />
The Move In Coordinator will be working with other Move In Coordinators from across the faculties to orchestrate and plan on-campus move in days at the beginning of orientation week. Duties will include selecting section leaders, traffic flow, and other logistics of the move in days. This position would be great for someone with previous residence orientation week experience, though anyone may apply.</p>

<p><b>Orientation Kit Coordinator</b><br />
The Orientation Kit Coordinator will be responsible for sorting all contents of the orientation kits and working with leaders and Black Ties to assemble these kits.</p>

<p><b>Scavenger Hunt</b><br />
The Scavenger Hunt Coordinator will be responsible for the planning of the Scavenger Hunt at the end of the week. Duties will include planning events, working with Black Ties at each event, and miscellaneous duties on the day of the event.</p>

<p><b>Volunteer Coordinator</b><br />
Responsible for communication and information management of all math faculty leaders.
Also responsible for the coordination of the Leader Retreat Weekend and the Leader Send-off Party.</p>

<p><b>Waterloo Park Coordinator</b><br />
The Waterloo Park Coordinator will facilitate the activities and games occurring at Waterloo Park.  Responsibilities will include organizing the set up which will be carried out by the Black Ties and overseeing the events as they take place.</p>

<p><b>Photography Coordinator</b><br />
The photography coordinator is responsible for taking pictures throughout the week and assisting with the coordination of the aerial photo.</p>-->
</div>
</div>
<?php break;

// Personality Questions
case 'questions': ?>

<input type="hidden" name="page" id="page" value="third" />
<?php $_SESSION['page'] = "third"; ?>

<?php 
$questions = array("q1"=>"List any previous leadership experience you have had (previous leadership experience is not required to apply).", 
		"q2"=>"List 3 words to describe yourself. Then, pick one and give an example of how it describes you.", 
		"q3"=>"Why do you want to be a Math Orientation Leader?",
		"q4"=>"If you could change one thing about Orientation Week, what would it be?",
		"q5"=>"Give an example of a time you had a conflict with a peer. Explain the situation, how you responded, and how the conflict was resolved.",
		"q6"=>"If you overheard some Orientation Leaders speaking negatively of Orientation Week to first year students, what would you do?",
		"q7"=>"If you could be any monopoly piece, which would you be and why?");

$data = $_SESSION['app'];
foreach($questions as $field=>$label)
	echo "<p><label for=\"".$field."\" class=\"q\">".$label."</label><br /><textarea name=\"app[".$field."]\" id=\"".$field."\">".$data[$field]."</textarea></p>";

?>

<p><input type="submit" name="submit" value="Finish" /></p>
<?php $_SESSION['page'] = "first"; ?>

<?php
break;
default: ?>

<input type="hidden" value="first" name="page" />

<?php $names = array(
	"uwid"=>"UW ID (202xxxx etc)*",
	"uwname"=>"UW Username*",
	"fname"=>"First Name*",
	"lname"=>"Last Name*",
	"pname"=>"Preferred Name*",
	"email"=>"Valid E-mail address*",
	"phone"=>"Phone number*",
	"faculty"=>"Faculty*",
	"program"=>"Program*"
	);
	
$addresses = array("addressw"=>"Current Address*", "addressp"=>"Address in Spring 2010*");

$data = $_SESSION['app'];

foreach($names as $field=>$label) 
	echo "<p><label for=\"".$field."\">".$label."</label><input type=\"text\" name=\"app[".$field."]\" id=\"".$field."\" value=\"".$data[$field]."\" /></p>";
foreach($addresses as $field=>$label) 
	echo "<p><label for=\"".$field."\">".$label."</label><textarea class=\"a\" name=\"app[".$field."]\" id=\"".$field."\">".$data[$field]."</textarea></p>";

?>

<p><label for="faid">Are you first-aid trained?*</label> <input type="radio" name="app[faid]" id="faid" value="1" /> yes  <input type="radio" name="app[faid]" id="faid" value="0" checked /> no</p>

<p><input type="submit" name="submit" value="Next Page" /></p>

<?php
}
?>
</form>
</body>
</html>
