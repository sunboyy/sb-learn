<?php
require_once("../php/main.php");
require_once("core.php");
if (!$user) {
	header("Location: ../login.php");
}
$theme = $user['theme'];

$type = $_GET['type'];
$getid = $_GET['id'];
if ($type == "lesson" || $type == "group" || $type == "selected") {
	$close = false;
	if ($type == "selected") {
		$carddata = get_cards($type, explode("A", $_GET['selected']));
	}
	else {
		$carddata = get_cards($type, $getid);
	}
}
else {
	$close = true;
}
if ($type == "lesson") {
	$lesson = get_lesson($getid);
	$group = $conn->query("SELECT * FROM `group` WHERE `id` = '{$lesson['group']}'");
	$data_group = $group->fetch_array();
	$groupid = $data_group['id'];
}
else if ($type == "group") {
	$group = $conn->query("SELECT * FROM `group` WHERE `id` = '$getid'");
	$data_group = $group->fetch_array();
	$lesson = $conn->query("SELECT * FROM `lesson` WHERE `group` = '$getid'");
	$num_lesson = $lesson->num_rows;
	$groupid = $_GET['id'];
}
else if ($type = "selected") {
	$group = $conn->query("SELECT * FROM `group` WHERE `id` = '$getid'");
	$data_group = $group->fetch_array();
	$groupid = $_GET['id'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Card List - Recall Card - <?php echo $title; ?></title>
<link href="../css/main.css" rel="stylesheet" type="text/css" />
<link href="../css/main_<?php echo $theme; ?>.css" rel="stylesheet" type="text/css" />
<link href="../css/recallcard_popup.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script type="text/javascript">
var numopen = <?php echo count($carddata); ?>, groupid = '<?php echo $groupid; ?>';
var totalcard = <?php echo count($carddata); ?>;
<?php if ($type == "selected") { ?>
var selectedcode = '<?php if ($type == "selected") echo $_GET['selected']; ?>';
<?php } ?>
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
					<?php foreach ($carddata as $v) { ?>
		  		<div class="card">
						<table width="160" border="0" cellspacing="0" cellpadding="0">
							<tr>
							<td><div class="qatitle">คำถาม:</div><div class="qbox"><?php echo $v['primary']; ?></div></td>
							</tr>
							<tr>
							<td><div class="qatitle">คำตอบ:</div><div class="abox dark" id="a_<?php echo $v['id']; ?>" sec="<?php echo $v['secondary']; ?>" show="true" cardid="<?php echo $v['id']; ?>"></div></td>
							</tr>
						</table>
					</div>
					<?php } ?>
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
				  <p>จำนวน: <?php echo count($carddata); ?> ข้อ</p>
				  <p>จำนวนป้ายที่ปิดอยู่: <span id="numopening"><?php echo count($carddata); ?></span> ข้อ <input type="button" id="btnGoSelect" value="Go" /></p>
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
