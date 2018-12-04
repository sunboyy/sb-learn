<?php
session_start();
require_once("main.php");
if (!$user) {
	header("Location: ../login.php");
}

if (isset($_POST['lessonid'])) {
	$id = trim($_POST['lessonid']);
	if ($id == "") {
		header("Location: ../recallcard/manage.php");
	}
}
else {
	header("Location: ../recallcard/manage.php");
}
if (isset($_POST['edit_name'])) {
	$name = trim($_POST['edit_name']);
	if ($name == "") {
		header("Location: ../recallcard/manage.php?lesson=".$id);
	}
}
else {
	header("Location: ../recallcard/manage.php");
}
$stmt = $conn->prepare("SELECT * FROM `lesson` WHERE `id` = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$checklesson = $stmt->get_result();
if ($checklesson->num_rows == 1) {
	$data_checklesson = $checklesson->fetch_array();
	if ($user['id'] == $data_checklesson['user_id']) {
		$stmt = $conn->prepare("UPDATE `lesson` SET `name` = ? WHERE `id` = ?");
		$stmt->bind_param("si", $name, $id);
		$stmt->execute();
		header("Location: ../recallcard/manage.php?lesson=$id");
	}
}

echo "OK";
?>