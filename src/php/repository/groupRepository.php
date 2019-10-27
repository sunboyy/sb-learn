<?php

function getGroupById($conn, $id)
{
    $stmt = $conn->prepare("SELECT * FROM `group` WHERE `id` = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result();
}