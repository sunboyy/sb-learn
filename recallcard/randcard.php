<?php
require_once("../php/connect.php");

$type = $_POST['type'];
$last = $_POST['last'];
if ($type == "lesson") {
	$lessonid = $_POST['lesson'];
	$card = $conn->query("SELECT * FROM `card` WHERE `lesson` = '$lessonid' AND `id` != '$last'");
	$totalcard = $card->num_rows;
	$cardlist = array();
	while ($data_card = $card->fetch_array()) {
		array_push($cardlist, $data_card['id']);
	}
}
else if ($type == "group") {
	$groupid = $_POST['group'];
	$lesson = $conn->query("SELECT * FROM `lesson` WHERE `group` = '$groupid'");
	$lessonlist = array();
	while ($data_lesson = $lesson->fetch_array()) {
		array_push($lessonlist, $data_lesson['id']);
	}
	$totalcard = 0;
	$cardlist = array();
	foreach ($lessonlist as $v) {
		$card = $conn->query("SELECT * FROM `card` WHERE `lesson` = '$v' AND `id` != '$last'");
		$totalcard += $card->num_rows();
		while ($data_card = $card->fetch_array()) {
			array_push($cardlist, $data_card['id']);
		}
	}
}
$rand = rand(0, ($totalcard-1));
$cardid = $cardlist[$rand];
$getcard = $conn->query("SELECT * FROM `card` WHERE `id` = '$cardid'");
$data_getcard = $getcard->fetch_array();
echo $cardid."|||".$data_getcard['primary']."|||".$data_getcard['secondary'];
?>