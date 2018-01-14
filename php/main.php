<?php
require_once("connect.php");
session_start();
$user = null;
function check_user() {
    global $conn, $user;
    if (empty($_SESSION['user'])) return;
    $usernow = $conn->query("SELECT * FROM `user` WHERE `id` = '{$_SESSION['user']}'");
    if ($usernow->num_rows != 1) return;
    $data_usernow = $usernow->fetch_array();
    $user = $data_usernow;
}
check_user();
?>