<?php
require_once("../php/connect.php");
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
function get_lessons($group) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM `lesson` WHERE `group` = ? ORDER BY `id` ASC");
    $stmt->bind_param("i", $group);
    $stmt->execute();
    $qry_lessons = $stmt->get_result();
    $lessons = array();
    while ($row_lessons = $qry_lessons->fetch_array()) {
        array_push($lessons, $row_lessons);
    }
    return $lessons;
}
function get_cards($type, $value) {
    global $conn;
    $cards = array();
    if ($type == "group") {
        $stmt = $conn->prepare("SELECT * FROM `card` WHERE `group` = ?");
        $stmt->bind_param("i", $value);
        $stmt->execute();
        $qry_cards = $stmt->get_result();
        while ($row_cards = $qry_cards->fetch_array()) {
            array_push($cards, $row_cards);
        }
    }
    else if ($type == "lesson") {
        $stmt = $conn->prepare("SELECT * FROM `card` WHERE `lesson` = ?");
        $stmt->bind_param("s", $value);
        $stmt->execute();
        $qry_cards = $stmt->get_result();
        while ($row_cards = $qry_cards->fetch_array()) {
            array_push($cards, $row_cards);
        }
    }
    else if ($type == "selected") {
        foreach ($value as $v) {
            $sql_card = "SELECT * FROM `card` WHERE `id` = $v";
            $qry_card = $conn->query($sql_card);
            if ($qry_card->num_rows == 1) {
                $row_card = $qry_card->fetch_array();
                array_push($cards, $row_card);
            }
        }
    }
    return $cards;
}
?>
