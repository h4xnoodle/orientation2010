<?php 
session_start();

include("functions.php");

// Process the submission
if($_POST['submit']) {

	$data = $_POST['app'];
	$_SESSION['app'] = $data;

	switch($_POST['page']) {

		// Persistent information about an applicant/leader
		// Contact information/names etc
		case 'first':
			$success = true;

			if(!is_numeric($data['uwid']))
				die("Enter a number for your uwid");

			foreach($data as $field=>$value) {
				if($value == "") {
					$success = false;
					break;
				}
				else {
					$data[$field] = checkClean($data[$field]);
					$insert .= "\"".$data[$field]."\",";
				}
			}
			
			$insert = substr($insert,0,strlen($insert)-1);
			
			$query = "INSERT INTO constantinfo (uwid,uwname,fname,lname,pname,email,phone,faculty,program,addressw,addressp,faid) VALUES ($insert)";
			
			if(!@mysql_query($query)) {
				die("There was an error submitting this portion of the application. <br /><a href='mailto:rjputins@uwaterloo.ca'>Email the website director</a>. Please include the following error message: ". mysql_error()."<br /><br />If you've already tried to submit an application before, then it's likely that the error says something about a duplicate entry.");
				$message = getLid($data['uwid'])."\n\n".mysql_error();	
				$message = wordwrap(70,$message);
				mail("h4xnoodle@gmail.com","O-WEEK Form: First stage", $message, "From: ".$data['email']."\r\n");
			}

			$_SESSION['lid'] = getLid($data['uwid']);

			$add = "INSERT INTO appinfo (lid) VALUES ($_SESSION[lid])";
			if(!mysql_query($add)) {
				die("Error. Dispatched email to website director.");
				mail("h4xnoodle@gmail.com","Error with appinfo add","Error with appinfo add!",'From: me@pink-tie.uwaterloo.ca'."\r\n");
			}

			// Go to next portion of the form if no problems
			if($success)
				header("Location: application2.php?leader_app");
			else {
				$_SESSION['error'] = true;
				header("Location: application2.php");
			}
			break;

		// Application form information. Relatively temporary compared to contact info
		// Storage of position rankings and stuff
		case 'second':
			$success = true;

			// Check that something wasn't chosen twice
			$lpositions = getLeaderPositions();
			$cpositions = getCoordPositions();

			$count = count($lpositions);
			for($i=0; $i < $count; $i++) {	
				$insertl .= $data["leader_$i"].":";
			}
			$count = count($cpositions);
			for($i=0; $i < $count; $i++) {
				$insertc .= $data["co_$i"].":";
			}

			$insertl = "\"".substr($insertl,0,strlen($insertl)-1)."\"";
			$insertc = "\"".substr($insertc,0,strlen($insertc)-1)."\"";

			
			$query = "UPDATE appinfo SET rankings=$insertl, corankings=$insertc WHERE lid=$_SESSION[lid]";
			
			if(!@mysql_query($query))
				die("Could not insert rankings into the database. Contact <a href='mailto:rjputins@uwaterloo.ca'>the website director</a>. Include this error message: <br />".mysql_error());

			if($success)
				header("Location: application2.php?questions");
			else{
				$_SESSION['error'] = true;
				header("Location: application2.php?leader_app");
			}
			
			break;

		// Personality questions also added to application table
		case 'third':
			$success = true;
			
			$update = "UPDATE appinfo SET ";
			
			foreach($data as $field=>$value) {
				if($value == "") {
					$success = false;
					break;
				}
				else {
					$data[$field] = checkClean($data[$field]);
					$update .= $field."=\"".$data[$field]."\",";
				}
			}
			
			$update = substr($update,0,strlen($update)-1);
			$update .= " WHERE lid=$_SESSION[lid]";


			if(!@mysql_query($update))
				die("There was an error submitting this portion of the application. <br /><a href='mailto:rjputins@uwaterloo.ca'>Email the website director</a>. Include this error message: <br />". mysql_error());

			if($success) {
				$_SESSION['app'] = "";
				header("Location: application2.php?done");
			}
			else {
				$_SESSION['error'] = true;
				header("Location: application2.php?questions");
				}
			break;
		default: ;
	}
mysql_close();	
}
else {
	echo "Please don't access this page directly. It won't do anything.";
	echo "<a href='http://orientation.math.uwaterloo.ca/'>Back to Math Orientation</a>";
}
?>
