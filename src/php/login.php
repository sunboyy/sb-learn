<?php
require_once("main.php");
if ($user) {
	header("Location: ../index.php");
}
if ($_POST) {
	$stmt = $conn->prepare("SELECT * FROM `user` WHERE `pwd` = ?");
	$stmt->bind_param("s", $_POST['pwd']);
	$stmt->execute();
	$user = $stmt->get_result();
	if ($user->num_rows == 1) {
		$data_user = $user->fetch_array();
		$_SESSION['user'] = $data_user['id'];
		header("Location: ../index.php?message=LoginSuccesful");
	}
	else {
		$msg = "Incorrect Password";
		header("Location: ../login.php?message=$msg");
		
	}
}
?>
