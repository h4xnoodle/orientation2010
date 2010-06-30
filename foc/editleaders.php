<?php

session_start();

if($_SESSION['foc'] == true) {
	include "functions.php";
	include "header.php";

	function filterLeaders($opts) {
		print_r($opts);

	}

	function markAsPaid($lid) {

	}

	function trashLeader($lid) {
		
	}

	function showFilterForm($type) {
		switch($type) {
			case 'bulk':
				echo "<p><b>Bulk mode.</b> Edit any field of leaders filtered, and press submit when done.</p>";
				break;
			case 'trash':
				echo "<p>File leaders as <b>'trashed'</b> or <b>'removed'</b>.</p>";
				break;
			case 'paid':
				echo "<p>Mark leaders as <b>'paid'</b>.</p>";
				break;
		}
		echo "<p>The '%' is the wildcard. *Names implies all of: first, last, preferred, uw username.</p>";
		echo "<p>If no filters are given, all leaders will be returned or if in paid/trash mode, leaders who are not paid and are leaders.</p>";
		echo "<h2>Filter</h2>";
		echo "<form method='post' action='".$_SERVER['PHP_SELF']."'>";
		echo "<p><input type='hidden' name='filter_type' value='".$type."' /></p>";
		echo "<p>Filter names*: <input type='text' name='names' /></p>";
		echo "<p>By UW IDs (comma separated list)<br /><textarea name='uwids' cols='20' rows='5'></textarea></p>";
		echo "<p><input type='submit' name='".$type."' value='Filter' /></p></form>";
	}

	if($_POST['filter_type']) {
		$opts['type'] = $_POST['filter_type'];
		$opts['names'] = $_POST['names'];
		$opts['uwids'] = $_POST['uwids'];
		filterLeaders($opts);
	} elseif($_POST['action_type']) {
		switch($_POST['action_type']) {
			case 'paid':

				break;
			case 'trash':

				break;
		}
	}

	switch($_SERVER['QUERY_STRING']) {
		case 'markpaid':
			echo "<h1>Mark Leaders as Paid</h1>";
			echo "<p>Coming soon</p>";
			//showFilterForm('paid');
			break;
		case 'trash':
			echo "<h1>Remove a Leader</h1>";
			echo "<p>Coming soon</p>";
			//showFilterForm('trash');
			break;
		default:
			echo "<h1>Bulk Edit Leaders</h1>";
			echo "<p>Coming soon</p>";
			//showFilterForm('bulk');
	}
	include "footer.php";
} else {
	header('Location: index.php');
}
?>
