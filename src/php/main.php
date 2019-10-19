<?php
require_once("connect.php");
session_start();
$user = null;
function check_user() {
    global $conn, $user;
    if (empty($_SESSION['user'])) return;
    $stmt = $conn->prepare("SELECT * FROM `user` WHERE `id` = ?");
    $stmt->bind_param("i", $_SESSION['user']);
    $stmt->execute();
    $usernow = $stmt->get_result();
    if ($usernow->num_rows != 1) return;
    $data_usernow = $usernow->fetch_array();
    $user = $data_usernow;
}
function get_lesson($lessonid) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM `lesson` WHERE `id` = ?");
    $stmt->bind_param("i", $lessonid);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        return $result->fetch_array();
    } else {
        return null;
    }
}
function get_card($cardid) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM `card` WHERE `id` = ?");
	$stmt->bind_param("i", $cardid);
	$stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 1) {
        return $result->fetch_array();
    } else {
        return null;
    }
}
check_user();
?>