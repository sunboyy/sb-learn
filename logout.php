<?php
session_start();
if (isset($_SESSION['user'])) {
	$userid = $_SESSION['user'];
	require_once("php/connect.php");
	$usernow = mysql_query("SELECT * FROM `user` WHERE `id` = '$userid';");
	$data_usernow = mysql_fetch_array($usernow);
}
$_SESSION['user'] = NULL;
unset($_SESSION['user']);
header("Location: login.php");
?>