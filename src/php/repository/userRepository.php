<?php

function getUserById($conn, $userId)
{
    $stmt = $conn->prepare("SELECT * FROM `user` WHERE `id` = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    return $stmt->get_result();
}