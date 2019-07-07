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
$card = get_card($id);
if (!empty($card)) {
	$lessonid = $card['lesson'];
	$lesson = get_lesson($lessonid);
	if (!empty($lesson) && $user['id'] == $lesson['user_id']) {
		$stmt = $conn->prepare("UPDATE `card` SET `primary` = ?, `secondary` = ? WHERE `id` = ?");
		$stmt->bind_param("ssi", $pri, $sec, $id);
		$stmt->execute();
		header("Location: ../recallcard/manage.php?lesson=$lessonid");
	}
}
?>