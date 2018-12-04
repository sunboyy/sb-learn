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
$stmt = $conn->prepare("SELECT * FROM `card` WHERE `id` = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$checkcard = $stmt->get_result();
if ($checkcard->num_rows == 1) {
	$data_checkcard = $checkcard->fetch_array();
	$lessonid = $data_checkcard['lesson'];
	$stmt = $conn->prepare("SELECT * FROM `lesson` WHERE `id` = ?");
	$stmt->bind_param("i", $lessonid);
	$stmt->execute();
	$checklesson = $stmt->get_result();
	$data_checklesson = $checklesson->fetch_array();
	if ($user['id'] == $data_checklesson['user_id']) {
		$stmt = $conn->prepare("UPDATE `card` SET `primary` = ?, `secondary` = ? WHERE `id` = ?");
		$stmt->bind_param("ssi", $pri, $sec, $id);
		$stmt->execute();
		header("Location: ../recallcard/manage.php?lesson=$lessonid");
	}
}
?>