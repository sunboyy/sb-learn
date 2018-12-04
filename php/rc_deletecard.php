<?php
require_once("main.php");
if (!$user) {
	header("Location: ../login.php");
}

$cardid = $_GET['card'];
$card = $conn->query("SELECT * FROM `card` WHERE `id` = '$cardid'");
if ($card->num_rows == 1) {
	$data_card = $card->fetch_array();
	$lessonid = $data_card['lesson'];
	$checklesson = $conn->query("SELECT * FROM `lesson` WHERE `id` = '$lessonid'");
	$data_checklesson = $checklesson->fetch_array();
	if ($user['id'] == $data_checklesson['user_id']) {
		$stmt = $conn->prepare("DELETE FROM `card` WHERE `id` = ?");
		$stmt->bind_param("i", $cardid);
		$stmt->execute();
	}
	header("Location: ../recallcard/manage.php?lesson=$lessonid");
}
?>