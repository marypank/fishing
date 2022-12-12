<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<title>Рыболов Товары</title>
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

		<div class="buttonsAdmin">
			<a href="createGoods.php">Создание товара</a>
		</div>

		<?php $result = mysqli_query($con, "SELECT * FROM `equipment`"); ?>
		<div class="tableWarehouse">
			<table id="tableWarehouse">
			<caption>Склад</caption>
			<tr>
			    <td> Наименование </td>
			    <td> Цена </td>
			    <td> Описание </td>
			    <td> Тип </td>
			    <td> Количество </td>
			    <td> Картинка </td>
			    <td> Операция </td>
			</tr>
			<?php foreach($result as $item):
				if ($item['type'] === '0') {
	    			$type = 'Рыболовная оснастка';
	    		}
	    		if ($item['type'] === '1') {
	    			$type = 'Спининги/Удилища/Удочки';
	    		}
	    		if ($item['type'] === '3') {
	    			$type = 'Экипировка';
	    		}
	    		if ($item['type'] === '4') {
	    			$type = 'Лодки/Катера';
	    		}
			?>
			<tr>
			    <td style="word-wrap:break-word; max-width: 160px;"><?=$item['title']?></td>
			    <td><?=$item['price']?> рублей</td>
			    <td style="word-wrap:break-word; max-width: 750px;"><?=$item['description']?></td> <!-- style="word-wrap:break-word; max-width: 600px;"-->
			    <td style="word-wrap:break-word; max-width: 100px;"><?=$type?></td>
			    <td><?=$item['count']?> штук</td>
			    <td><img src="img/equipment/<?=$item['img']?>" alt="Рыболов" style="max-width: 200px;"></td>
			    <td style="word-wrap:break-word; min-width: 140px;">
			    	<a href="update.php?id=<?=$item['id']?>">Обновление</a><br><br><br>
			    	<a href="delete.php?id=<?=$item['id']?>">Удаление</a>
			    </td>		    
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