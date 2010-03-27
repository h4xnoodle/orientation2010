<?php
session_start();
// Admin pages

$pass = "3c2e5aec4065690915931758daf0f7ce";

if($_SESSION['foc'] == "true") {
	header("Location: admin.php");
}
elseif(md5($_POST['lpass']) == $pass) {
	session_start();
	$_SESSION['foc'] = "true";
	header("Location: admin.php");
}

include_once("header.php");
?>
<p>Hello, please log in:</p>
<form method="post" action="index.php">
<input type="password" name="lpass" id="pass" />
<br /><input type="submit" id="submit" name="submit" value="Log in" />
</form>
<?php
include_once("footer.php");
?>
