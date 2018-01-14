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
	$close = false;
	$lessonid = $_GET['lesson'];
	$lesson = $conn->query("SELECT * FROM `lesson` WHERE `id` = '$lessonid'");
	$data_lesson = $lesson->fetch_array();
	$group = $conn->query("SELECT * FROM `group` WHERE `id` = '{$data_lesson['group']}'");
	$data_group = $group->fetch_array();
	$card = $conn->query("SELECT * FROM `card` WHERE `lesson` = '$lessonid'");
	$carddata = array();
	while ($data_card = $card->fetch_array()) {
		array_push($carddata, [
			"id" => $data_card['id'],
			"primary" => $data_card['primary'],
			"secondary" => $data_card['secondary']
		]);
	}
	$getid = $lessonid;
}
else if ($type == "group") {
	$close = false;
	$groupid = $_GET['group'];
	$group = $conn->query("SELECT * FROM `group` WHERE `id` = '$groupid'");
	$data_group = $group->fetch_array();
	$lesson = $conn->query("SELECT * FROM `lesson` WHERE `group` = '$groupid'");
	$num_lesson = $lesson->num_rows;
	$carddata = array();
	while ($data_lesson = $lesson->fetch_array()) {
		$card = $conn->query("SELECT * FROM `card` WHERE `lesson` = '{$data_lesson['id']}'");
		while ($data_card = $card->fetch_array()) {
			array_push($carddata, [
				"id" => $data_card['id'],
				"primary" => $data_card['primary'],
				"secondary" => $data_card['secondary']
			]);
		}
	}
	$getid = $groupid;
}
else if ($type = "selected") {
	$close = false;
	$groupid = $_GET['group'];
	$selected = $_GET['selected'];
	$group = $conn->query("SELECT * FROM `group` WHERE `id` = '$groupid'");
	$data_group = $group->fetch_array();
	$cardlist = explode("A", $selected);
	$carddata = array();
	foreach ($cardlist as $v) {
		$card = $conn->query("SELECT * FROM `card` WHERE `id` = '$v'");
		while ($data_card = $card->fetch_array()) {
			array_push($carddata, [
				"id" => $data_card['id'],
				"primary" => $data_card['primary'],
				"secondary" => $data_card['secondary']
			]);
		}
	}
	$getid = $groupid;
}
else {
	$close = true;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Random Card - Recall Card - <?php echo $title; ?></title>
<link href="../css/main.css" rel="stylesheet" type="text/css" />
<link href="../css/main_<?php echo $theme; ?>.css" rel="stylesheet" type="text/css" />
<link href="../css/recallcard_popup.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery.min.js"></script>
<script>
var thislist = '<?php echo $type; ?>';
var carddata = <?php echo json_encode($carddata); ?>;
var listid = '<?php echo $getid; ?>';
var currentcard = { id: 0, primary: "", secondary: "" };
for (var i=0; i<carddata.length; i++) {
	carddata[i].weight = 1;
}
function rand() {
	var randcard;
	var totalWeight = 0;
	carddata.forEach(function (card) {
		if (card.id != currentcard.id) totalWeight += card.weight;
	});
	var randnum = Math.random() * totalWeight;
	var randcard;
	for (var i=0; i<carddata.length; i++) {
		if (carddata[i].id != currentcard.id) {
			if (randnum >= carddata[i].weight) {
				randnum -= carddata[i].weight;
			}
			else {
				randcard = carddata[i];
				break;
			}
		}
	}
	randcard.weight /= 2;
	currentcard = randcard;
	$('#qbox').text(currentcard.primary);
	$('#atext').text(currentcard.secondary);
	$('#atext').hide();
	$('#asoltext').text(currentcard.secondary);
}
function ans() {
	$('#atext').show('fast');
}
$(window).load(function() {
	rand();
});
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
#nextcard {
	display: none;
}
#getpoint {
	display: none;
}
#abox {
	display: none;
}
#asol {
	display: none;
}
.half {
	width: 50%;
	float: left;
}
@media only screen and (max-width: 799px) {
    #sidebar {
        display: none;
    }
	.half {
		width: 100%;
	}
	.showbig {
		display: none;
	}
	#random_left {
		margin: 15px 15px 15px 15px;
		height: calc(100vh - 150px);
	}
}
</style>
</head>

<body<?php if ($close) { ?> onload="window.close()"<?php } ?>>
<div id="loading">Loading...</div>
<table border="0" cellspacing="0" cellpadding="0" id="all">
  <tr>
    <td>
      <table border="0" cellspacing="0" cellpadding="0" width="100%">
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
      </table>
      <table border="0" cellspacing="0" cellpadding="0" width="100%">
        <tr>
          <td>
	        <div id="sidebar">
	          <div class="icon table"><img src="../images/rctable_icon.png" height="50" width="50" /></div>
	          <div class="icon cards"><img src="../images/rccards_icon.png" height="50" width="50" /></div>
	          <div class="icon random"><img src="../images/rcrandom_icon.png" height="50" width="50" /></div>
	        </div>
	      </td>
          <td valign="top">
	        <div class="half">
		      <div id="random_left">
                <div class="qa"> คำถาม:
                  <div class="insideqa" id="qbox"></div>
                </div>
                <div class="qa"> คำตอบ:
                  <div class="insideqa" id="atext"></div>
                  <div class="insideqa" id="abox">
			        <p><input type="text" id="textbox_ans" value="" maxlength="50" /></p>
			        <p><input type="button" id="btnChk" value="ตรวจ" /></p>
		          </div>
                  <div class="insideqa" id="asol">
		            <p><span id="asoltext"></span></p>
			        <p><input type="button" id="btnNext" value="สุ่ม" /></p>
			      </div>
                </div>
              </div>
	        </div>
	        <div class="half">
	      	  <div class="title showbig">กลุ่ม: <?php echo $data_group['name']; ?></div>
		        <div class="textbox">
		          <?php if ($type == "lesson") { ?>
			      <h3 class="showbig">แบบฝึกหัด: <?php echo $data_lesson['name']; ?></h3>
			      <?php } else if ($type == "group") { ?>
		          <p class="showbig">จำนวน: <?php echo $num_lesson; ?> แบบฝึกหัด</p>
			      <?php } ?>
			      <p class="showbig">จำนวน: <?php echo count($carddata); ?> ข้อ</p>
			      <h4 class="h4click showbig" id="continuous_title">สุ่มไปเรื่อยๆ</h4>
			      <div id="continuous" align="center">
			        <div class="popup_button" id="random"><img src="../images/theme/<?php echo $theme; ?>/rc_random.png" width="150" height="50" /></div><div class="popup_button" id="answer"><img src="../images/theme/<?php echo $theme; ?>/rc_answer.png" width="150" height="50" /></div>
			      </div>
			      <h4 class="h4click showbig" id="getpoint_title">สุ่มเก็บคะแนน</h4>
			      <div id="getpoint">
			        <div class="textbox">คะแนน: <input type="text" name="point" id="point" value="0" readonly="readonly" /></div>
			      </div>
		      </div>
	        </div>
	      </td>
        </tr>
      </table>
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