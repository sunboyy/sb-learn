<?php

function getCardByLessonId($conn, $lessonId) {
    $stmt = $conn->prepare("SELECT * FROM `card` WHERE `lesson` = ?");
    $stmt->bind_param("i", $lessonId);
    $stmt->execute();
    return $stmt->get_result();
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
        $stmt->bind_param("i", $value);
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