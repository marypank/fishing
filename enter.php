<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<title>Рыболов Вход</title>
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<?php require_once "header.php" ?>

	<?php 
		include('db.php');

		$data = $_POST;

		if (isset($data['enterbtn'])) {
			$errors = [];

			$email = $data['email'];
			$password = $data['psw'];
			$password = md5($password."gbsd2342dg");

			$loginCheck = $con->query("SELECT * from `users` where `email` = '$email' ");
			if (mysqli_num_rows($loginCheck) < 1) {
				$errors[] = 'Такой почты не существует!';			
			}

			$paswCheck = $con->query("SELECT * from `users` where `email` = '$email' and `password` = '$password' ");
			if (mysqli_num_rows($paswCheck) < 1) {
				$errors[] = 'Пароль неверный!';	
			}

			if(empty($errors)) {
				$_SESSION['session_username'] = $data['email'];
				$result = $con->query("SELECT `access`, `login` from `users` where `email` = '$email' ");
				$array = mysqli_fetch_array($result);
				$_SESSION['access'] = $array[0];
				$_SESSION['name'] = $array[1];
			}

		}
	?>

	<main>
		<?php 
			if (isset($_SESSION['session_username'])):
				if ($_SESSION['access'] === '0') {
					header('Location: register.php');
				}
		?>
		<div class="welcome">
			<p>Добро пожаловать, <?php echo $_SESSION['name']; ?>! </p>
			<p><a href="logout.php">Выйти</a></p>
		</div>

		<div class="buttonsAdmin">
			<a href="goods.php">Товары</a>
			<a href="ordersNew.php">Новые заказы</a>
			<a href="ordersDone.php">Выполненные заказы</a>
		</div>

		<?php else: ?>
		<form action="enter.php" method="post">
			<div class="container">
				<h1>Вход</h1>
				<p><?php if (!empty($errors)) { echo array_shift($errors); } else { echo ''; } ?></p>
				<label for="email"><b>Логин</b></label><br>
				<input type="email" placeholder="Введите почту" name="email" id="email" required><br>

				<label for="psw"><b>Пароль</b></label><br>
				<input type="password" placeholder="Введите пароль" name="psw" id="psw" required><br>

				<button type="submit" class="enterbtn" name="enterbtn">Войти</button>
			</div>
		</form>
		<div class="registerHref">
			<p>Еще не зарегистрированы? <a href="register.php">Регистрация</a></p>
		</div>

		<?php endif; ?>
		
	</main>
	<?php require_once "footer.php" ?>

</body>

</html>