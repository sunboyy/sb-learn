<?php
session_start();
if (empty($_SESSION['user'])) {
	header("Location: ../login.php");
}
require_once("../php/connect.php");
$usernow = mysql_query("SELECT * FROM `user` WHERE `id` = '{$_SESSION['user']}'");
$data_usernow = mysql_fetch_array($usernow);
?>
<?php
$nowlessonid = $_GET['subj'];
$checklesson = mysql_query("SELECT * FROM `lesson` WHERE `id` = '$nowlessonid'");
if (mysql_num_rows($checklesson) == 1) {
	$onlesson = true;
	$data_checklesson = mysql_fetch_array($checklesson);
	$nowlesson = $data_checklesson['name'];
	$nowgroupid = $data_checklesson['group'];
	$checkgroup = mysql_query("SELECT * FROM `group` WHERE `id` = '$nowgroupid'");
	$data_checkgroup = mysql_fetch_array($checkgroup);
	$nowgroup = $data_checkgroup['name'];
	$checkcard = mysql_query("SELECT * FROM `card` WHERE `lesson` = '{$data_checklesson['id']}'");
	$num_checkcard = mysql_num_rows($checkcard);
	$checkowner = mysql_query("SELECT * FROM `user` WHERE `id` = '{$data_checklesson['user_id']}'");
	$data_checkowner = mysql_fetch_array($checkowner);
}
else {
	$onlesson = false;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>มุ่งสู่ห้อง K/Q ม.5 - Recall Card</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<center>
<table width="800" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2" align="center" valign="top"><div class="home_head" onclick="window.open('../index.php', '_self')"><img src="../images/title.png" width="287" height="46" /></div></td>
  </tr>
  <tr>
    <td width="300" align="center" valign="top" bgcolor="#66CC99"><div class="tabnow">Learning Review</div></td>
    <td width="500" align="center" valign="top"><div class="home_recallcard" onclick="window.open('recallcard/recallcard.php', '_self')">Recall card</div></td>
  </tr>
  <tr>
    <td align="left" valign="top" bgcolor="#99E6CC">
      <td align="left" valign="top">
        <?php if (!($onlesson)) { ?>
        <div class="recallcard_main">
          <h2>&lt;&lt;เลือกวิชาจากแถบด้านซ้าย</h2>
        </div>
        <?php } else if ($onlesson) { ?>
        <div class="recallcard_main">
          <h2>&nbsp;</h2>
        </div>
        <?php } ?>
      </td>
  </tr>
  <tr>
    <td align="left" valign="top" bgcolor="#000099">
      <div class="user_status">กำลังล็อกอินด้วยชื่อ: <?php echo "{$data_usernow['name']}"; ?></div>
      </td>
    <td align="right" valign="top" bgcolor="#000099">
      <div class="user_status" style="cursor: pointer;" onclick="window.open('../logout.php', '_self')">Logout</div>
      </td>
  </tr>
</table>
</center>
</body>
</html>