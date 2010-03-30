<?php require("header.php"); ?>

<?php switch($_SERVER['QUERY_STRING']) {
	case 'events' :
		echo "<h1>".$names['events']."</h1>";
		echo "<p>Coming soon!</p>";
		break;
	
	case 'pictures':
		echo "<h1>".$names['pictures']."</h1>";
		echo "<p>Please click <a href='http://orientation.math.uwaterloo.ca/gallery/main.php'>this wonderful link</a> to go to the photo gallery.</p>";
		break;

	case 'sponsors':
		echo "<h1>".$names['sponsors']."</h1>";
		echo "<p>Coming soon!</p>";
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
