<?php
include("config.php");
$conn = new mysqli($database_server, $database_username, $database_password, $database_name);
// $edu = mysql_connect($database_server, $database_username, $database_password);
// mysql_select_db($database_name);
$conn->query("SET NAMES UTF8");
?>