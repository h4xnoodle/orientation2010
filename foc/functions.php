<?php


function parseRankings($rankings) {
	$r = explode(':', $rankings);
	return $r;
}

function getLPositions() {
	$query = "SELECT * FROM leaderpositions";
	$result = mysql_query($query);
	while($position = mysql_fetch_assoc($result))
		$positions[] = array('id'=>$position['pid'],'position_name'=>$position['position_name']);
	return $positions;
}

function getCPositions() {
	$result = mysql_query("SELECT * FROM coordpositions");
	while($position = mysql_fetch_assoc($result)) 
		$positions[] = array('id'=>$position['cid'],'position_name'=>$position['position_name']);
	return $positions;
}

// Fix this
function outputRankPref($prefs, $possible) {
	foreach($prefs as $num=>$pref) {
		echo ($num == 0) ? "<li class=\"first\">" : "<li>";
		echo $num+1;
		foreach($possible as $pos){
			if($pos['id'] == $num+1)
				echo ". ".$pos['position_name']." </li>";
		}
	}
}

function searchNames($search) {
	$query = "SELECT * FROM constantinfo WHERE (fname LIKE \"$search\") OR (lname LIKE \"$search\") OR (uwname LIKE \"$search\") OR (pname LIKE \"$search\")";
	$result = mysql_query($query);
	if($result){
		while($row = mysql_fetch_assoc($result))
			$entries[] = $row;
		return $entries;
	}
	else
		return 0;
}

function hideApp($lid) {
	$query = "UPDATE appinfo SET hide=1 WHERE lid=$lid";
	return (mysql_query($query)) ? true : false;
}

function isHidden($lid) {
	$query = "SELECT * FROM appinfo WHERE lid=$lid";
	$result = mysql_query($query);
	if($result) {
		$row = mysql_fetch_assoc($result);
		return $row['hide'];
	} else {
		return false;
	}
}

function fullApp($lid) {
	(is_numeric($lid)) ? true : die("Error");
	$query = "SELECT * FROM constantinfo LEFT JOIN appinfo ON appinfo.lid = constantinfo.lid WHERE appinfo.lid=$lid";
	$result = mysql_query($query);
	if($result)
		$app = mysql_fetch_assoc($result);
	else
		$app = false;
	return $app;
}

function outQuestions($lid) {
	$query = "SELECT q1,q2,q3,q4,q5,q6,q7 FROM appinfo WHERE lid=$lid";
	$result = mysql_query($query);
	if($result)
		$ans = mysql_fetch_assoc($result);
	else 
		exit("No answers present");
	
	foreach($ans as $q=>$a){
		switch($q) {
			case 'q1': $question = "List any previous leadership experience."; break;
			case 'q2': $question = "List 3 words to describe yourself. Then, pick one and give an example of how it describes you."; break;
			case 'q3': $question = "Why do you want to be a Math Orientation Leader?"; break;
			case 'q4': $question = "If you could change one thing about Orientation Week, what would it be?"; break;
			case 'q5': $question = "Give an example of a time you had a conflict with a peer. Explain the situation, how you responded, and how the conflict was resolved."; break;
			case 'q6': $question = "If you overheard some Orientation Leaders speaking negatively of Orientation Week to first year students, what would you do?"; break;
			case 'q7': $question = "If you could be any monopoly piece, which would you be and why?"; break;
		}
		echo "<li><b>".$question."</b><br />".nl2br($a)."</li>";	
	}
}

function getCompleteApps() {
	$query = "SELECT * FROM appinfo WHERE q1!='' ORDER BY hide,lid";
	$result = mysql_query($query);

	if($result) {
		while($app = mysql_fetch_assoc($result))
			$apps[] = $app;
		return $apps;
	} else {
		return false;
	}
}

function getEmptyApps() {
	$query = "SELECT * FROM appinfo JOIN constantinfo ON constantinfo.lid=appinfo.lid WHERE appinfo.q1 IS NULL ORDER BY appinfo.lid";
	$result = mysql_query($query);
	if($result) {
		while($app = mysql_fetch_assoc($result))
			$apps[] = $app;
		return $apps;
	} else {
		return false;
	}
}

// Get suggestions from suggestions.xml and return an array
// []=>{time,idea}
function getSuggestions() {
	$query = "SELECT * FROM sbox ORDER BY fave DESC,time DESC";
	$ideas = array();
	$result = mysql_query($query);
	if($result) {
		while($s = mysql_fetch_assoc($result))
			$ideas[] = $s;
	}
	return $ideas;
}

// Get leader count
function getNumLeaders() {
	$obligatoryIntermediateValue = mysql_fetch_row(mysql_query("SELECT COUNT(*) FROM leaders"));
	return $obligatoryIntermediateValue[0];
}

// Get the confirmations (yes or no) of the retreat
function getRetreatConfs($poke) {
	$query = "SELECT id,fname,lname,email,diet FROM leaders WHERE rconfirm='".$poke."' ORDER BY diet DESC";
	$result = mysql_query($query);
	while($l = mysql_fetch_assoc($result)) {
		if($poke || (!$poke && $l['diet']))
			$confirmed[] = $l;
	}
	return $confirmed;
}
?>
