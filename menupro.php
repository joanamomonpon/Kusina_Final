<?php
session_start();

$mysqli = new mysqli('localhost', 'root', '', 'onlinekusina') or die(mysqli($mysqli));
	
	$menu_id = 0;
	$update = false;
	$menu_id = '';
	$menu_name = '';
	$price = '';
	$description = '';
	$unit = '';
	

if (isset($_POST['submit'])) {
		$id = $_SESSION['id'];
		$menu_id = $_POST['menu_id'];
		$menu_name = $_POST['menu_name'];
		$description = $_POST['description'];
		$price = $_POST['price'];
		$unit = $_POST['unit'];
		
		
		$mysqli->query("INSERT INTO menu (id, menu_id, menu_name, description, price, unit) VALUES('$id', '$menu_id', '$menu_name', '$description', '$price', '$unit')") or die($mysqli->error);
		header("location: menuview.php");
	}
	
	if (isset($_GET['delete'])) {
		$menu_id = $_GET['delete'];
		$sql = "DELETE FROM menu WHERE menu_id='".$menu_id."'";
		$mysqli->query($sql) or die($mysqli->error());
		header("location: menuview.php");
	
	}
	
	if (isset($_GET['edit'])) {
		$menu_id = $_GET['edit'];
		$update = true;
		$sql = "SELECT * FROM menu WHERE menu_id='".$menu_id."'";
		$result = $mysqli->query($sql) or die($mysqli->error());
		if (@count($result)==1) {
			$row = $result->fetch_array();
			$menu_id = $row['menu_id'];
			$menu_name = $row['menu_name'];
			$description = $row['description'];
			$price = $row['price'];
			$unit = $row['unit'];
		}
	}
	if (isset($_POST['update'])) {
		$menu_id = $_POST['menu_id'];
		$menu_name = $_POST['menu_name'];
		$description = $_POST['description'];
		$price = $_POST['price'];
		$unit = $_POST['unit'];
		
		
		$mysqli->query("UPDATE menu SET menu_id='$menu_id', menu_name='$menu_name', description='$description', price='$price', unit='$unit' WHERE menu_id='".$menu_id."'") or die($mysqli->error);
		header("location: menuview.php");
	}

	
	
	?>