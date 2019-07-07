<?php
require_once("../php/main.php");
if (!$user) {
	header("Location: ../login.php");
}
$theme = $user['theme'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>About - Recall Card - <?php echo $title; ?></title>
<link href="../css/main.css" rel="stylesheet" type="text/css" />
<link href="../css/main_<?php echo $theme; ?>.css" rel="stylesheet" type="text/css" />
<link href="../css/loggedin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../js/jquery.min.js"></script>
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
	            <div class="title">เกี่ยวกับ</div>
				  <div class="list">
				    <h3>Recall Card คืออะไร</h3>
				    <li>Recall card เป็นตัวช่วยเพิ่มความจำในเรื่องของคำและความหมายของคำ เช่น vocabulary ในภาษาอังกฤษ หรือใช้กับคำศัพท์ภาษาไทยก็ได้ หรือหากจะท่องประโยคยาวๆ อย่างเช่นสำนวนหรือสุภาษิตที่เป็นภาษาบาลีก็ทำได้</li>
				  </div>
				  <div class="list">
				    <h3>วิชาที่สามารถใช้กับ Recall card ได้มีอะไรบ้าง?</h3>
				    <li>วิชาที่สามารถใช้กับ Recall card เช่น ภาษาอังกฤษ (Vocab), ภาษาไทย (คำศัพท์ในวรรณคดี, สำนวน), เคมี (ท่องชื่อธาตุ), พระพุทธศาสนา (พุทธศาสนสุภาษิต)</li>
				  </div>
		      </div>
			</td>
		    <td width="50%">
			  <div id="mainright">
	      <div class="title">อัพเดตล่าสุด</div>
				<div class="list">
				  <h3>7 JUL 2019</h3>
				  <li>ปรับโครงสร้างโค้ด ลบไฟล์ที่ไม่ได้ใช้ แก้ปัญหา SQL injection บางส่วน</li>
				</div>
				<div class="list">
				  <h3>14 JAN 2018</h3>
				  <li>เปลี่ยนชื่อหัวเว็บให้ให้เข้ากับการใช้งานในปัจจุบัน (มุ่งสู่ห้อง K/Q ม.5 -> SB Learn)</li>
				</div>
				<div class="list">
				  <h3>11 JAN 2018</h3>
				  <li>เพิ่มประสิทธิภาพเล็กน้อย</li>
					<li>เพิ่มโอกาสในการสุ่มให้มีโอกาสได้ครบทุกตัวมากขึ้น</li>
				</div>
				<div class="list">
				  <h3>25 SEP 2016</h3>
				  <li>แก้ปัญหาการแสดงผลไม่ถูกต้องเมื่อปรับขนาดหน้าจอ</li>
				</div>
				<div class="list">
				  <h3>16 OCT 2015</h3>
				  <li>ปรับหน้าเข้าสู่ระบบและหน้าแก้การ์ดให้มีพื้นหลังลางๆ</li>
				  <li>เพิ่มการแก้ไขชื่อแบบฝึกหัด</li>
				</div>
				<div class="list">
				  <h3>30 SEP 2015</h3>
				  <li>จัดลำดับคำศัพท์ใหม่ให้การจำมีประสิทธิภาพมากขึ้น</li>
				  <li>กล่องคะแนนเป็นสีแดงเมื่อตอบผิด</li>
				  <li>เลือกทำแบบทดสอบเฉพาะคำศัพท์ที่ต้องการจากหลายแบบฝึกหัดได้</li>
				  <li>เพิ่มความเร็วในการสุ่มคำศัพท์</li>
				</div>
				<div class="list">
				  <h3>Final T1 2015 [15 SEP 2015]</h3>
				  <li>ปรับโครงร่างเว็บใหม่สำหรับทุกขนาดหน้าจอ</li>
				  <li>สามารถเลือกโทนสีขาวหรือดำได้</li>
				  <li>หน้าเพิ่มแบบฝึกหัดใช้งานง่ายขึ้น</li>
				  <li>แทนที่หน้าจัดการแบบฝึกหัดแบบเก่าด้วยแบบใหม่</li>
				  <li>เพิ่มหน้า "เกี่ยวกับ"</li>
				  <li>ใส่รูปแทนข้อความเปิดหน้าทำแบบฝึกหัด</li>
				  <li>แก้ไขการ์ดคำศัพท์ได้</li>
				  <li>เพิ่มระบบสุ่มนับคะแนน</li>
				</div>
				<div class="list">
				  <h3>22 AUG 2015</h3>
				  <li>เพิ่มจำนวนข้อที่เปิดอยู่ในหน้าการ์ด</li>
				</div>
				<div class="list">
				  <h3>17 AUG 2015</h3>
				  <li>เพิ่มระบบทายคำศัพท์หลายแบบฝึกหัดพร้อมกัน</li>
				  <li>ปรับปรุงระบบใหม่หมด</li>
				</div>
				<div class="list">
				  <h3>Sum T2 2014 [14 DEC 2014]</h3>
				  <li>เพิ่มฟังก์ชันการ์ดคำศัพท์</li>
				  <li>ปรับขนาดตัวอักษรให้ใหญ่ขึ้น</li>
				  <li>ปรับระบบการสุ่มใหม่ให้ดีขึ้น</li>
				  <li>กด Q และ A แทนคลิกการ์ดเพื่อสุ่มและเฉลย</li>
				  <li>สามารถย่อ-ขยายหัวข้อวิชาได้</li>
				</div>
				<div class="list">
				  <h3>19 OCT 2014</h3>
				  <li>เพิ่ม Animation เปิด-ปิดหัวข้อ</li>
				</div>
				<div class="list">
				  <h3>21 JUL 2014</h3>
				  <li>เปลี่ยนปุ่มใหม่ให้สวยขึ้น</li>
				  <li>ยกเลิกการสุ่มแบบ "หาคำจากความหมาย" และ "ผสม"</li>
				</div>
				<div class="list">
				  <h3>28 MAR 2014</h3>
				  <li>เพิ่มตัวเลขแสดงจำนวนแบบฝึกหัดในกลุ่มต่างๆ</li>
				</div>
				<div class="list">
				  <h3>24 DEC 2013</h3>
				  <li>สามารถคลิกที่การ์ดคำศัพท์เพื่อสุ่มหรือเฉลยได้</li>
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
  <div class="inhid back">Back</div>
  <div class="inhid add">New lesson</div>
  <div class="inhid manage">Manage</div>
  <div class="high"></div>
  <div class="inhid info">Info</div>
</div>
<script type="text/javascript" src="../js/main.js"></script>
<script type="text/javascript" src="../js/rc_info.js"></script>
</body>
</html>
