<?php
session_start();
if (empty($_SESSION['user'])) {
	header("Location: ../login.php");
}
require_once("../php/connect.php");
$usernow = mysql_query("SELECT * FROM `user` WHERE `id` = '{$_SESSION['user']}'");
$data_usernow = mysql_fetch_array($usernow);
$userid = $_SESSION['user'];

if (trim($_POST['add_lesson']) != "") {
	$lessonid = $_POST['add_lesson'];
	$pri = trim($_POST['add_pri']);
	$sec = trim($_POST['add_sec']);
	if (($pri != "") && ($sec != "")) {
		$checklesson = mysql_query("SELECT * FROM `lesson` WHERE `id` = '$lessonid' AND `user_id` = '$userid'");
		if (mysql_num_rows($checklesson) == 1) {
			$data_checklesson = mysql_fetch_array($checklesson);
			mysql_query("INSERT INTO `card` VALUES ('', '$pri', '$sec', '$lessonid', '{$data_checklesson['group']}')");
			header("Location: ../recallcard/manage.php?lesson=$lessonid");
		}
	}
}
?>