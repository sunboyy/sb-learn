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
$checklesson = $conn->query("SELECT * FROM `lesson` WHERE `id` = '$id'");
if ($checklesson->num_rows == 1) {
	$data_checklesson = $checklesson->fetch_array();
	if ($user['id'] == $data_checklesson['user_id']) {
		$conn->query("UPDATE `lesson` SET `name` = '$name' WHERE `id` = $id");
		header("Location: ../recallcard/manage.php?lesson=$id");
	}
}

echo "OK";
?>