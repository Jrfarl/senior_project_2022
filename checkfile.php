<?php
require("masterutil.php");
if(!empty($_POST)){
	$exists = $me->DoesUsernameExist($_POST['input']);
}
?>
<?= isset($exists) ? "Exists  |  ".json_encode($exists) : "";?>
<form action="" method="post">
	<input name="input">
	<input type="submit">
</form>