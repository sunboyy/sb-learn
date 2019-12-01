<?php
require_once("../php/main.php");
require_once("./core.php");

if (!$user) {
	header("Location: ../login.php");
}
$theme = $user['theme'];

if (isset($_GET['lesson'])) {
	$nowlessonid = $_GET['lesson'];
	$lesson = get_lesson($nowlessonid);
	if (!empty($lesson)) {

		$onlesson = true;
		$nowlesson = $lesson['name'];
		$nowgroupid = $lesson['group'];

        $checkgroup = getGroupById($conn, $nowgroupid);

		$data_checkgroup = $checkgroup->fetch_array();
		$nowgroup = $data_checkgroup['name'];
		$checkcard = getCardByLessonId($conn, $lesson['id']);

		$num_checkcard = $checkcard->num_rows;

        $checkowner = getUserById($conn, $lesson['user_id']);

		$data_checkowner = $checkowner->fetch_array();
		$num_checkcard = $checkcard->num_rows;
        $lessoningroup = getLessonByGroupIdWithSorting($conn, $data_checkgroup['id']);
	}
	else {
		header("Location: recallcard.php");
	}
}
else {
	header("Location: recallcard.php");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $nowlesson; ?> - <?php echo $data_checkgroup['name']; ?> - Recall Card - <?php echo $title; ?></title>
<link href="../css/main.css" rel="stylesheet" type="text/css" />
<link href="../css/main_<?php echo $theme; ?>.css" rel="stylesheet" type="text/css" />
<link href="../css/loggedin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
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
			    <div class="groupmenu" group="<?php echo $data_checkgroup['id']; ?>"><?php echo $data_checkgroup['name']; ?></div>
				<?php while ($data_lessoningroup = $lessoningroup->fetch_array()) { ?>
				<div class="lessonlist<?php if ($nowlessonid == $data_lessoningroup['id']) { echo " highlight"; } ?>" lesson="<?php echo $data_lessoningroup['id']; ?>" page="lesson"><?php echo $data_lessoningroup['name']; ?></div>
				<?php } ?>
			  </div>
			</td>
		    <td width="50%">
			  <div id="mainright">
			    <div class="title">Group: <?php echo $nowgroup; ?></div>
				<div class="textbox">
                  <h3>Lesson: <?php echo $nowlesson; ?></h3>
                  <p>Number of cards: <?php echo $num_checkcard; ?><?php if ($user['id'] == $lesson['user_id']) { ?> <img src="../images/theme/<?php echo $theme; ?>/text_edit.png" width="20" height="20" class="texticon" id="managethis" lesson="<?php echo $nowlessonid; ?>" /><?php } ?></p>
                  <p>By <?php echo $data_checkowner['name']; ?></p>
				</div>
				<div class="groupbutton"><img class="button" src="../images/theme/<?php echo $theme; ?>/rctable.png" width="150" height="150" onclick="window.open('wordlist.php?type=lesson&amp;id=<?php echo $_GET['lesson']; ?>','recallcardlesson','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=800px,height=500px')" /><img class="button" src="../images/theme/<?php echo $theme; ?>/rccard.png" width="150" height="150" onclick="window.open('cardlist.php?type=lesson&amp;id=<?php echo $_GET['lesson']; ?>','recallcardlesson','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=800px,height=500px')" /><?php if ($num_checkcard > 1) { ?><img class="button" src="../images/theme/<?php echo $theme; ?>/rcrand.png" width="150" height="150" onclick="window.open('randomcard.php?type=lesson&amp;id=<?php echo $_GET['lesson']; ?>','recallcardlesson','toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=800px,height=500px')" /><?php } ?></div>
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
<script type="text/javascript" src="../js/rc_lesson.js"></script>
</body>
</html>
