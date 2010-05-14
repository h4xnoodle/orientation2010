<?php // For suggestion box
$s_one = rand(1,20);
$s_two = rand(5,31);
?>
<h2>Suggestion Box</h2>
<?php 
if($_SESSION['o_sug'] != "") {
	echo "<p style='font-weight:bold;'>".$_SESSION['o_sug']."</p>";
	unset($_SESSION['o_sug']);
}
?>
<p>Q: What should the aerial photo be this year?</p>
<form action="include/psuggestionbox.php" method="post">
	<input type="hidden" name="ans" value="<?php echo $s_one+$s_two; ?>" />
	<p><textarea name="idea"></textarea></p>
	<p><?php echo $s_one . " + ". $s_two; ?> is? <input type="text" style="width:40px;" name="anschk" /></p>
	<p><input type="submit" name="submit" value="Enter!" /></p>
</form>
