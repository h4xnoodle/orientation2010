<?php
session_start();
?>
<html>
<head>
	<title>Secret Tools page for bex</title>
</head>
<body>
<?php 
include "include/config.php";
include "foc/functions.php";

if($_SESSION['pokemon'] == "a753c3945400cd54c7ffd35fc07fe031") {

function insert($uwid) {
	$checkQuery = "SELECT * FROM leaders WHERE uwid='".$uwid."'";
	$result = mysql_query($checkQuery);
	if($result && mysql_num_rows($result)) {
		echo "person already in leaders table";
	} else {
		$query = "SELECT * FROM constantinfo WHERE uwid='".$uwid."'";
		$result = mysql_query($query);
		if($result && mysql_num_rows($result)) {
			$stuff = mysql_fetch_assoc($result);
			$query = "INSERT INTO leaders (appid,uwid,uwname,fname,lname,pname,email,faculty,program,phone,addressw,addressp,faid) VALUES (".$stuff['lid'].",".$stuff['uwid'].",\"".$stuff['uwname']."\",\"".$stuff['fname']."\",\"".$stuff['lname']."\",\"".$stuff['pname']."\",\"".$stuff['email']."\",\"".$stuff['faculty']."\",\"".$stuff['program']."\",\"".$stuff['phone']."\",\"".$stuff['addressw']."\",\"".$stuff['addressp']."\",".$stuff['faid'].")";
			$add_profile = "INSERT INTO leader_profiles(lid) select id from leaders where uwid='".$uwid."'";
			$result = mysql_query($query) && mysql_query($add_profile);
			if($result)
				echo "Added<br />";
			else
				echo "Failed<br />".mysql_error();
		} else {
			echo "That person doesn't exist";
		}
	}
}

function remove($uwid,$state) {
	$leader = "UPDATE leaders SET state='".$state."' WHERE uwid='".$uwid."'";
	$profile = "DELETE FROM leader_profiles WHERE lid=(SELECT id FROM leaders WHERE uwid='".$uwid."')";
	if(mysql_query($profile) && mysql_query($leader)) {
		echo "Update complete";
	} else {
		echo "Update failed<br /><br />".mysql_error();
	}
}


if($_POST['moo']) {
	insert($_POST['person']);

} else if($_POST['remove']) {
	remove($_POST['uwid'],$_POST['state']);

} else if($_POST['se']) {
	if($_POST['pname'] == "")
		$_POST['pname'] = $_POST['fname'];
		
	$query = "INSERT INTO leaders (uwid,uwname,fname,lname,pname,email,faculty,program) VALUES (".$_POST['uwid'].",\"".$_POST['uwname']."\",\"".$_POST['fname']."\",\"".$_POST['lname']."\",\"".$_POST['pname']."\",\"".$_POST['email']."\",\"Engineering\",\"Software\")";
	$result = mysql_query($query);
	if($result)
		echo "Softie added<br />";
	else
		echo "Failed adding softie :(<br />";
} elseif($_POST['changeteam']) {
	$success = true;
	$uwids = explode(',',$_POST['uwids']);
	foreach($uwids as $uwid) {
		$query = "UPDATE leaders SET team='".$_POST['team']."' WHERE uwid='".$uwid."';"; 
		if(!mysql_query($query))
			$success = false;
	}
	echo ($success) ? "Updated passed" : "Update failed";
} elseif($_POST['changerole']) {
	$success = true;
	$uwids = explode(',',$_POST['uwids']);
	foreach($uwids as $uwid) {
		if($_POST['role'] > 100) 
			$query = "UPDATE leaders SET cpos='".($_POST['role']-100)."' WHERE uwid='".$uwid."'";
		else
			$query = "UPDATE leaders SET lpos='".$_POST['role']."' WHERE uwid='".$uwid."'"; 
		if(!mysql_query($query))
			$success = false;
	}
	echo ($success) ? "Updated passed" : "Update failed";
}
?>
<h3>Secret Tools Page</h3>
<p>Add leader from constantinfo to leaders by uwid</p>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="text" name="person" maxlength="8" />
<input type="submit" name="moo" value="Enter them" />
</form>

<p>Remove a leader (set state to withdrawn or banned)</p>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="text" name="uwid" /><select name="state"><option value="withdrawn">Withdrawn</option><option value="banned">Banned</option></select><br />
<input type="submit" name="remove" value="Set state &amp; Remove profile" />
</form>

<!--<p>Add a leader (SE mostly) only knowing this information</p>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
ID: <input type="text" name="uwid" value="00000000" /><br />
UWNAME: <input type="text" name="uwname" /><br />
FNAME: <input type="text" name="fname" /><br />
LNAME: <input type="text" name="lname" /><br />
PNAME: <input type="text" name="pname" /><br />
EMAIL: <input type="text" name="email" /><br />
<input type="submit" name="se" value="Add Softie" />
</form>-->

<h3>Assign leader teams by uwid</h3>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
List of ID's separated by commas:<br />
<textarea name="uwids" style="width:300px;height180px;"></textarea><br /><br />
<select name="team">
<?php 
$teams = getTeams(array('leader','other','blacktie')); 
foreach($teams as $t) {
	echo "\t<option value=\"".$t['tid']."\">".$t['displayname']."</option>\n";
}
?>
</select> <br />
<input type="submit" name="changeteam" value="Change teams" />
</form>

<h3>Assign leader roles by UWID</h3>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
List of ID's separated by commas:<br />
<textarea name="uwids" style="width:300px;height180px;"></textarea><br /><br />
<select name="role">
<?php 
$lpos = getLPositions();
$cpos = getCPositions();
foreach($lpos as $t) {
	echo "\t<option value=\"".$t['id']."\">".$t['position_name']."</option>\n";
}
foreach($cpos as $t) {
	echo "\t<option value=\"";
	echo $t['id']+100;
	echo "\">".$t['position_name']."</option>\n";
}
?>
</select> <br />
<input type="submit" name="changerole" value="Change Roles" />
</form>

<?php 
// Woo security by obscruity!
} elseif($_SERVER['QUERY_STRING'] == "combee") {
	if($_POST['submit']) {
		$_SESSION['pokemon'] = md5($_POST['poke']);
		echo "<a href=\"secret.php\">Vaporeon!</a>";
	} else {
	echo "Login:<br /><br />";
	echo "<form method='post' action='".$_SERVER['PHP_SELF']."?combee'>";
	echo "<input type=\"password\" name=\"poke\" />";
	echo "<input type=\"submit\" name=\"submit\" value=\"Enter the secret lair\" />";
	echo "</form>";
	}
} else {
	echo "Mew!";
}
?>
</body>
</html>
