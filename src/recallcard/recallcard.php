<?php
require_once("../php/main.php");
require_once("core.php");
if (!$user) {
	header("Location: ../login.php");
}
$theme = $user['theme'];

$group = $conn->query("SELECT * FROM `group` ORDER BY id ASC");

$latest = $conn->query("SELECT * FROM `lesson` ORDER BY `time_created` DESC LIMIT 0, 3");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Recall Card - <?php echo $title; ?></title>
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
	    <div class="icon home"><img src="../images/back.png" height="50" width="50" /></div>
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
		    <td width="200">
			  <div id="mainleft">
			    <div class="title">Recent lessons</div>
			    <?php while ($data_latest = $latest->fetch_array()) {
					$thisuserid = $data_latest['user_id'];
					$thislessonid = $data_latest['id'];
					$stmt = $conn->prepare("SELECT * FROM `user` WHERE `id` = ?");
					$stmt->bind_param("i", $thisuserid);
					$stmt->execute();
					$checkuser = $stmt->get_result();

					$data_checkuser = $checkuser->fetch_array();
					$stmt = $conn->prepare("SELECT * FROM `card` WHERE `lesson` = ?");
					$stmt->bind_param("i", $thislessonid);
					$stmt->execute();
					$checkcard = $stmt->get_result();

					$num_checkcard = $checkcard->num_rows;
				?>
				<div class="clicktextbox latest" lesson="<?php echo $data_latest['id']; ?>">
				  <h3><?php echo $data_latest['name']; ?></h3>
				  <p>Cards: <?php echo $num_checkcard; ?></p>
				  <p>By <?php echo $data_checkuser['name']; ?></p>
				</div>
				<?php } ?>
			  </div>
			</td>
			<td>
			  <div id="mainright">
				<?php foreach (get_groups() as $data_group) {
				$stmt = $conn->prepare("SELECT * FROM `lesson` WHERE `group` = ? ORDER BY `id` ASC");
				$stmt->bind_param("i", $data_group['id']);
				$stmt->execute();
				$lesson = $stmt->get_result();

				$num_lesson = $lesson->num_rows; ?><div class="groupicon" group="<?php echo $data_group['id']; ?>">
				<div class="image"><img src="../images/theme/<?php echo $theme; ?>/groupicon.png" width="200" height="176" /></div>
				  <table border="0" cellspacing="0" cellpadding="0" width="200">
				    <tr>
			          <td align="left"><div class="name"><?php echo $data_group['name']; ?></div></td>
				      <td align="right"><div class="number"><?php echo "(".$num_lesson.")"; ?></div></td>
			        </tr>
			      </table>
				</div><?php } ?>
			  </div>
			</td>
		  </tr>
		</table>
	  </div>
	</td>
  </tr>
</table>
<div id="hidsidebar">
  <div class="inhid home">Back</div>
  <div class="inhid add">New lesson</div>
  <div class="inhid manage">Manage</div>
  <div class="high"></div>
  <div class="inhid info">Info</div>
</div>
<script type="text/javascript" src="../js/main.js"></script>
</body>
</html>
