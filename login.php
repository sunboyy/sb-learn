<?php
require_once("php/main.php");
if ($user) {
	header("Location: index.php");
}
if ($_POST) {
	$qry_user = sprintf("SELECT * FROM `user` WHERE `pwd` = '%s'", $conn->real_escape_string($_POST['pwd']));
	$user = $conn->query($qry_user);
	if ($user->num_rows == 1) {
		$data_user = $user->fetch_array();
		$_SESSION['user'] = $data_user['id'];
		header("Location: index.php");
	}
	else {
		$msg = "รหัสผ่านผิด";
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - <?php echo $title; ?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/main_dark.css" rel="stylesheet" type="text/css" />
<link href="css/loggedin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
</head>

<body>
<div id="darkoutside">
  <div id="center">
    <form method="post" action="" id="loginform">
      <h3 align="left">เข้าสู่ระบบ</h3>
      <center>
        <table border="0" cellspacing="0" cellpadding="5">
	      <tr>
	        <td align="right" valign="middle">รหัสผ่าน:</td>
		    <td align="left" valign="middle"><input type="password" name="pwd" id="pwd" maxlength="30" autofocus /></td>
	      </tr>
	      <tr>
	        <td>&nbsp;</td>
		    <td align="left" valign="middle"><input type="submit" name="btnLogin" id="btnLogin" value="ตกลง" /></td>
	      </tr>
	    </table>
          <?php if (!empty($msg)) { ?>
          <div class="msg"><?php echo $msg; ?></div>
          <?php } ?>
	  </center>
    </form>
  </div>
</div>
<table border="0" cellspacing="0" cellpadding="0" id="all">
  <tr>
    <td width="50" valign="middle">
	  <div id="menu" class="icon"><img src="images/menu.png" height="50" width="50" /></div>
	</td>
	<td>
	  <div id="topbar">
	    <div class="icon home"><img src="images/home.png" height="50" width="50" /></div><div id="wide"></div><div class="icon profile"><img src="images/profile.png" height="50" width="50" /></div><div class="icon logout"><img src="images/logout.png" height="50" width="50" /></div>
	  </div>
	</td>
  </tr>
  <tr>
    <td>
	  <div id="sidebar">
	  </div>
	</td>
    <td>
	  <div id="main">
	    <div class="servicelist recallcard">
	      <img src="images/theme/dark/groupicon.png" width="250" height="220" />
		  Recall card
		</div>
	  </div>
	</td>
  </tr>
</table>
<script type="text/javascript" src="js/login.js"></script>
</body>
</html>