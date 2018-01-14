<?php
require_once("main.php");
if (!$user) {
	header("Location: ../login.php");
}

if (isset($_POST['edit_id'])) {
	$id = trim($_POST['edit_id']);
	if ($id == "") {
		header("Location: ../recallcard/manage.php");
	}
}
else {
	header("Location: ../recallcard/manage.php");
}
if (isset($_POST['edit_pri'])) {
	$pri = trim($_POST['edit_pri']);
	if ($pri == "") {
		header("Location: ../recallcard/manage.php");
	}
}
else {
	header("Location: ../recallcard/manage.php");
}
if (isset($_POST['edit_sec'])) {
	$sec = trim($_POST['edit_sec']);
	if ($sec == "") {
		header("Location: ../recallcard/manage.php");
	}
}
else {
	header("Location: ../recallcard/manage.php");
}
$checkcard = $conn->query("SELECT * FROM `card` WHERE `id` = '$id'");
if ($checkcard->num_rows == 1) {
	$data_checkcard = $checkcard->fetch_array();
	$lessonid = $data_checkcard['lesson'];
	$checklesson = $conn->query("SELECT * FROM `lesson` WHERE `id` = '$lessonid'");
	$data_checklesson = $checklesson->fetch_array();
	if ($user['id'] == $data_checklesson['user_id']) {
		$conn->query("UPDATE `card` SET `primary` = '$pri', `secondary` = '$sec' WHERE `id` = $id");
		header("Location: ../recallcard/manage.php?lesson=$lessonid");
	}
}
?>