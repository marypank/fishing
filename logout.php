<?php
	require "db.php" ;

	unset($_SESSION['session_username'] );
	header('Location: main.php');
?>
