<?php
require_once("../php/connect.php");

$type = $_POST['type'];
$last = $_POST['last'];
if ($type == "lesson") {
	$lessonid = $_POST['lesson'];
	$card = mysql_query("SELECT * FROM `card` WHERE `lesson` = '$lessonid' AND `id` != '$last'");
	$totalcard = mysql_num_rows($card);
	$cardlist = array();
	while ($data_card = mysql_fetch_array($card)) {
		array_push($cardlist, $data_card['id']);
	}
}
else if ($type == "group") {
	$groupid = $_POST['group'];
	$lesson = mysql_query("SELECT * FROM `lesson` WHERE `group` = '$groupid'");
	$lessonlist = array();
	while ($data_lesson = mysql_fetch_array($lesson)) {
		array_push($lessonlist, $data_lesson['id']);
	}
	$totalcard = 0;
	$cardlist = array();
	foreach ($lessonlist as $v) {
		$card = mysql_query("SELECT * FROM `card` WHERE `lesson` = '$v' AND `id` != '$last'");
		$totalcard += mysql_num_rows($card);
		while ($data_card = mysql_fetch_array($card)) {
			array_push($cardlist, $data_card['id']);
		}
	}
}
$rand = rand(0, ($totalcard-1));
$cardid = $cardlist[$rand];
$getcard = mysql_query("SELECT * FROM `card` WHERE `id` = '$cardid'");
$data_getcard = mysql_fetch_array($getcard);
echo $cardid."|||".$data_getcard['primary']."|||".$data_getcard['secondary'];
?>