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
$lesson = get_lesson($id);
if (!empty($lesson) && $user['id'] == $lesson['user_id']) {
	$stmt = $conn->prepare("UPDATE `lesson` SET `name` = ? WHERE `id` = ?");
	$stmt->bind_param("si", $name, $id);
	$stmt->execute();
	header("Location: ../recallcard/manage.php?lesson=$id");
}
?>