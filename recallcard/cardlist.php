<?php
require_once("../php/main.php");
if (!$user) {
	header("Location: ../login.php");
}
$theme = $user['theme'];
?>
<?php
$type = $_GET['type'];
if ($type == "lesson") {
	$lessonid = $_GET['lesson'];
	$card = mysql_query("SELECT * FROM `card` WHERE `lesson` = '$lessonid'");
	$totalcard = mysql_num_rows($card);
	$lessonlist = array($lessonid);
	$lesson = mysql_query("SELECT * FROM `lesson` WHERE `id` = '$lessonid'");
	$data_lesson = mysql_fetch_array($lesson);
	$group = mysql_query("SELECT * FROM `group` WHERE `id` = '{$data_lesson['group']}'");
	$data_group = mysql_fetch_array($group);
	$groupid = $data_group['id'];
	$id = $lessonid;
}
else if ($type == "group") {
	$groupid = $_GET['group'];
	$group = mysql_query("SELECT * FROM `group` WHERE `id` = '$groupid'");
	$data_group = mysql_fetch_array($group);
	$lesson = mysql_query("SELECT * FROM `lesson` WHERE `group` = '$groupid'");
	$num_lesson = mysql_num_rows($lesson);
	$card = mysql_query("SELECT * FROM `card` WHERE `group` = '$groupid' ORDER BY `primary` ASC");
	$totalcard = mysql_num_rows($card);
	$id = $groupid;
}
else if ($type == "selected") {
	$groupid = $_GET['group'];
	$selected = $_GET['selected'];
	$group = mysql_query("SELECT * FROM `group` WHERE `id` = '$groupid'");
	$data_group = mysql_fetch_array($group);
	$cardlist = explode("A", $selected);
	$totalcard = count($cardlist);
	$id = $groupid;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Recall card - Card List</title>
<link href="../css/main.css" rel="stylesheet" type="text/css" />
<link href="../css/main_<?php echo $theme; ?>.css" rel="stylesheet" type="text/css" />
<link href="../css/recallcard_popup.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript">
var thislist = '<?php echo $type; ?>', listid = '<?php echo $id; ?>', numopen = <?php echo $totalcard; ?>, groupid = '<?php echo $groupid; ?>', numopen = <?php echo $totalcard; ?>;
var totalcard = <?php echo $totalcard; ?>;
if (thislist == 'selected') {
	var selectedcode = '<?php if ($type == "selected") echo $selected; ?>';
}
</script>
<style>
p {
	margin: 5px;
	padding: 0px;
	font-weight: normal;
	text-decoration: none;
	letter-spacing: 0px;
	word-spacing: 1px;
}
</style>
</head>
<body>
<div id="loading">Loading...</div>
<table border="0" cellspacing="0" cellpadding="0" id="all">
  <tr>
    <td width="50" valign="middle">
	  <div id="menu" class="icon"><img src="../images/menu.png" height="50" width="50" /></div>
	</td>
	<td>
	  <div id="topbar">
	    <div id="wide"><img src="../images/rctitle.png" height="50" width="150" /></div><div class="icon close"><img src="../images/close.png" height="50" width="50" /></div>
	  </div>
	</td>
  </tr>
  <tr>
    <td>
	  <div id="sidebar">
	    <div class="icon table"><img src="../images/rctable_icon.png" height="50" width="50" /></div>
	    <div class="icon cards"><img src="../images/rccards_icon.png" height="50" width="50" /></div>
	    <div class="icon random"><img src="../images/rcrandom_icon.png" height="50" width="50" /></div>
	  </div>
	</td>
    <td>
	  <div id="main">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
		    <td>
			  <div id="cardlist_left">
		  <?php
		  if ($type == "selected") {
			foreach ($cardlist as $v) {
				$thiscard = mysql_query("SELECT * FROM `card` WHERE `id` = '$v'");
				$data_thiscard = mysql_fetch_array($thiscard); ?><div class="card">
			<table width="160" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td><div class="qatitle">คำถาม:</div><div class="qbox"><?php echo $data_thiscard['primary']; ?></div></td>
			  </tr>
			  <tr>
				<td><div class="qatitle">คำตอบ:</div><div class="abox dark" id="a_<?php echo $data_thiscard['id']; ?>" sec="<?php echo $data_thiscard['secondary']; ?>" show="true" cardid="<?php echo $data_thiscard['id']; ?>"></div></td>
			  </tr>
			</table>
		  </div>
			<?php
			}
		  }
		  if ($type == "group") {
			while ($data_thiscard = mysql_fetch_array($card)) { ?><div class="card">
			<table width="160" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td><div class="qatitle">คำถาม:</div><div class="qbox"><?php echo $data_thiscard['primary']; ?></div></td>
			  </tr>
			  <tr>
				<td><div class="qatitle">คำตอบ:</div><div class="abox dark" id="a_<?php echo $data_thiscard['id']; ?>" sec="<?php echo $data_thiscard['secondary']; ?>" show="true" cardid="<?php echo $data_thiscard['id']; ?>"></div></td>
			  </tr>
			</table>
		  </div>
			<?php
			}
		  }
		  else {
		  foreach ($lessonlist as $v) {
			  $thislesson = mysql_query("SELECT * FROM `card` WHERE `lesson` = '$v' ORDER BY `primary` ASC");
			  while ($data_thislesson = mysql_fetch_array($thislesson)) { ?><div class="card">
			<table width="160" border="0" cellspacing="0" cellpadding="0">
			  <tr>
				<td><div class="qatitle">คำถาม:</div><div class="qbox"><?php echo $data_thislesson['primary']; ?></div></td>
			  </tr>
			  <tr>
				<td><div class="qatitle">คำตอบ:</div><div class="abox dark" id="a_<?php echo $data_thislesson['id']; ?>" sec="<?php echo $data_thislesson['secondary']; ?>" show="true" cardid="<?php echo $data_thislesson['id']; ?>"></div></td>
			  </tr>
			</table>
		  </div><?php
			  }
		  }
		  }
		  ?>
              </div>
			</td>
			<td width="320">
			  <div id="popup_right">
			    <div class="title">กลุ่ม: <?php echo $data_group['name']; ?></div>
				<div class="textbox">
				  <?php if ($type == "lesson") { ?>
				  <h3>แบบฝึกหัด: <?php echo $data_lesson['name']; ?></h3>
				  <?php } else if ($type == "group") { ?>
				  <p>จำนวน: <?php echo $num_lesson; ?> แบบฝึกหัด</p>
				  <?php } ?>
				  <p>จำนวน: <?php echo $totalcard; ?> ข้อ</p>
				  <p>จำนวนป้ายที่ปิดอยู่: <span id="numopening"><?php echo $totalcard; ?></span> ข้อ <input type="button" id="btnGoSelect" value="Go" /></p>
				  <div class="popup_button" id="ahideall"><img src="../images/theme/<?php echo $theme; ?>/rc_hide.png" width="150" height="150" /></div><div class="popup_button" id="ashowall"><img src="../images/theme/<?php echo $theme; ?>/rc_show.png" width="150" height="150" /></div>
				</div>
			  </div>
			</td>
		  </tr>
		</table>
	  </div>
	</td>
  </tr>
</table>
<div id="hidsidebar">
  <div class="inhid table">ตารางคำศัพท์</div>
  <div class="inhid cards">การ์ดคำศัพท์</div>
  <div class="inhid random">สุ่มคำศัพท์</div>
</div>
<script type="text/javascript" src="../js/rc_popup.js"></script>
</body>
</html>