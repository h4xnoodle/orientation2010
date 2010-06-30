<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>FOC Admin Pages</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<?php
if($_SESSION['foc'] == "true") {
	// Crazy menu.. only one level below 0
	$menu = array(
				array('link'=>"info.php?apps",'display'=>"View Apps",'order'=>3,'children'=>array(
					array('link'=>"info.php?incomplete",'display'=>"Incomplete Apps",'order'=>0))),
				array('link'=>"boxadmin.php",'display'=>"Suggestion Box Admin",'order'=>2,'children'=>0),
				array('link'=>"retreatview.php",'display'=>"View Retreat Confirmations",'order'=>1,'children'=>array(
					array('link'=>"retreatview.php?table",'display'=>"View Tabular Format",'order'=>0))),
				array('link'=>"editleaders.php",'display'=>"Edit Leader Info",'order'=>0,'children'=>array(
					array('link'=>"editleaders.php?markpaid",'display'=>"Mark Leaders Paid",'order'=>0),
					array('link'=>"editleaders.php?trash",'display'=>"Remove a Leader",'order'=>1))),
				array('link'=>"misctools.php",'display'=>"Misc. Tools",'order'=>4,'children'=>array(
					array('link'=>"misctools.php?tool=add_sponsor",'display'=>"Add a Sponsor",'order'=>0),
					array('link'=>"misctools.php?tool=sizing",'display'=>"Gear Sizing Info",'order'=>1))),
				array('link'=>"admin.php",'display'=>"Changelog/Info",'order'=>100,'children'=>0)
			);
	function showFOCMenu($menu) {
		echo "<ul class='menu'>";
		foreach($menu as $item) {
			echo "<li><a href='".$item['link']."' title='".$item['display']."'>".$item['display']."</a></li>";
			if($item['children']) {
				echo "<li><ul>";
				foreach($item['children'] as $child)
					echo "<li><a href='".$child['link']."' title='".$child['display']."'>".$child['display']."</a></li>";
				echo "</ul></li>";
			}
		}
		echo "</ul>";
	}
?>

<div id="wrap">
	<div class="logout"><a href="index.php?logout">Logout</a></div>
	<h1>Welcome FOC of <?php echo date('Y'); ?>!</h1>
	<p><b><?php echo floor(((1283608800 - time()) / (60 * 60 * 24)) + 1); ?></b> days until Orientation 2010!</p>
	<p></p>
	<hr />
	<div id="sidebar">
		<h3>Search</h3>
		<p>Search for a leader by first name, last name, preferred name, or UW name.<br />Use &quot;%&quot; for wildcard.</p>
		<form method="post" action="search.php">
		<p><input type="text" name="search" id="search" /><br /><input type="submit" name="searchthings" value="Search" /></p>
		</form>
		<h3>Tasks</h3>
		<?php showFOCMenu($menu) ?>
	</div>
	<div id="content">
<?php } // Session ?>
