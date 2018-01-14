<?php
session_start();
if (empty($_SESSION['user'])) {
	header("Location: ../login.php");
}
require_once("../php/connect.php");
$usernow = mysql_query("SELECT * FROM `user` WHERE `id` = '{$_SESSION['user']}'");
$data_usernow = mysql_fetch_array($usernow);
$theme = $data_usernow['theme'];

$img_bg = imagecreatefrompng("../images/theme/$theme/effbar.png");
$img_arrow = imagecreatefrompng("../images/theme/$theme/miniarrow.png");

$green = imagecolorallocate($img_bg, 0, 255, 0);

$x = 10;
$y = ($_GET['num'])*3;
imagecolortransparent($img_arrow, $green);
imagecopymerge($img_bg, $img_arrow, $x, $y, 0, 0, 32, 16, 100);
imagecolortransparent($img_bg, $green);
imagePng($img_bg);
header("Content-type: image/png");
?>