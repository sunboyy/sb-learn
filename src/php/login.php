<?php
require_once("main.php");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("HTTP/1.1 404 Not Found");
    exit;
}

$password = $_POST['pwd'];

$stmt = $conn->prepare("SELECT * FROM `user` WHERE `pwd` = ?");
$stmt->bind_param("s", $password);
$stmt->execute();

header("Content-Type: application/json");
$user = $stmt->get_result();
if ($user->num_rows == 0) {
    echo "{\"error\":1,\"msg\":\"Incorrect Password\"}";
} else {
    $data_user = $user->fetch_array();
    $_SESSION['user'] = $data_user['id'];
    echo "{\"error\":0}";
}
