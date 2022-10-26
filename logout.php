<?php
require("masterutil.php");
$me->DestroySession();
header("Location: index.php");
die();