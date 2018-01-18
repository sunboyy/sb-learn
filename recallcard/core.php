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
    $sql_lessons = "SELECT * FROM `lesson` WHERE `group` = $group ORDER BY `id` ASC";
    $qry_lessons = $conn->query($sql_lessons);
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
        $sql_cards = "SELECT * FROM `card` WHERE `group` = $value";
        $qry_cards = $conn->query($sql_cards);
        while ($row_cards = $qry_cards->fetch_array()) {
            array_push($cards, $row_cards);
        }
    }
    else if ($type == "lesson") {
        $sql_cards = "SELECT * FROM `card` WHERE `lesson` = $value";
        $qry_cards = $conn->query($sql_cards);
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