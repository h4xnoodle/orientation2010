<?php

include "header.php";

?>
<h1>Choose Your Leader Gear Sizes</h1>
<p>Please provide the information required below, and choose your sizes for leader gear.</p>
<p><b>NOTE:</b> Sizings for other leader gear besides the DriFit shirt will be taken at the retreat.</p>

<form method="post" action="include/leader_sizes_process.php">
<p>UWID (ie 20201337): <input type="text" name="uwid" /></p>
<p>Lastname (as you entered on the application): <input type="text" name="lname" /></p>
<p>DriFit T-Shirt size:</p>
<p>Women's<br /> <input type="radio" name="shirt" value="w_XS" /> XS <br />
<input type="radio" name="shirt" value="w_S" /> S <br />
<input type="radio" name="shirt" value="w_M" /> M <br />
<input type="radio" name="shirt" value="w_L" /> L<br />
<input type="radio" name="shirt" value="w_XL" /> XL <br />
<input type="radio" name="shirt" value="w_XXL" /> XXL<br />
<input type="radio" name="shirt" value="w_3X" /> 3X
</p>
<p>Men's: <br /><input type="radio" name="shirt" value="m_XS" /> XS <br />
<input type="radio" name="shirt" value="m_S" /> S <br />
<input type="radio" name="shirt" value="m_M" /> M <br />
<input type="radio" name="shirt" value="m_L" /> L <br />
<input type="radio" name="shirt" value="m_XL" /> XL<br />
<input type="radio" name="shirt" value="m_XXL" /> XXL<br />
<input type="radio" name="shirt" value="m_3X" /> 3X <br />
<input type="radio" name="shirt" value="m_4X" /> 4X <br />
<input type="radio" name="shirt" value="m_5X" /> 5X
</p>

<p><input type="submit" name="submit" value="Submit your size" /></p>
</form>

<?php
include "footer.php";
?>
