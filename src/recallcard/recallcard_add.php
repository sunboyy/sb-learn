<?php
require_once("../php/main.php");
if (!$user) {
	header("Location: ../login.php");
}
$theme = $user['theme'];

if ($_POST) {
	$lsnname = htmlspecialchars(trim($_POST['lsnname']));
	$lsngroup = $_POST['lsngroup'];
	if (($lsnname != "") && ($lsngroup != "")) {
		$stmt = $conn->prepare("INSERT INTO `lesson` VALUES ( NULL , ?, ?, ?, NOW())");
		$stmt->bind_param("sii", $lsnname, $lsngroup, $user['id']);
		$stmt->execute();
		$lastid = $conn->insert_id;
		header("Location: manage.php?lesson=$lastid");
	}
}

$group = $conn->query("SELECT * FROM `group` ORDER BY id ASC");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Add Lesson - Recall Card - <?php echo $title; ?></title>
<link href="../css/main.css" rel="stylesheet" type="text/css" />
<link href="../css/main_<?php echo $theme; ?>.css" rel="stylesheet" type="text/css" />
<link href="../css/loggedin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
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
	            <div class="title">+ Create new lesson</div>
				<center>
				  <form method="post" id="form_addlesson">
				    <table border="0" cellspacing="0" cellpadding="5">
				      <tr>
					    <td align="right" valign="middle">Lesson name:</td>
					    <td align="left" valign="middle"><input name="lsnname" type="text" id="lsnname" maxlength="25" /></td>
					  </tr>
				      <tr>
					    <td align="right" valign="middle">Group:</td>
					    <td align="left" valign="middle"><span id="showgroupname">(Choose from the right)</span></td>
					  </tr>
				      <tr>
					    <td></td>
					    <td align="left" valign="middle"><input name="btnAdd" type="button" id="btnAdd" value="เพิ่ม" /></td>
					  </tr>
				    </table>
                    <input name="lsngroup" type="hidden" id="lsngroup" value="" />
				  </form>
				</center>
		      </div>
			</td>
		    <td width="50%">
	          <div id="mainright">
			    <?php while ($data_group = $group->fetch_array()) { ?>
			    <div class="grouplist" groupid="<?php echo $data_group['id']; ?>"><?php echo $data_group['name']; ?></div>
				<?php } ?>
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
<script type="text/javascript" src="../js/rc_add.js"></script>
</body>
</html>
