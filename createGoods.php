<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<title>Рыболов Товары (добавление)</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/slider.css">
	<style type="text/css">

	</style>
</head>

<body>
	<?php require_once "header.php" ?>

	<?php 
		if (!isset($_SESSION['session_username'])) {
			echo '<script>window.location="enter.php"</script>';
		}
	?>

	<?php 
		include('db.php');

		$dataPOST = $_POST;
		$errors = [];
		
		if (isset($dataPOST['createbtn'])) {
			$input_name = 'imgFile';
			$filename = $_FILES[$input_name]['name'];
			$filepath = "C:\\xampp\\htdocs\\fishing\\img\\equipment\\".$filename;

			if (isset($_FILES[$input_name])) {
				move_uploaded_file($_FILES[$input_name]['tmp_name'], $filepath);
				$title = $dataPOST['title'];
				$price = $dataPOST['price'];
				$description = $dataPOST['description'];
				$type = $dataPOST['selectType'];
				$count = $dataPOST['count'];

				$result = mysqli_query($con, "INSERT INTO `equipment` (`title`, `price`, `description`, `type`, `count`, `img`)
									VALUES ('$title', '$price', '$description', '$type', '$count', '$filename')");

				$errors[] = 'Данный товар добавлен';
			} else {
				$errors[] = 'Данный товар не добавлен, какая-то ошибка';
			}
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
			<p>Добро пожаловать,   <?php echo $_SESSION['name']; ?> ! </p>
			<p><a href="goods.php">Назад</a></p>
		</div>
		<div class="updateAndcreateForm">
			<form action="createGoods.php" method="POST" enctype="multipart/form-data">
				<div class="containerGoods">
					<h2>Добавление товара</h2>
					<p class="message"><?php if (!empty($errors)) { echo array_shift($errors); } else { echo 'Введите полную информацию.'; } ?></p>
					<hr>

					<label for="title"><b>Название</b></label>
					<input type="text" id="title" name="title" placeholder="Название" maxlength="30" required>
					<br>

					<label for="price"><b>Цена</b></label>
					<input type="number" placeholder="Цена" name="price" id="price" min="1" max="99999999" required>
					<br>

					<label for="description"><b>Описание</b></label>
					<input type="textarea" placeholder="Описание" name="description" id="description" maxlength="500" required>
					<br>

					<label for="selectType"><b>Тип</b></label>
					<select name="selectType" required>
						<option value="0" selected="selected">Рыболовная оснастка</option>
					    <option value="1">Спининги/Удилища/Удочки</option>
					    <option value="3">Экипировка</option>
					    <option value="4">Лодки/Катера</option>
					 </select>
					<br>

					<label for="count"><b>Количество</b></label>
					<input type="number" placeholder="Количество" name="count" id="count" min="1" max="9999999" required>
					<br>

					<label for="imgFile"><b>Изображение (обязательно)</b></label>
					<input type="file" name="imgFile" id="imgFile" required>

					<hr>

					<button type="submit" class="createbtn" name="createbtn">Создать</button>
				</div>
			</form>
		</div>

		<?php else :
			echo '<script>window.location="main.php"</script>';
		?>

		<?php endif; ?>
		
	</main>

	<?php require_once "footer.php" ?>
</body>

</html>