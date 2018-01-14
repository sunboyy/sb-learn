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
		$checklesson = $conn->query("SELECT * FROM `lesson` WHERE `id` = '$lessonid' AND `user_id` = '{$user['id']}'");
		if ($checklesson->num_rows == 1) {
			$data_checklesson = $checklesson->fetch_array();
			$conn->query("INSERT INTO `card` VALUES ('', '$pri', '$sec', '$lessonid', '{$data_checklesson['group']}')");
			header("Location: ../recallcard/manage.php?lesson=$lessonid");
		}
	}
}
?>