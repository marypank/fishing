<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<title>Рыболов Пользователиы</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/slider.css">
</head>

<body>
	<?php require_once "include/header.php" ?>

	<?php 
		if (!isset($_SESSION['session_username'])) {
			echo '<script>window.location="enter.php"</script>';
		}
	?>

	<main>
		<?php 
			if (isset($_SESSION['session_username'])) :
				if ($_SESSION['access'] === '0') {
					header('Location: register.php');
				}
		?>

		<div class="welcome">
			<p>Добро пожаловать,   <?php echo $_SESSION['name']; ?>! </p>
			<p><a href="enter.php">Назад</a></p>
		</div>

		<?php
			$isDone = $_GET['order'] ?? 0;
			$result = mysqli_query($con, "SELECT * FROM `users` order by id");
		?>
		<div class="tableOrders">
			<table id="tableOrders">
                <caption>Пользователи</caption>
                <tr>
                    <td>Логин</td>
                    <td>Почта</td>
                    <td>Роль</td>
                </tr>
                <?php foreach($result as $item):
                    
                    $role = $item['access'] ? 'Администратор' : 'Пользователь';
                ?>
                <tr>
                    <td><?=$item['login']?></td>
                    <td><?=$item['email']?></td>
                    <td><?=$role?></td>
                </tr>
                <?php endforeach; ?>
			</table>
		</div>

		<?php else :
			echo '<script>window.location="main.php"</script>';
		?>
		<?php endif; ?>

	</main>

	<?php require_once "include/footer.php" ?>
</body>

</html>