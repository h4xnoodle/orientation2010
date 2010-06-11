<?php
// Retreat confirmation form
include "header.php";
?>
<h1>Orientation Leader Retreat Confirmation</h1>
<p>You're invited to Math Orientation's Leader Retreat!</p>
<p style="text-align:center;color:#f2448a;">
Date: Saturday, July 10th<br />
Time: 8:15 am sign in<br />
Location: MC 3rd floor (outside the Comfy)<br />
</p>
<p>Please provide the following information to confirm your attendance.</p>
<hr />
<form method="post" action="include/retreat_process.php">
	<p>UW Student Number (ex. 202XXXXX): <input type="text" name="uwid" maxlength="8" /></p>
	<p>Please provide your <em>last name</em> (as entered on your application): <input type="text" name="lname" /></p>
	<p>Are you coming to the retreat?: <input type="radio" name="confirm" value=1 checked="true" /> YES! <input type="radio" name="confirm" value=0 /> NO :(</p>
	<p>If you are attending, please list any dietary restrictions, as there will be food. If you are not attending, please give a reason why. This cannot be left blank if you are <em>not</em> attending.</p>
	<p><textarea name="reason" style="width:60%;height:120px;"></textarea></p>
	<p><input type="submit" name="submit" value="Confirm Attendance" /></p>
	<p style="font-size:70%;">If you need to adjust the information later, please send an email to <a href="mailto:orientat@math.uwaterloo.ca">orientat@math.uwaterloo.ca</a></p>
</form>

<?php 
include "footer.php";
?>
