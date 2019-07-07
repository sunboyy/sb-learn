<?php
require_once("main.php");
if (!$user) {
	header("Location: ../login.php");
}

$cardid = $_GET['card'];
$card = get_card($cardid);
if (!empty($card)) {
	$lessonid = $card['lesson'];
	$lesson = get_lesson($lessonid);
	if (!empty($lesson) && $user['id'] == $lesson['user_id']) {
		$stmt = $conn->prepare("DELETE FROM `card` WHERE `id` = ?");
		$stmt->bind_param("i", $cardid);
		$stmt->execute();
	}
	header("Location: ../recallcard/manage.php?lesson=$lessonid");
}
?>