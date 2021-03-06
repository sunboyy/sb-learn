<?php
require_once("php/main.php");
if (!$user) {
	header("Location: login.php");
}
$theme = $user['theme'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Home - <?php echo $title; ?></title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="css/main_<?php echo $theme; ?>.css" rel="stylesheet" type="text/css" />
<link href="css/loggedin.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
</head>

<body>
<div id="loading">Loading...</div>
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
	      <img src="images/theme/<?php echo $theme; ?>/groupicon.png" width="250" height="220" />
		  Recall card
		</div>
	  </div>
	</td>
  </tr>
</table>
<script type="text/javascript" src="js/main.js"></script>
</body>
</html>
