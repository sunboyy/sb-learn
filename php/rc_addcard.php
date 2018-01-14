<?php
require_once("main.php");
if (!$user) {
	header("Location: ../login.php");
}

if (trim($_POST['add_lesson']) != "") {
	$lessonid = $_POST['add_lesson'];
	$pri = trim($_POST['add_pri']);
	$sec = trim($_POST['add_sec']);
	if (($pri != "") && ($sec != "")) {
		$checklesson = mysql_query("SELECT * FROM `lesson` WHERE `id` = '$lessonid' AND `user_id` = '{$user['id']}'");
		if (mysql_num_rows($checklesson) == 1) {
			$data_checklesson = mysql_fetch_array($checklesson);
			mysql_query("INSERT INTO `card` VALUES ('', '$pri', '$sec', '$lessonid', '{$data_checklesson['group']}')");
			header("Location: ../recallcard/manage.php?lesson=$lessonid");
		}
	}
}
?>