<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<title>UW Math Orientation 2010 - Retreat Confirmation</title>
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

// Retreat confirmation process

include "../foc/functions.php";

$topMsg = "<p><b>Math Orientation Retreat Confirmation</b></p>";
$yesMsg = "<p>Thank you!<br />We've received your confirmation that you'll be joining us on July 10th!<br /><br />\nWe look forward to seeing you.<br /><br />\nIf you have any questions, comments, or concerns, please feel free to contact us at <a href='mailto:orientat@math.uwaterloo.ca'>orientat@math.uwaterloo.ca</a>.</p>";
$noMsg = "<p>Thank you for letting us know that there may be complications in your attendance.<br /><br />\n As this retreat is a mandatory part of being a leader for Math Orientation, your reason will be under review and we will get back to you with feedback in the near future.<br /><br />\nIf you have any questions, comments, or concerns, please feel free to contact us at <a href='mailto:orientat@math.uwaterloo.ca'>orientat@math.uwaterloo.ca</a>.</p>";
$reSubMsg = "<p>It seems you've already confirmed. If you wish to adjust your information, please contact us at orientat@math.uwaterloo.ca.<br /><br />Please provide the details: Your student ID number, your confirmation (yes or no), and your reason (if no) or your dietary restrictions if any.<br /><br />Thanks!</p>";
$botMsg = "<p><a href='http://orientation.math.uwaterloo.ca/2010/main.php'>Return</a></p>"; 

function check($msg) {
	echo "<p style='color:red;font-weight:bold;'>".$msg."</p>";
	echo $botMsg;
	return;
}

if($_POST['submit']) {
	// Check if the answer is no, there is a reason.
	if(!$_POST['confirm'] && $_POST['reason'] == "") {
		check("You must enter a reason for not attending. Please go back and try again.");
		return;
	}
	// Check lastname and student number are not blank
	if($_POST['lname'] == "" || $_POST['uwid'] == "") {
		check("Please enter your UW Student number and your lastname.");
		return;
	}
	// Check lastname and UWID together to verify leader
	$query = "SELECT * FROM leaders WHERE uwid='".$_POST['uwid']."' AND lname LIKE '".$_POST['lname']."'";
	$result = mysql_query($query);
	// There is a match
	if(mysql_num_rows($result)){ 
		$match = mysql_fetch_assoc($result);
		if($match['rconfirm'] || (!$match['rconfirm'] && $match['diet'] != "")) {
			echo $topMsg . $reSubMsg . $botMsg;
			return;
		} else {
			$query = "UPDATE leaders SET rconfirm=".$_POST['confirm'].",  diet=\"".$_POST['reason']."\" WHERE uwid='".$_POST['uwid']."'";
			$result = mysql_query($query);
			if(!$result) {
				check("An error occurred. An email has been sent to the website admin.");
				mail('h4xnoodle@gmail.com','oweek: oh shit',"Retreat form could not update");
			} else {
				if($_POST['confirm'])
					echo $topMsg . $yesMsg . $botMsg;
				else
					echo $topMsg . $noMsg . $botMsg;
			}
		}
	} else {
		check("There was no match for your UWID and lastname. Please go back and make sure you've entered them correctly. If you believe this is in error, please contact the web admin: <a href='mailto:h4xnoodle@gmail.com'>Rebecca</a>");
	}
}
?>
</body>
</html>
