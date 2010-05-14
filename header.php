<?php
require("include/config.php");
session_start();
 ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<title>UW Math Orientation 2010 - <?php echo $names[basename($_SERVER[PHP_SELF],'.php')]; ?></title>
	<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
	<meta name="description" content="University of Waterloo, Faculty of Mathematics. Orientation 2010" />
	<meta name="keywords" content="waterloo, orientation, pokemon, math, pikachu, pink tie, pinktie, pink-tie, tie" />
	<script type="text/javascript" src="flowplayer/flowplayer-3.1.4.min.js"></script>
	<script src="http://widgets.twimg.com/j/2/widget.js"></script>
	<link rel="stylesheet" href="style.css" type="text/css" />
	<!-- lol -->
	<?php if(!(basename($_SERVER['PHP_SELF'],'.php') == "main" && !($_SERVER['QUERY_STRING']))) { ?>
	<style type='text/css'>
		div#wrap div#sidebar {
			display:none;
		}
		div#wrap div#content {
			width: 840px;
		}
	</style>
	<?php } ?>
</head>
<body>

<div id="wrap">
	<div id="header">
		<a class="home" href="main.php"> </a>
		<ul class="teams">
			<?php foreach($teams as $team)
				echo "<li><a href='#'>".$team."</a></li>";
			?>
		</ul>
	</div>

	<div id="menu">
		<ul>
		<li><a href="main.php">Home</a></li>
		<li><a href="main.php?events">Events</a></li>
		<li><a href="cheers.php">Cheers</a></li>
		<li><a href="main.php?pictures">Pictures</a></li>
		<li><a href="faq.php">FAQ</a><li>
		<li><a href="pinktie.php">The Pink Tie</a></li>
		<li><a href="main.php?sponsors">Sponsors</a></li>
		<li><a href="main.php?contact">Contact Us</a></li>
		</ul>
	</div>
	
	<div id="content"> <!-- It won't end up being all nicely tabbed :( -->
