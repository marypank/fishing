<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<title>Рыболов</title>
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<?php require_once "include/header.php" ?>

	<?php 
		include('db.php');

		$data = $_POST;

		if (isset($data['registerbtn']) ) {
			$errors=array();

			$login = $data['login'];
			$email = $data['email'];
			$password = $data['psw'];
			$password = md5($password."gbsd2342dg");
			
			$emailUnique = mysqli_query($con, "SELECT * from `users` where `email` = '$email' ");
			if (mysqli_num_rows($emailUnique) >= 1) {
				$errors[] = 'Эта почта уже используется другим аккаунтом!';			
			}
			if(empty($errors) ) {
				$result = mysqli_query($con, "INSERT INTO `users` (`login`, `email`, `password`, `access`) values('$login', '$email', '$password', '0')");
				$errors[] = 'Вы зарегистрированы!';
			}
		}
	?>

	<main>
		<?php 
			if (isset($_SESSION['session_username'])) :
				if ($_SESSION['access'] === '1') {
					header('Location: enter.php');
				}
		?>
		<div class="welcome">
			<p>Добро пожаловать, <?php echo $_SESSION['name']; ?>! </p>
			<p><a href="logout.php">Выйти</a></p>
		</div>

		<?php 
			$userEmail = $_SESSION['session_username'];
			$result = mysqli_query($con, "SELECT * FROM `orders` where `userEmail` = '$userEmail'  group by `date`, `fullName`,`userEmail`"); ?>
		<div class="tableOrders">
			<table id="tableOrders">
			<caption>Заказы</caption>
			<tr>
			    <td>ФИО </td>
			    <td>Email и телефон</td>
			    <td>Город</td>
			    <td>Цена</td>
			    <td>Дата заказа</td>
			    <td>Сожержимое заказа</td>
			    <td>Статус</td>
			</tr>
			<?php foreach($result as $item):
				$fullName =  $item['fullName'];
				$date = $item['date'];
			?>
			<tr>
			    <td><?=$item['fullName']?></td>
			    <td style="width: 140px;"><?=$item['userEmail']?>, <?=$item['phone']?></td>
			    <td style="width: 120px;"><?=$item['address']?></td>
			    <td style="width: 70px;"><?=$item['allPrice']?></td>
			    <td style="width: 120px;"><?=$item['date']?></td>
			    <td style="max-width: 700px; min-width: 700px;">
			   		<?php
						$result2 = mysqli_query($con, "SELECT * FROM `orders` where `date` = '$date' and `userEmail` = '$userEmail' and `fullName` = '$fullName'");
						foreach($result2 as $item2):
					?>
						<p>Название: <?=$item2['goodsTitle']?>. Кол-во: <?=$item2['goodCount']?> <br><p>
					<?php endforeach; ?>
			    </td>
			    <?php
		    		$message = '';
		    		if ($item['execution'] === '0')
		    			$message = 'Заказ выполняется';
		    		if ($item['execution'] === '1')
		    			$message = 'Заказ выполнен';
			    ?>
			    <td>
			    	<?=$message ?>
			    </td>	    
			</tr>
			<?php endforeach; ?>
			</table>
		</div>


		<?php else : ?>

		<form action="register.php" method="post">
			<div class="container">
				<h1>Регистрация</h1>
				<p><?php if (!empty($errors)) { echo array_shift($errors); } else { echo ''; } ?></p>
				<label for="login"><b>Логин/Имя</b></label><br>
				<input type="text" placeholder="Введите логин" name="login" id="login" required><br>

				<label for="email"><b>Почта</b></label><br>
				<input type="email" placeholder="Введите почту" name="email" id="email" required><br>

				<label for="psw"><b>Пароль</b></label><br>
				<input type="password" placeholder="Введите пароль" name="psw" id="psw" required><br>

				<button type="submit" class="enterbtn" name="registerbtn">Регистрация</button>
			</div>
		</form>
		<div class="registerHref">
			<p>Уже зарегистрированы? <a href="enter.php">Вход</a></p>
		</div>

		<?php endif; ?>

	</main>

	<?php require_once "include/footer.php" ?>

</body>

</html>