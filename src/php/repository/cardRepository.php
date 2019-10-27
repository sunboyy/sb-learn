<?php

function getCardByLessonId($conn, $lessonId) {
    $stmt = $conn->prepare("SELECT * FROM `card` WHERE `lesson` = ?");
    $stmt->bind_param("i", $lessonId);
    $stmt->execute();
    return $stmt->get_result();
}