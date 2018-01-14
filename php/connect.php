<?php
include("config.php");
$edu = mysql_connect($database_server, $database_username, $database_password);
mysql_select_db($database_name);
mysql_query("SET NAMES UTF8");
?>