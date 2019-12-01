<?php

function get_groups() {
    global $conn;
    $sql_groups = "SELECT * FROM `group` ORDER BY `id` ASC";
    $qry_groups = $conn->query($sql_groups);
    $groups = array();
    while ($row_groups = $qry_groups->fetch_array()) {
        array_push($groups, $row_groups);
    }
    return $groups;
}


function getGroupById($conn, $id)
{
    $stmt = $conn->prepare("SELECT * FROM `group` WHERE `id` = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result();
}