<?php
	include('db.php');

	if ($_SESSION['access'] === '0') {
		header('Location: register.php');
	}

	if (is_null($_GET['id'])) {
		header('Location: goods.php');
	}

	$data = $_GET['id'];
	if (is_numeric($data)) {
		$data = (int) $data;
		if (is_int($data)) {
			$hasRow = mysqli_query($con, "SELECT * from `equipment` where `id` = '$data' ");
			if (mysqli_num_rows($hasRow) <= 0) {
				header('Location: goods.php');			
			} else {
				$result = mysqli_query($con, "DELETE FROM `equipment` WHERE `id` = '$data' ");
				header('Location: goods.php');
			}	
		} else {
				header('Location: goods.php');
		}
	} else {
			header('Location: goods.php');
	}

?>