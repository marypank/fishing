<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<title>Рыболов Обновление Товара</title>
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<?php require_once "include/header.php" ?>

	<?php 
		include('db.php');

		$dataPOST = $_POST;
		$errors = [];
		if (isset($_GET['id'])) {
			$id = mysqli_real_escape_string($con, $_GET['id'] );
			$hasRow = mysqli_query($con, "SELECT * from `equipment` where `id` = '$id' ");
			if (mysqli_num_rows($hasRow) <= 0) {
				header('Location: goods.php');			
			}

			if (isset($dataPOST['updatebtn'])) {
				$input_name = 'imgFile';
				$filename = $_FILES[$input_name]['name'];
				$filepath = "C:\\xampp\\htdocs\\fishing\\img\\equipment\\".$filename;
				if (isset($_FILES[$input_name])) {
					if (iconv_strlen($filename) === 0) {
						// обновлено без фото
						$title = $dataPOST['title'];
						$price = $dataPOST['price'];
						$description = $dataPOST['description'];
						$type = $dataPOST['selectType'];
						$count = $dataPOST['count'];
						//$img = $dataPOST['imgFile'];

						$result = mysqli_query($con, "UPDATE `equipment` SET `title` = '$title', 
									 									`price` = '$price',
									 									`description` = '$description',
									 									`type` = '$type',
									 									`count` = '$count'
									 									WHERE `id`='$id'");
						$errors[] = 'Данный товар обновлен без фотографии.';	
					} else {
						// обновлено c фото
						move_uploaded_file($_FILES[$input_name]['tmp_name'], $filepath);
						$title = $dataPOST['title'];
						$price = $dataPOST['price'];
						$description = $dataPOST['description'];
						$type = $dataPOST['selectType'];
						$count = $dataPOST['count'];
						//$img = $dataPOST['imgFile'];

						$result = mysqli_query($con, "UPDATE `equipment` SET `title` = '$title', 
									 									`price` = '$price',
									 									`description` = '$description',
									 									`type` = '$type',
									 									`count` = '$count',
									 									`img` = '$filename'
									 									WHERE `id`='$id'");
						$errors[] = 'Данный товар обновлен с фотографией.';
					}
				} else {
					$errors[] = 'Не обновлено, какая-то ошибка!';
				}
			}
		} else {
			header('Location: goods.php');
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
			<p>Добро пожаловать,   <?php echo $_SESSION['session_username']; ?> ! </p>
			<p><a href="goods.php">Назад</a></p>
		</div>
		<div class="updateAndcreateForm">
			<form action="update.php?id=<?=$id ?>" method="POST" enctype="multipart/form-data">
				<div class="containerGoods">
					<h2>Обновление товара</h2>
					<p class="message"><?php if (!empty($errors)) { echo array_shift($errors); } else { echo 'Введите полную информацию.'; } ?></p>
					<hr>
					<?php
						$result = mysqli_query($con, "SELECT * FROM `equipment` WHERE `id` = '$id'");
						foreach($result as $item):
					?>
					<label for="title"><b>Название</b></label>
					<input type="text" id="title" name="title" placeholder="Название" maxlength="30" required value="<?=$item['title']?>">
					<br>
					<label for="price"><b>Цена</b></label>
					<input type="number" placeholder="Цена" name="price" id="price" min="1" max="99999999" required value="<?=$item['price']?>">
					<br>
					<label for="description"><b>Описание</b></label>
					<input type="textarea" placeholder="Описание" name="description" id="description" maxlength="510" required value="<?=$item['description']?>">
					<br>
					<label for="selectType"><b>Тип (выбирается всегда)</b></label>
					<select name="selectType" required>
						<option value="0" selected="selected">Рыболовная оснастка</option>
					    <option value="1">Спининги/Удилища/Удочки</option>
					    <option value="3">Экипировка</option>
					    <option value="4">Лодки/Катера</option>
					 </select>
					<br>
					<label for="count"><b>Количество</b></label>
					<input type="number" placeholder="Количество" name="count" id="count" min="1" max="99999999" required value="<?=$item['count']?>">
					<br>
					<?php endforeach; ?>
					<label for="imgFile"><b>Изображение</b></label>
					<input type="file" name="imgFile" id="imgFile">
					<hr>
					<button type="submit" class="createbtn" name="updatebtn">Обновить</button>
				</div>
			</form>
		</div>

		<?php else : header('Location: main.php'); ?>
		<?php endif; ?>
	</main>
	<?php require_once "include/footer.php" ?>

</body>

</html>