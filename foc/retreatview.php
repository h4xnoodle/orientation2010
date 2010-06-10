<?php

// Retreat confirmation viewing
session_start();
include "functions.php";
include "header.php";
echo "<h1>Retreat Confirmation Viewer</h1>";
echo "<p>View leaders who have said yes and no (with reasons!)</p>";

$confirmations = getRetreatConfs(true);
$denied = getRetreatConfs(false);
$total = getNumLeaders();

echo "<p>Out of <b>".$total."</b> leaders, <b>".count($confirmations)."</b> said they were attending, and <b>".count($denied)."</b> said they weren't.</p>";
echo "<hr />";
echo "<pre>";
print_r($confirmations);
print_r($denied);
echo "</pre>";

include "footer.php";
?>