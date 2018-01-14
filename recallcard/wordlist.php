<?php
require_once("../php/main.php");
if (!$user) {
	header("Location: ../login.php");
}
$theme = $user['theme'];

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
$numcardnow = 1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Recall card - Word List</title>
<link href="../css/main.css" rel="stylesheet" type="text/css" />
<link href="../css/main_<?php echo $theme; ?>.css" rel="stylesheet" type="text/css" />
<link href="../css/recallcard_popup.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script type="text/javascript">
var groupid = '<?php echo $groupid; ?>', thislist = '<?php echo $type; ?>', listid = '<?php echo $id; ?>', theme = '<?php echo $theme; ?>', state, numcheck = 0, totalcard = <?php echo $totalcard; ?>, lastselected = '0000', pad = '0000';
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
#showcheckp {
	display: none;
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
			  <div id="wordlist_left">
	  		    <table width="100%" border="0" cellspacing="0" cellpadding="4" id="cardtable">
		          <tr>
			        <td width="24" align="center"><img class="checkall" state="no" cardid="$v" src="../images/theme/<?php echo $theme; ?>/unchecked.png" width="24" height="24" /></td>
			        <td align="center" class="pricol">คำ</td>
			        <td align="center" class="seccol">ความหมาย</td>
			      </tr>
			      <?php
				  if ($type == "selected") {
					foreach ($cardlist as $v) {
						$thiscard = mysql_query("SELECT * FROM `card` WHERE `id` = '$v'");
						$data_thiscard = mysql_fetch_array($thiscard);
						echo "<tr>";
						echo "<td><img class=\"checkbox\" state=\"no\" cardid=\"$v\" numcardnow=\"$numcardnow\" src=\"../images/theme/$theme/unchecked.png\" width=\"24\" height=\"24\" /></td>";
						echo "<td class=\"pricol\">".$data_thiscard['primary']."</td>";
						echo "<td class=\"seccol\">".$data_thiscard['secondary']."</td>";
						echo "</tr>";
						$numcardnow++;
					}
				  }
				  else if ($type == "group") {
					while ($data_thiscard = mysql_fetch_array($card)) {
						echo "<tr>";
						echo "<td><img class=\"checkbox\" state=\"no\" cardid=\"".$data_thiscard['id']."\" numcardnow=\"$numcardnow\" src=\"../images/theme/$theme/unchecked.png\" width=\"24\" height=\"24\" /></td>";
						echo "<td class=\"pricol\">".$data_thiscard['primary']."</td>";
						echo "<td class=\"seccol\">".$data_thiscard['secondary']."</td>";
						echo "</tr>";
						
					}
				  }
				  else {
					foreach ($lessonlist as $v) {
					$thislesson = mysql_query("SELECT * FROM `card` WHERE `lesson` = '$v' ORDER BY `primary` ASC");
					while ($data_thislesson = mysql_fetch_array($thislesson)) {
						echo "<tr>";
						echo "<td><img class=\"checkbox\" state=\"no\" cardid=\"{$data_thislesson['id']}\" numcardnow=\"$numcardnow\" src=\"../images/theme/$theme/unchecked.png\" width=\"24\" height=\"24\" /></td>";
						echo "<td class=\"pricol\">".$data_thislesson['primary']."</td>";
						echo "<td class=\"seccol\">".$data_thislesson['secondary']."</td>";
						echo "</tr>";
						$numcardnow++;
					}
					}
				  }
			      ?>
		        </table>
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
				  <p id="showcheckp">จำนวนที่เลือก: <span id="showcheck">0</span> ข้อ <input type="button" id="btnGoSelect" value="Go" disabled="disabled" /></p>
				  <div class="popup_button" id="buttonhide"><img src="../images/theme/<?php echo $theme; ?>/rc_hide.png" width="150" height="150" /></div><div class="popup_button highlight" id="buttonshow"><img src="../images/theme/<?php echo $theme; ?>/rc_show.png" width="150" height="150" /></div>
				  
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