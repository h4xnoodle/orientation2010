<?php
session_start();
include "include/config.php"; //DB Stuff

function getLeaderProfile($lname,$uwid) {
	$query = "SELECT * FROM leader_profiles WHERE lid=(SELECT id FROM leaders WHERE lname='".$lname."' AND uwid='".$uwid."')";
	$result = mysql_query($query);
	if($result) {
		return mysql_fetch_assoc($result);
	} else {
		return false;
	}
}

// Process the step1 of the form here to grab the session stuff in order to populate the next step. Later, use AJAX.
if($_POST['update_profile']) {
	if($_POST['lname'] != "" && $_POST['uwid'] != "") {
		$_SESSION['leader_lname'] = $_POST['lname'];
		$_SESSION['leader_uwid'] = $_POST['uwid'];
		header('Location: update_profile.php?step2');
	} else {
		$_SESSION['error'] = "Please make sure your uwid and last name are not blank.";
	}
}

include "header.php";

switch($_SERVER['QUERY_STRING']) {
	case 'step2' :
?>
<h1>Update Your Leader Profile - Step 2!</h1>
<p>Amend or remove data from the populated fields. Press 'update' to submit your changes.</p>
<p>If any profanity, racism, non-OLT-friendly things are found in your profile, you will be contacted by the FOC and suffer the consequences.</p>

<?php 
if($_SESSION['error'] != "") {
	echo "<p>".$_SESSION['error']."</p>";
	$_SESSION['error'] = "";
} elseif($_SESSION['leader_lname'] == "" || $_SESSION['leader_uwid'] == "") {
	echo "<p>Please don't access this page directly.</p>";
} else {
	$leader_profile = getLeaderProfile($_SESSION['leader_lname'],$_SESSION['leader_uwid']);
	if(!$leader_profile) {
		echo "<p>You apparently aren't listed as having a profile (all leaders have profiles pre-created). Please contact the web admin <a href='mailto:h4xnoodle@gmail.com'>Rebecca</a> if you think this in error.</p>";
	} else {
		echo "<form method='post' action='include/update_profile_process.php' onsubmit='return confirm(\"Your previous profile information will be completely overwritten by any updates you have provided. Continue?\")' >\n";
		echo "<p><input type='hidden' name='lname' value='".$_SESSION['leader_lname']."' /></p>\n";
		echo "<p><input type='hidden' name='uwid' value='".$_SESSION['leader_uwid']."' /></p>\n";
		echo "<p>Do you have a nickname?<br /><input type='text' name='nickname' style='width:350px;' value='".$leader_profile['nickname']."' /></p>\n";
		echo "<p>What is your term/program? IE: 3A Computer Science<br /><input type='text' style='width:350px;' name='termprog' value='".$leader_profile['termprog']."' /></p>\n";
		echo "<p>Where is your hometown?<br /><input type='text' name='hometown' style='width:350px;' value='".$leader_profile['hometown']."' /></p>\n";
		echo "<p>Your favourite Pokemon series?<br /><input type='text' name='fave_series' style='width:350px;' value='".$leader_profile['fave_series']."' /></p>\n";
		echo "<p>Your favourite Pokemon battle attack?<br /><textarea name='fave_atk' cols='80' rows='6'>".$leader_profile['fave_atk']."</textarea></p>\n";
		echo "<p>What do you LOVE about UW? (Be positive now!)<br /><textarea name='loveuw' cols='80' rows='6'>".$leader_profile['loveuw']."</textarea></p>\n";
		echo "<p>What is your advice to first-year students?<br /><textarea name='advice' cols='80' rows='6'>".$leader_profile['advice']."</textarea></p>\n";
		echo "<p><input type='submit' name='update_profile' value='Update' /></p>\n";
		echo "</form>";
	}
}
		break;
	default:
?>

<h1>Update Your Leader Profile</h1>
<p>Here you can update your leader profile by first providing your last name and UW ID as entered when you applied (just like the retreat confirmation). You will then be taken to a form where you can update your information.</p>

<?php
if($_SESSION['leader_lname'] && $_SESSION['leader_uwid'])
	echo "<p>You have recently edited, please <a href='update_profile.php?step2'>continue</a>.</p>";
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<p>Last name: <input type="text" name="lname" /></p>
<p>UW ID: <input type="text" name="uwid" /></p>
<p><input type="submit" name="update_profile" value="Continue" /></p>
</form>

<?php
} //switch
include "footer.php";
?>
