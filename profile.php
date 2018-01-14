<?php
session_start();
if (empty($_SESSION['user'])) {
	header("Location: login.php");
}
require_once("php/connect.php");
$usernow = mysql_query("SELECT * FROM `user` WHERE `id` = '{$_SESSION['user']}'");
$data_usernow = mysql_fetch_array($usernow);
$user_id = $_SESSION['user'];
$theme = $data_usernow['theme'];
if ($theme == "light") {
	$newtheme = "dark";
}
else if ($theme == "dark") {
	$newtheme = "light";
}
mysql_query("UPDATE `user` SET `theme` = '$newtheme' WHERE `id` = $user_id;");
header("Location: ".$_GET['from']);
?>
<?php require_once('../Connections/edu.php'); ?>
<?php

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>มุ่งสู่ห้อง K/Q ม.5 - Recall Card</title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/main_<?php echo $theme; ?>.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<script>
function preload() {
	var gidnow = <?php echo $data_checkgroup['id']; ?>;
	$('#gid_tab_'+gidnow).show();
}
</script>
</head>

<body onload="preload()">
<div id="loading">Loading...</div>
<table border="0" cellspacing="0" cellpadding="0" id="all">
  <tr>
    <td width="50" valign="middle">
	  <div id="menu" class="icon"><img src="images/menu.png" height="50" width="50" /></div>
	</td>
	<td>
	  <div id="topbar">
	    <div class="icon home"><img src="images/home.png" height="50" width="50" /></div><div id="wide"><img src="images/rctitle.png" height="50" width="150" /></div><div class="icon logout"><img src="images/logout.png" height="50" width="50" /></div>
	  </div>
	</td>
  </tr>
  <tr>
    <td>
	  <div id="sidebar">
	    <div class="icon back"><img src="images/back.png" height="50" width="50" /></div>
	    <div class="icon add"><img src="images/add.png" height="50" width="50" /></div>
	    <div class="icon manage"><img src="images/gear.png" height="50" width="50" /></div>
		<div class="high"></div>
	    <div class="icon info"><img src="images/info.png" height="50" width="50" /></div>
	  </div>
	</td>
    <td>
	  <div id="main">
	    <table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
		    <td width="50%">
			  <div id="mainleft">
			    <div class="title">จัดการแบบฝึกหัด</div>
		      </div>
			</td>
		    <td width="50%">
			  <div id="mainright">
		      </div>
			</td>
		  </tr>
		</table>
	  </div>
	</td>
  </tr>
</table>
<div id="hidsidebar">
  <div class="inhid back">Back</div>
  <div class="inhid add">New lesson</div>
  <div class="inhid manage">Manage</div>
  <div class="high"></div>
  <div class="inhid info">Info</div>
</div>
<script type="text/javascript" src="js/main.js"></script>
</body>
</html>
