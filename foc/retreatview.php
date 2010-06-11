<?php
// Retreat confirmation viewing
session_start();
include "functions.php";
include "header.php";
echo "<h1>Retreat Confirmation Viewer</h1>";
echo "<p>View leaders who have said yes and no (with reasons!)</p>";

$confirmations = getRetreatConfs(1);
$denied = getRetreatConfs(0);
$total = getNumLeaders();

echo "<p>Out of <b>".$total."</b> leaders, <b>".count($confirmations)."</b> said they were attending, and <b>".count($denied)."</b> said they weren't. <b>".($total-count($denied)-count($confirmations))."</b> have yet to respond.</p>";
?>
<hr />
<div>
<div style="width:48%;float:left;">
<p style='background-color:#aaa;text-align:center;padding:4px;color:#fff;'>CONFIRMED</p>
<?php
if(count($confirmations)) {
	foreach($confirmations as $c) {
		echo "<p style='line-height:20px;background-color:#eee;padding:3px;'><a href='mailto:".$c['email']."'><b style='color:green;'>".$c['fname']." ".$c['lname']."</b></a> confirmed.<br />Diet Specs: ".$c['diet']."</p>";
	}
}
?>
</div><div style="width:48%;float:right;">
<p style='background-color:#aaa;text-align:center;padding:4px;color:#fff;'>NOT ATTENDING</p>
<?php
if(count($denied)) {
	foreach($denied as $d) {
		echo "<p style='line-height:20px;background-color:#eee;padding:3px;'><a href='mailto:".$d['email']."'><b style='color:red;'>".$d['fname']." ".$d['lname']."</b></a> isn't coming.<br />Reason: ".$d['diet']."</p>";
	}
}
?>
</div></div>
<?php
include "footer.php";
?>
