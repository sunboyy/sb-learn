<?php
require_once("../php/main.php");
if (!$user) {
	header("Location: ../login.php");
}
$theme = $user['theme'];

$checkgroup = $conn->query("SELECT * FROM `group` ORDER BY `id` ASC");
if (isset($_GET['lesson'])) {
	$nowlessonid = $_GET['lesson'];
	$onlesson = true;
	
	$thislesson = $conn->query("SELECT * FROM `lesson` WHERE `id` = '$nowlessonid'");
	$data_thislesson = $thislesson->fetch_array();
	if ($data_thislesson['user_id'] != $user['id']) {
		header("Location: recallcard_lesson.php?lesson=$nowlessonid");
	}
	$groupid = $data_thislesson['group'];
	$numrows_thislesson = $thislesson->num_rows;
	$thisgroup = $conn->query("SELECT * FROM `group` WHERE `id` = '$groupid'");
	$data_thisgroup = $thisgroup->fetch_array();
	$nowgroupid = $data_thisgroup['id'];
	
	$card = $conn->query("SELECT * FROM `card` WHERE `lesson` = '$nowlessonid' ORDER BY `id` DESC");
	$numrows_card = $card->num_rows;
}
else {
	$onlesson = false;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Manage Lessons - Recall Card - <?php echo $title; ?></title>
<link href="../css/main.css" rel="stylesheet" type="text/css" />
<link href="../css/main_<?php echo $theme; ?>.css" rel="stylesheet" type="text/css" />
<link href="../css/loggedin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery.min.js"></script>
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
	    <div class="icon home"><img src="../images/home.png" height="50" width="50" /></div><div id="wide"><img src="../images/rctitle.png" height="50" width="150" /></div><div class="icon profile"><img src="../images/profile.png" height="50" width="50" /></div><div class="icon logout"><img src="../images/logout.png" height="50" width="50" /></div>
	  </div>
	</td>
  </tr>
  <tr>
    <td>
	  <div id="sidebar">
	    <div class="icon back"><img src="../images/back.png" height="50" width="50" /></div>
	    <div class="icon add"><img src="../images/add.png" height="50" width="50" /></div>
	    <div class="icon manage"><img src="../images/gear.png" height="50" width="50" /></div>
		<div class="high"></div>
	    <div class="icon info"><img src="../images/info.png" height="50" width="50" /></div>
	  </div>
	</td>
    <td>
	  <div id="main">
	    <table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
		    <td width="50%">
			  <div id="mainleft">
			    <div class="title">จัดการแบบฝึกหัด</div>
				  <?php while ($data_checkgroup = $checkgroup->fetch_array()) {
					$thisgroupid = $data_checkgroup['id'];
					$checklesson = $conn->query("SELECT * FROM `lesson` WHERE `group` = '$thisgroupid' AND `user_id` = '{$user['id']}' ORDER BY `id` ASC");
				  ?>
				  <div class="groupmenu" group="<?php echo $thisgroupid; ?>" page="manage"><?php echo $data_checkgroup['name']; ?></div>
				  <div class="lessongroup" group="<?php echo $thisgroupid; ?>" <?php if (($onlesson) && ($nowgroupid == $thisgroupid)) { ?>style="display: block;"<?php } ?>>
				    <?php while ($data_checklesson = $checklesson->fetch_array()) {?>
				    <div class="lessonlist<?php if (($onlesson) && ($nowlessonid == $data_checklesson['id'])) { echo " highlight"; } ?>" lesson="<?php echo $data_checklesson['id']; ?>"><?php echo $data_checklesson['name']; ?></div>
				    <?php } ?>
				  </div>
				<?php } ?>
		      </div>
			</td>
		    <td width="50%">
			  <div id="mainright">
			    <?php if ($onlesson) { ?>
			    <div class="title">กลุ่ม: <?php echo $data_thisgroup['name']; ?></div>
				<div class="textbox">
				  <h3>แบบฝึกหัด: <?php echo $data_thislesson['name']; ?> <img id="editname" src="../images/theme/<?php echo $theme; ?>/text_edit.png" width="20" height="20" lesson="<?php echo $data_thislesson['name']; ?>" class="texticon" /> <img id="gothis" src="../images/theme/<?php echo $theme; ?>/text_go.png" width="20" height="20" lesson="<?php echo $nowlessonid; ?>" class="texticon" /></h3>
				  <p>จำนวน: <?php echo $numrows_card ?> ข้อ</p>
				  <?php if ($numrows_card < 50) { ?>
				  <form name="addcardform" id="addcardform" method="post" action="../php/rc_addcard.php" >
				    <center>
				      <table border="0" cellspacing="0" cellpadding="5">
				        <tr>
					      <td align="right" valign="middle">คำ:</td>
					      <td align="left" valign="middle"><input type="text" name="add_pri" id="add_pri" maxlength="50" autofocus /></td>
						  <td align="left" valign="top" rowspan="3"><img src="../php/rc_effbar.php?num=<?php echo $numrows_card; ?>" width="16" height="83" /></td>
					    </tr>
				        <tr>
					      <td align="right" valign="middle">ความหมาย:</td>
					      <td align="left" valign="middle"><input type="text" name="add_sec" id="add_sec" maxlength="50" /></td>
					    </tr>
				        <tr>
					      <td><input type="hidden" name="add_lesson" value="<?php echo $nowlessonid; ?>" /></td>
					      <td align="left" valign="middle"><input type="button" name="btnAdd" id="btnAdd" value="เพิ่ม" /></td>
					    </tr>
				      </table>
					</center>
				  </form>
				  <?php } ?>
				</div>
				<table width="100%" border="0" cellspacing="0" cellpadding="2" id="managecard">
				  <tr align="center">
				    <td>#</td>
				    <td>คำ</td>
				    <td>ความหมาย</td>
				    <td width="50">จัดการ</td>
				  </tr>
				  <?php while ($data_card = $card->fetch_array()) { ?>
				  <tr>
				    <td width="50" align="left" valign="middle"><?php echo $data_card['id']; ?></td>
				    <td align="left" valign="middle"><?php echo $data_card['primary']; ?></td>
				    <td align="left" valign="middle"><?php echo $data_card['secondary']; ?></td>
				    <td align="right" valign="middle"><img class="editcard" card="<?php echo $data_card['id']; ?>" pri="<?php echo $data_card['primary']; ?>" sec="<?php echo $data_card['secondary']; ?>" src="../images/theme/<?php echo $theme; ?>/editicon.png" width="25" height="25" /><img class="delcard" card="<?php echo $data_card['id']; ?>" src="../images/theme/<?php echo $theme; ?>/deleteicon.png" width="25" height="25" /></td>
				  </tr>
				  <?php } ?>
				</table>
				<?php }?>
		      </div>
			</td>
		  </tr>
		</table>
	  </div>
	</td>
  </tr>
</table>
<div id="darkoutside">
  <div id="center">
    <form method="post" action="../php/rc_editlessonname.php" id="editnameform">
      <h3 align="left">แก้ไขชื่อแบบฝึกหัด</h3>
      <center>
        <table border="0" cellspacing="0" cellpadding="5">
	      <tr>
	        <td align="right" valign="middle">ชื่อแบบฝึกหัด:</td>
		    <td align="left" valign="middle"><input type="text" name="edit_name" id="edit_name" maxlength="25" placeholder="<?php echo $data_thislesson['name']; ?>" value="<?php echo $data_thislesson['name']; ?>" /></td>
	      </tr>
	      <tr>
	        <td><input type="hidden" name="lessonid" id="lessonid" value="<?php echo $nowlessonid; ?>" /></td>
		    <td align="left" valign="middle"><input type="button" name="btnEditName" id="btnEditName" value="แก้ไข" /> <input type="button" name="canceledit" class="canceledit" value="ยกเลิก" /></td>
	      </tr>
	    </table>
	  </center>
    </form>
    <form method="post" action="../php/rc_editcard.php" id="editcardform">
      <h3 align="left">แก้ไขการ์ดหมายเลข <span id="cardid_show"></span></h3>
      <center>
        <table border="0" cellspacing="0" cellpadding="5">
	      <tr>
	        <td align="right" valign="middle">คำ:</td>
		    <td align="left" valign="middle"><input type="text" name="edit_pri" id="edit_pri" maxlength="50" placeholder="" value="" /></td>
	      </tr>
	      <tr>
	        <td align="right" valign="middle">ความหมาย:</td>
		    <td align="left" valign="middle"><input type="text" name="edit_sec" id="edit_sec" maxlength="50" placeholder="" value="" /></td>
	      </tr>
	      <tr>
	        <td><input type="hidden" name="edit_id" id="edit_id" value="" /></td>
		    <td align="left" valign="middle"><input type="button" name="btnEditCard" id="btnEditCard" value="แก้ไข" /> <input type="button" name="canceledit" class="canceledit" value="ยกเลิก" /></td>
	      </tr>
	    </table>
	  </center>
    </form>
  </div>
</div>
<div id="hidsidebar">
  <div class="inhid back">Back</div>
  <div class="inhid add">New lesson</div>
  <div class="inhid manage">Manage</div>
  <div class="high"></div>
  <div class="inhid info">Info</div>
</div>
<script type="text/javascript" src="../js/main.js"></script>
<script type="text/javascript" src="../js/rc_manage.js"></script>
</body>
</html>
