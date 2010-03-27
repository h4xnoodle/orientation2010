<!-- ffe9e9 background ; f2448a splash title; f8ac08 splash math yellow; 3e49b6 blue-->

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>UW Math Orientation 2010</title>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8" />
<meta name="description" content="University of Waterloo, Faculty of Mathematics. Orientation 2010" />
<meta name="keywords" content="waterloo, orientation, pokemon, math, pikachu, pink tie, pinktie, pink-tie, tie" />
<script type="text/javascript" src="flowplayer/flowplayer-3.1.4.min.js"></script>
<style type="text/css">
	img { border:0; }
	div#wrap {
		margin:20px auto;
		width:800px;
		text-align:center;
		}
	div.sidenotes {
		position:absolute;
		top:300px; left:30px;
		width:200px;
		font-family:sans-serif;
		font-size:14px;
		line-height:22px;
		}
		div.sidenotes b {
			color:#f2448a;
			font-size:18px;
			font-family:sans-serif;
			}
	div#wrap h1 {
		background:url(imgs/title.png) 0 0 no-repeat;
		width:659px; height:158px;
		margin:0 auto;
		}
	div#wrap b.count {
		color:#aaa;
		font-size:20px;
		font-family:sans-serif;
		}
	div.video {
		margin:0 auto;
		border:2px solid #aaa;
		width:640px; height:480px;
		}
		div.video a#player {
			width:640px; height:480px;
			display:block;
			}
	div.enter a {
		margin:20px auto;
		display:block;
		width:321px; height:138px;
		background:url(imgs/enter_off.png) 0 0 no-repeat;
		}
	div.enter a:hover {
		background:url(imgs/enter_on.png) 0 0 no-repeat;
		}
</style>
</head>
<body>
<div class="sidenotes">
	<p><b>Sidenotes!</b></p>
	<p>Leader apps are still open! Click <a href="apply/application2.php">here</a> to apply for Pink Tie and Black Tie positions.</p>
</div>
<div id="wrap">
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
