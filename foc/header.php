<html>
<head>
<title>FOC Admin Pages</title>
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<?php if($_SESSION['foc'] == "true") { ?>
<h1>Hello FOC! :)</h1>
<ul class="menu">
<li><a href="info.php?apps">View Applications</a></li>
<li><a href="info.php?incomplete">View Incomplete (no personality questions) apps</a></li>
</ul>
<br style="clear:both;" / >

<p>Search for an application by name/app id. Use &quot;%&quot; for wildcard.</p>
<p><form method="post" action="search.php">
<input type="text" name="search" id="search" /> <input type="submit" name="searchthings" value="Search" />
</form></p>

<?php } ?>
