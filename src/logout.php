<?php
require_once("php/main.php");
if ($user) {
	$_SESSION['user'] = NULL;
	unset($_SESSION['user']);
}
header("Location: login.php");
?>