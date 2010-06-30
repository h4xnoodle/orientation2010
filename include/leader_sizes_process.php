<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<title>UW Math Orientation 2010 - Leader Gear Sizes</title>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
	<style type="text/css">
		body {
			margin:100px auto;
			background-color:#ffd6d6;
			}
		p {
			width:60%;
			background-color:#fff;
			margin:50px auto;
			padding:20px;
			text-align:center;
			line-height:20px;
			font-family:sans-serif;
			font-size:16px;
			color:#666;
			}
			p b {
				padding:0; margin:0;
				font-size:24px;
				}
			p a {
				text-decoration:none;
				color:#f2448a;
				font-weight:bold;
				}
	</style>
</head>
<body>
<?php
include "../foc/functions.php";

$topMsg = "<p><b>Math Orientation Leader Gear Size Submission</b></p>";
$successmsg = "<p>Thanks! We've received your sizing information.</p>";
$resubmsg = "<p>It looks like you've already submitted sizing information. Please <a href='mailto:orientat@math.uwaterloo.ca'>notify us</a> if you wish to change this information.</p>";
$botMsg = "<p><a href='http://orientation.math.uwaterloo.ca/2010/main.php'>Return</a></p>"; 

function check($msg) {
	echo "<p style='color:red;font-weight:bold;'>".$msg."</p>";
	return;
}

if($_POST['submit']) {
	
	if($_POST['lname'] == "" || $_POST['uwid'] == "") {
		check("Please enter your UW Student number and your lastname. Enter 0 if you're a software engineer.");
		return;
	}

	$query = "SELECT size_shirt FROM leaders WHERE uwid='".$_POST['uwid']."' AND lname LIKE '".$_POST['lname']."'";
	$result = mysql_query($query);
	if(mysql_num_rows($result)){ 
		$match = mysql_fetch_assoc($result);
		if($match['size_shirt'] != "") {
			echo $topMsg . $resubmsg . $botMsg;
			return;
		} else {
			$query = "UPDATE leaders SET size_shirt='".$_POST['shirt']."' WHERE uwid='".$_POST['uwid']."'";
			$result = mysql_query($query);
			if(!$result) {
				check("An error occurred. An email has been sent to the website admin.");
				mail('h4xnoodle@gmail.com','oweek: oh shit',"Retreat form could not update");
			} else {
				echo $topMsg . $successmsg . $botMsg;
			}
		}
	} else {
		check("There was no match for your UWID and lastname. Please go back and make sure you've entered them correctly. <br /><br />Note: SE leaders please enter 0 for your UWID. <br /><br />If you believe this is in error, please contact the web admin: <a href='mailto:h4xnoodle@gmail.com'>Rebecca</a>");
	}
}
?>
</body>
</html>
