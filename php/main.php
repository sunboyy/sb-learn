<?php
require_once("connect.php");
session_start();
$user = null;
function check_user() {
    if (empty($_SESSION['user'])) return;
    $usernow = mysql_query("SELECT * FROM `user` WHERE `id` = '{$_SESSION['user']}'");
    if (mysql_num_rows($usernow) != 1) return;
    $data_usernow = mysql_fetch_array($usernow);
    global $user;
    $user = $data_usernow;
}
check_user();
?>