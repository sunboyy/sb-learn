<?php
require_once("../php/connect.php");
$card = mysql_query("SELECT * FROM `card`");
while ($data_card = mysql_fetch_array($card)) {
	$cardid = $data_card['id'];
	$lesson = mysql_query("SELECT `group` FROM `lesson` WHERE `id` = '".$data_card['lesson']."';");
	$data_lesson = mysql_fetch_array($lesson);
	$group = $data_lesson['group'];
	mysql_query("UPDATE `card` SET `group` = '$group' WHERE `id` = '$cardid';");
	echo "SET $cardid to $group completed.\n";
}
echo "Success!";
?>