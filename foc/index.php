<?php
session_start();
// Admin pages

$pass = "3c2e5aec4065690915931758daf0f7ce";

if($_SERVER['QUERY_STRING'] == "logout") {
	$_SESSION['foc'] = false;
	$_SESSION['login_message'] = "Logged out successfully.";
} elseif($_SESSION['foc'] == "true") {
	header("Location: admin.php");
} elseif(md5($_POST['lpass']) == $pass) {
	$_SESSION['foc'] = "true";
	header("Location: admin.php");
} elseif($_POST['submit'] && md5($_POST['lpass']) != $pass) {
	$_SESSION['login_message'] = "Incorrect password. Try again!";
}

include_once("header.php");
?>
<center>
<div id="loginform">
	<h1>Welcome FOC</h1>
	<p>Please log in:</p>
	<?php
		if($_SESSION['login_message']) {
			echo "<p>".$_SESSION['login_message']."</p>";
			$_SESSION['login_message'] = "";
		}
	?>
	<form method="post" action="index.php">
	<input type="password" name="lpass" id="pass" /><input type="submit" id="submit" name="submit" value="Log in" />
	</form>
</div>
</center>
</body>
</html>
