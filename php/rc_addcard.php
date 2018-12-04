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
		$stmt = $conn->prepare("SELECT * FROM `lesson` WHERE `id` = ? AND `user_id` = ?");
		$stmt->bind_param("ss", $lessonid, $user['id']);
		$stmt->execute();
		$checklesson = $stmt->get_result();
		if ($checklesson->num_rows == 1) {
			$data_checklesson = $checklesson->fetch_array();
			$stmt = $conn->prepare("INSERT INTO `card` VALUES (0, ?, ?, ?, ?)");
			$stmt->bind_param("ssss", $pri, $sec, $lessonid, $data_checklesson['group']);
			$stmt->execute();
			header("Location: ../recallcard/manage.php?lesson=$lessonid");
		}
	}
}
?>