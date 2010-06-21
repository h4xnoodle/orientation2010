<?php
session_start();
?>
<html>
<head>
	<title>Secret Tools page for bex</title>
</head>
<body>
<?php 
if($_SESSION['pokemon'] == "a753c3945400cd54c7ffd35fc07fe031") {

include "include/config.php";

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
			$result = mysql_query($query);
			if($result)
				echo "Added<br />";
			else
				echo "Failed<br />";
		} else {
			echo "That person doesn't exist";
		}
	}
}

if($_POST['moo']) {
	insert($_POST['person']);
} else if($_POST['se']) {
	if($_POST['pname'] == "")
		$_POST['pname'] = $_POST['fname'];
		
	$query = "INSERT INTO leaders (uwid,uwname,fname,lname,pname,email,faculty,program) VALUES (".$_POST['uwid'].",\"".$_POST['uwname']."\",\"".$_POST['fname']."\",\"".$_POST['lname']."\",\"".$_POST['pname']."\",\"".$_POST['email']."\",\"Engineering\",\"Software\")";
	$result = mysql_query($query);
	if($result)
		echo "Softie added<br />";
	else
		echo "Failed adding softie :(<br />";
} elseif($_POST['changeteams']) {
	print_r($_POST);
	$uwids = explode(',',$_POST['uwids']);
	print_r($uwids);
	foreach($uwids as $uwid) {
		$query .= "UPDATE leaders SET lpos='".$_POST['team']."' WHERE uwid='".$uwid."';"; 
	}

}
?>
<h3>Secret Tools Page</h3>
<p>Add leader from constantinfo to leaders by uwid</p>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<input type="text" name="person" maxlength="8" />
<input type="submit" name="moo" value="Enter them" />
</form>

<p>Add a leader (SE mostly) only knowing this information</p>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
ID: <input type="text" name="uwid" value="00000000" /><br />
UWNAME: <input type="text" name="uwname" /><br />
FNAME: <input type="text" name="fname" /><br />
LNAME: <input type="text" name="lname" /><br />
PNAME: <input type="text" name="pname" /><br />
EMAIL: <input type="text" name="email" /><br />
<input type="submit" name="se" value="Add Softie" />
</form>

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

<?php 
// Woo security by obscruity!
} elseif($_SERVER['QUERY_STRING'] == "combee") {
	if($_POST['submit']) {
		$_SESSION['pokemon'] = md5($_POST['poke']);
		header('Location: secret.php');
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
