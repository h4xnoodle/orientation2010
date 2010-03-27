<?php

// Connect to the database
mysql_connect("localhost","orient2010","V1ct0ri@.CB");
mysql_select_db("orientation2010");

function getLeaderPositions() {
	$query = "SELECT * FROM leaderpositions";
	$result = mysql_query($query);
	while($pos = mysql_fetch_assoc($result))
		$p[] = $pos;
	return $p;
}

function getCoordPositions() {
	$query = "SELECT * FROM coordpositions";
	$result = mysql_query($query);
	while($pos = mysql_fetch_assoc($result))
		$p[] = $pos;
	return $p;
}

function checkClean($string) {
	return mysql_real_escape_string($string);
}

function getLid($uwid) {
	$query = "SELECT lid FROM constantinfo WHERE uwid=$uwid";
	$result = mysql_query($query);
	if(mysql_num_rows($result) == 1) {
		$id = mysql_fetch_assoc($result);
		return $id['lid'];
	}	
	// Use the last person created
	$last = mysql_num_rows($result)-1;
	while($row[] = mysql_fetch_assoc($result));
	$lid = $row[$last];
	return $lid['lid'];
}
?>
