<?php
session_start();

include("functions.php");
include_once("header.php");

if($_SESSION['foc'] == "true") {

// Override for person look-up
if($_GET['app']) {
	echo "<h1>Full App for application #".$_GET['app']."</h1>";
	echo "<hr />";
	$app = fullApp($_GET['app']);
	if($app){
		echo "<div class=\"fullapp\">";
		echo "<p class=\"name\"><b>".$app['fname']." ".$app['lname']."</b> aka <b>".$app['pname']."</b> (preferred)</p>";
		echo "<p><b>UWID:</b> ".$app['uwid']."</p>";
		echo "<p><b>UW Username:</b> ".$app['uwname']."</p>";
		echo "<p><b>Email:</b> <a href=\"mailto:".$app['email']."\">".$app['email']."</a></p>";
		echo "<p><b>Phone:</b> ".$app['phone']."</p>";

		echo "<p><b>Address (Winter):</b> ".$app['addressw']."</b></p>";
		echo "<p><b>Address (Spring):</b> ".$app['addressp']."</b></p>";
		echo "<p><b>Faculty/Program:</b> ".$app['faculty']."/".$app['program']."</b></p>";
		echo "<p><b>First-aid trained?</b> ";
		echo ($app['faid']) ? "Yes" : "No";

		echo "<p><b>Ranking preferences:</b><br />";
		$l = parseRankings($app[rankings]);
		$lp = getLPositions();
		$c = parseRankings($app[corankings]);
		$cp = getCPositions();
		
		echo "<ul class=\"emptyranks\">";
		outputRankPref($l,$lp);
		echo "</ul><br style=\"clear:both;\" /><br /><ul class=\"emptyranks\">";
		outputRankPref($c,$cp);
		echo "</ul><br style=\"clear:both;\" />";

		echo "<p><b>Personality Questions:</b><br />";
		echo "<ul class=\"questions fullquestions\">";
		outQuestions($app[lid]);
		echo "</ul>";

		//foreach($app as $field=>$value) {
		//	echo "<p><b>".$field."</b> ".$value."</p>\n";
		//}
		echo "</div>";
	}
	else {
		echo "Error! Contact bex";
	}
}

// Other options
switch($_SERVER['QUERY_STRING']) {
	case 'apps':
		echo "<h1>Viewing all Complete Applications</h1>";
		$apps = getCompleteApps();
		echo "<p>".count($apps)." applications. Note: I think some are invalid (trolls)</p>";
		echo "<p style=\"color:red;\">Check the 'check if read' checkbox, then click any of the buttons that say 'hide all checked'.</p>";
		
		if($apps) {
			echo "<form method=\"post\" action=\"info.php?hideapps\">";
			foreach($apps as $app) {
				$r = parseRankings($app['rankings']);
				$r2 = parseRankings($app['corankings']);
				$p = getLPositions();
				$c = getCPositions();
				
				echo "<div class=\"app";
				echo (isHidden($app[lid])) ? " hidden" : "";
				echo "\">";
				echo "<b>Applicant #".$app['lid'].". <a href=\"info.php?app=".$app['lid']."\">Full application</a></b>";
				echo "<input type=\"checkbox\" name=\"hide[".$app['lid']."]\" value=\"1\"";
				echo ($app[hide]) ? " checked " : "";
				echo "/>";
				if(!$app[hide])
					echo "check if read <input type=\"submit\" name=\"submit\" value=\"hide all checked\" />";
				else
					echo "already read";
				echo "<br />";
				echo "<ul class=\"ranks\"><li><b>Leader Positions</b></li>";
				outputRankPref($r, $p);
				echo "<li><b>Co-ordinator Positions</b></li>";
				outputRankPref($r2, $c);
				echo "</ul><ul class=\"questions\">";
				outQuestions($app['lid']);
				echo "</ul><br style=\"clear:both;\" /></div>";
			}
			echo "</form>";
		} else {
			echo "No applications.";
		}
		break;
	case 'hideapps': 
		if($_POST['hide']) {
			$apps = $_POST['hide'];
			echo "<p>";
			foreach($apps as $lid=>$hide) {
				if(hideApp($lid))
					echo "Application <b>".$lid."</b> hidden<br />";
			}
		echo "</p><br /><p>If you just press the back button on your browser you should be left at the same place you were before the applications were hidden.</p>";
		}
	break;
	case 'incomplete':
		echo "<h1>Viewing Applications with provided rankings only</h1>";
		echo "<p>These are applications that have none of the personal questions answered.</p>";
		$apps = getEmptyApps();
		echo "<p>".count($apps)." personalityless applications</p>";
		if($apps){
			foreach($apps as $app) {
				echo "<div class=\"app\">";
				echo "<p><a href=\"info.php?app=".$app['lid']."\">".$app['lid']."</a> ".$app['fname']." ".$app['lname']."</p>";

				$l = parseRankings($app[rankings]);
				$lp = getLPositions();
				echo "<ul class=\"emptyranks\">";
				outputRankPref($l,$lp);
				echo "</ul>";
				echo "<br style=\"clear:both;\" /><br />";

				$c = parseRankings($app[corankings]);
				$cp = getCPositions();
				echo "<ul class=\"emptyranks\">";
				outputRankPref($c,$cp);
				echo "</ul>";
				echo "<br style=\"clear:both;\" />";

				echo "</div>";
			}
		} else {
			echo "No empty apps.";
		}
		break;
	default: ;
}
}
mysql_close();
include("footer.php");
?>
