<?php 

include("functions.php");

function delete($lid) {
	$query = "DELETE FROM appinfo WHERE lid=$lid";
	$query2 = "DELETE FROM constantinfo WHERE lid=$lid";
	if(mysql_query($query2) && mysql_query($query))
		return true;
	return false;
}

if($_SERVER['QUERY_STRING'] == "delete" && $_POST['submit']) {
	$delete = $_POST['delete'];
	foreach($delete as $lid=>$del) {
		if(delete($lid))
			echo $lid." deleted<br />\n";
		else
			echo $lid." probably already gone<br />\n";
	}
}

$query = "SELECT DISTINCT uwid FROM constantinfo";
$result = mysql_query($query);
while($person = mysql_fetch_assoc($result))
	$people[] = $person;

echo "<form method=\"post\" action=\"prune123.php?delete\">";
foreach($people as $unique) {
	$query = "SELECT lid,fname,lname,email,phone FROM constantinfo WHERE uwid=$unique[uwid] order by lid";
	$query2 = "SELECT * FROM appinfo JOIN constantinfo ON constantinfo.lid=appinfo.lid WHERE constantinfo.uwid=$unique[uwid]";
	$result = mysql_query($query);
	while($d = mysql_fetch_assoc($result))
		$p[] = $d;

	if(count($p) > 1) {
		echo $unique['uwid']." has ".count($p)." entries in the constantinfo table<br />"; 
		echo "<div style='padding:20px;'>";

		foreach($p as $dupp) {
			echo "<p><input type=\"checkbox\" name=\"delete[".$dupp[lid]."]\" value=\"1\" /> <b>".$dupp['lid']."</b> ".$dupp['fname']." ".$dupp['lname']." ".$dupp['email']." ".$dupp['phone'];
		}
		
		$dupes = mysql_query($query2);
		while($dupe = mysql_fetch_assoc($dupes)){
			echo "<p><input type=\"checkbox\" name=\"delete[".$dupe[lid]."]\" value=\"1\" /> <b>".$dupe['lid']."</b> ".$dupe['rankings']." ".$dupe['corankings']."<br />";
			echo "<i>".$dupe['q1']."</i><br /><br />";
		}
		if(!$dupes)
			echo "<b>NO APPLICATION/RANKINGS INFORMATION</b>";
		echo "</div>";
	}

	unset($p);
}
echo "<input type=\"submit\" name=\"submit\" value=\"delete them\" /></form>";

/*
foreach($people as $person) {
	$query = "SELECT COUNT(*) FROM constantinfo WHERE uwid=$person[uwid]";
	$query2 = "SELECT lid,q1,rankings,corankings FROM appinfo WHERE lid=$person[lid]";
	$result = mysql_query($query);
	while($row = mysql_fetch_row($result)) {
		if($row[0] > 1){
			$dupes = mysql_query($query2);
			if(!$dupes) die(mysql_error());
			while($dup = mysql_fetch_assoc($dupes))
				$d[] = $dup;
			echo "<p>".$person['uwid']." has ".$row[0]." applications.</p>";
			foreach($d as $e){
				echo $e['rankings']." ".$e['q1']. "<br /><br />";
			}
			echo "<hr />";
		}
	}
}*/

mysql_close();
?>
