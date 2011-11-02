<?php
ignore_user_abort();
require('functions.php');
$allowed = array('run','show','save');
if(isset($_GET['f']) && in_array($_GET['f'], $allowed)) {
	echo call_user_func($_GET['f']);
}

?>
