<?php require("header.php"); ?>

<?php switch($_SERVER['QUERY_STRING']) {
	case 'events' :
		echo "<h1>".$names['events']."</h1>";
		echo "<p>For the week of September 5th, 2010. Roll over the event to see its description. Javascript should be enabled for prettier tooltips :)</p>";
		echo "<table class='event_schedule'><tr><td class='math_event'>Math Event</td><td class='campus_event'>Campus-wide event</td></tr></table>";
		include "include/event_schedule.php";
		break;
	
	case 'pictures':
		echo "<h1>".$names['pictures']."</h1>";
		echo "<p>Please click <a href='http://orientation.math.uwaterloo.ca/gallery/main.php'>this wonderful link</a> to go to the photo gallery.</p>";
		break;

	case 'sponsors':
		echo "<h1>".$names['sponsors']."</h1>";
		echo "<p>We would like to thank:</p>";
		echo "<p><a href=\"http://mathsoc.uwaterloo.ca\"><img src=\"imgs/thanks/mathsoc.jpg\" alt=\"MathSOC\" /></a>";
		echo " <a href=\"http://campuspizza.ca\" title=\"Campus Pizza\"><img src=\"imgs/thanks/campus_pizza.jpg\" alt=\"Campus Pizza\" /></a></p>";
		break;

	case 'contact':
		echo "<h1>".$names['contact']."</h1>";
		echo "<p>If you have any questions about Orientation Week, please contact the Math Orientation Directors at: <a href='orientat@math.uwaterloo.ca'>orientat@math.uwaterloo.ca</a>. You can also check the <a href='faq.php'>Frequently Asked Questions</a> section for answers to popular questions.</p>";
		break;
		
	default:
		echo "<h1>".$names['main']."</h1>"; ?>
		
		<h2>Congratulations and welcome to the University of Waterloo’s Faculty of Mathematics!</h2>

<p>Are you ready to learn all about being a student at UW? More importantly… are you ready to meet new people, the dean, and professors? Are you ready to Earn Your Tie, learn what is where and why, get dressed up for Monte Carlo and participate in the LARGEST Toga Party in the country (don’t forget your extra bed sheet and safety pins!)</p>

<p>If you said yes to anything above, that’s only a taste of what’s to come for Orientation Week 2010!</p>

<p>Get ready for an awesome week filled with spectacular events and entertainment!</p>

<h2>Welcome to the University of Waterloo!</h2><h2>See you in September!</h2>

<?php } ?> 

<?php require("footer.php"); ?>
