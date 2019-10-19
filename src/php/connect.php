<?php
include("config.php");
$conn = new mysqli($database_server, $database_username, $database_password, $database_name);
$conn->query("SET NAMES UTF8");
?>