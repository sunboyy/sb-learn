<?php
session_start();
if (empty($_SESSION['user'])) {
	header("Location: ../login.php");
}
require_once("../php/connect.php");
$usernow = mysql_query("SELECT * FROM `user` WHERE `id` = '{$_SESSION['user']}'");
$data_usernow = mysql_fetch_array($usernow);
$userid = $_SESSION['user'];

$cardid = $_GET['card'];
$card = mysql_query("SELECT * FROM `card` WHERE `id` = '$cardid'");
if (mysql_num_rows($card) == 1) {
	$data_card = mysql_fetch_array($card);
	$lessonid = $data_card['lesson'];
	$checklesson = mysql_query("SELECT * FROM `lesson` WHERE `id` = '$lessonid'");
	$data_checklesson = mysql_fetch_array($checklesson);
	if ($userid == $data_checklesson['user_id']) {
		mysql_query("DELETE FROM `card` WHERE `id` = $cardid");
	}
	header("Location: ../recallcard/manage.php?lesson=$lessonid");
}
?>