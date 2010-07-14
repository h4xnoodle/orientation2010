<?php
session_start();

include "config.php";

if($_POST['update_profile']) {
	if($_POST['lname'] == "" or $_POST['uwid'] == "")
		exit("Your session probably expired. Try updating your profile within 20mins of entering step 2.");
	
	$query = "UPDATE leader_profiles SET nickname=\"".$_POST['nickname']."\", termprog=\"".$_POST['termprog']."\", hometown=\"".$_POST['hometown']."\", fave_atk=\"".addslashes($_POST['fave_atk'])."\", fave_series=\"".addslashes($_POST['fave_series'])."\", loveuw=\"".addslashes($_POST['loveuw'])."\", advice=\"".addslashes($_POST['advice'])."\" WHERE lid=(SELECT id FROM leaders WHERE lname='".$_POST['lname']."' AND uwid='".$_POST['uwid']."')";

	if(mysql_query($query)) {
		 $_SESSION['error'] = "Profile Updated successfully. <a href='update_profile.php?step2'>Update again?</a>";
		 header('Location: ../update_profile.php?step2');
	} else {
		echo "Le fail! An email has been sent to the web admin. The error sent: ".mysql_error();
		mail('h4xnoodle@gmail.com','Profile Update Failed!',$_POST['uwid']."\n\n".mysql_error());
	}
}
?>
