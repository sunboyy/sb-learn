<?php
require_once("main.php");
if (!$user) {
	header("Location: ../login.php");
}

$cardid = $_GET['card'];
$card = mysql_query("SELECT * FROM `card` WHERE `id` = '$cardid'");
if (mysql_num_rows($card) == 1) {
	$data_card = mysql_fetch_array($card);
	$lessonid = $data_card['lesson'];
	$checklesson = mysql_query("SELECT * FROM `lesson` WHERE `id` = '$lessonid'");
	$data_checklesson = mysql_fetch_array($checklesson);
	if ($user['id'] == $data_checklesson['user_id']) {
		mysql_query("DELETE FROM `card` WHERE `id` = $cardid");
	}
	header("Location: ../recallcard/manage.php?lesson=$lessonid");
}
?>