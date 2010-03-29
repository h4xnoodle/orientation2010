<!-- ffe9e9 background ; f2448a splash title; f8ac08 splash math yellow; 3e49b6 blue-->

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>UW Math Orientation 2010</title>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
<meta name="description" content="University of Waterloo, Faculty of Mathematics. Orientation 2010" />
<meta name="keywords" content="waterloo, orientation, pokemon, math, pikachu, pink tie, pinktie, pink-tie, tie" />
<script type="text/javascript" src="flowplayer/flowplayer-3.1.4.min.js"></script>
<link rel="stylesheet" href="splash_style.css" type="text/css" />
</head>
<body>
<div id="splash_wrap">
	<div class="sidenotes">
		<p><b>Sidenotes!</b></p>
		<p>Leader apps are still open! Click <a href="apply/application2.php">here</a> to apply for Pink Tie and Black Tie positions.</p>
	</div>
	<h1 title="UW Orientation 2010 -  Math! I choose you!"></h1>

	<div class="video"><a href="imgs/themeRelease.flv" id="player"></a></div>
	<div class="enter"><a href="#"></a></div>
	<?php 
		$oweek = '1283608800'; // Date of O-week in seconds
		$diff = $oweek - time();
		echo "<b class='count'>".floor(($diff / (60 * 60 * 24)) + 1)." days until Orientation 2010!</b>";
	?>

</div>
<script type="text/javascript">
	flowplayer("player", "flowplayer/flowplayer-3.1.5.swf", 
		{ clip: 
			{ 
			autoPlay: false, 
			autoBuffering: true 
			} 
		});
</script>

<!-- GOOGLE! -->
<script type="text/javascript">
	var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
	document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
	try {
	var pageTracker = _gat._getTracker("UA-10189862-3");
	pageTracker._trackPageview();
	} catch(err) {}
</script>
</body>
</html>
