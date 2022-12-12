<?php
	include('db.php');

    if (!isset($_SESSION['session_username'])) {
        header('Location: main.php');
    }

	if (is_null($_POST['eq_id'])) {
		header('Location: goods.php');
	}

    $email = $_SESSION['session_username'];
    $user = mysqli_query($con, "SELECT `id` FROM `users` where `email` = '$email'");
    $user = mysqli_fetch_array($user);
    $userId = $user['id'] ?? null;

    $eqId = $_POST['eq_id'];
    $eq = mysqli_query($con, "SELECT `id` FROM `equipment` where `id` = '$eqId'");
    $eq = mysqli_fetch_array($eq);
    $eqId = $eq['id'] ?? null;

    if ($_POST['action'] === 'add' && $userId && $eqId) {
        $result = mysqli_query($con, "INSERT INTO `user_equipment` (`user_id`, `eq_id`) VALUES ('$userId', '$eqId');");
        header('Location: catalog.php');
    } elseif ($_POST['action'] === 'delete' && $userId && $eqId) {
        $result = mysqli_query($con, "delete from `user_equipment` where `user_id` = '$userId' and `eq_id` = '$eqId'");
        header('Location: wishlist.php');
    } else {
        $_POST['action'] === 'delete' ? header('Location: wishlist.php') : header('Location: catalog.php');
    }

?>