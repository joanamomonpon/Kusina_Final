<?php

session_start();

if (isset($_POST['submit'])){
	
	include 'logindb.php';
	
	$username = mysqli_real_escape_string($conn, $_POST['username']);
	$password = md5(mysqli_real_escape_string($conn, $_POST['password']));
	

	if (empty($username) || empty($password)){
		header("Location: login.php?login=empty");
		exit();
	} else {
		$sql = "SELECT * FROM login_form WHERE username='$username'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		if ($resultCheck < 1) {
			header("Location: login.php?login=error");
			exit();
		} else {
			if ($row = mysqli_fetch_assoc($result)){

				
				if ($password == false){
					header("Location: login.php?login=error");
					exit();
				} elseif ($password == true){

					$_SESSION['id'] = $row['id'];
					$_SESSION['username'] = $row['username'];
					$_SESSION['password'] = $row['password'];
					header("Location: index.php?login=success");
					exit();
				}
				
			}
		}
	}
} else {
	header("Location: login.php?login=error");
	exit();
}