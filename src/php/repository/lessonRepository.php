<?php

function getLessonById($conn, $id)
{
    $stmt = $conn->prepare("SELECT * FROM `group` WHERE `id` = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result();
}

function getLessonByGroupId($conn, $groupId)
{
    $stmt = $conn->prepare("SELECT * FROM `lesson` WHERE `group` = ?");
    $stmt->bind_param("i", $groupId);
    $stmt->execute();
    return $stmt->get_result();
}

function getLessonByGroupIdWithSorting($conn, $groupId)
{
    $stmt = $conn->prepare("SELECT * FROM `lesson` WHERE `group` = ? ORDER BY `id` ASC");
    $stmt->bind_param("i", $groupId);
    $stmt->execute();
    return $stmt->get_result();
}