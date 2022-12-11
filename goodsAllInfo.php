<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<title>Рыболов Детальная информация</title>
	<link rel="stylesheet" href="css/style.css">
	<style>
		
	</style>
</head>

<body>
	<?php require_once "header.php" ?>

	<main>
		<?php 
			include('db.php');
			if (isset($_GET['id'])) {
				$id = mysqli_real_escape_string ($con, $_GET['id'] );
				$hasRow = mysqli_query($con, "SELECT * from `equipment` where `id` = '$id' ");
				if (mysqli_num_rows($hasRow) <= 0) {
					header('Location: main.php');			
				}
			}
			$result = mysqli_query($con, "SELECT * FROM `equipment` where `id` = '$id' ");

	    	foreach($result as $item) :
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
		   	<form action="goodsAllInfo.php?id=<?=$id?>" method="POST">
				<div class="cardFullInfo">
					<div class="columnFullInfo">
						<img src="img/equipment/<?=$item['img']?>" alt="Товар">
					</div>
					<div class="columnFullInfo">
						<p class="h3"><b><?=$item['title']?></b></p>
						<p><b>Раздел:</b> <i><?=$type ?></i></p>
						<p class="title"><?=$item['description']?></p>
						<p><b>Цена:</b> <?=$item['price']?> рублей</p>
						<?php  if ($item['count'] === '0'): ?>
							<p>Нет в наличии</p>
						<?php else : ?>
							<p>Количество <input type="number" name="count" value="1" max="<?=$item['count']?>" min="1"></p>
						<?php endif; ?>

						<input type="hidden" name="hiddenId" value="<?=$item['id']?>">
						<input type="hidden" name="hiddenTitle" value="<?=$item['title']?>">
						<input type="hidden" name="hiddenPrice" value="<?=$item['price']?>">
						<input type="hidden" name="hiddenType" value="<?=$item['type']?>">
						<input type="hidden" name="hiddenCount" value="<?=$item['count']?>">
						<input type="hidden" name="hiddenImg" value="<?=$item['img']?>">

						<?php  if ($item['count'] === '0'): ?>
							<p><button type="submit" disabled name="addToCartBtn">Добавить в корзину</button></p>
						<?php else : ?>
							<p><button type="submit" value="Add to card" name="addToCartBtn">Добавить в корзину</button></p>
						<?php endif; ?>
					</div>
				</div>
			</form>
	   	<?php 
	   		endforeach;
	   	?>
	   	<?php 
			$data = $_POST;
			if (isset($data['addToCartBtn'])) {
				if (isset($_SESSION['shopCard'])) {
					$itemArrayId = array_column($_SESSION['shopCard'], 'id');
					if (!in_array($_POST['hiddenId'], $itemArrayId)) {
						$itemArray = array(
						'id' => $_POST['hiddenId'],
						'title' => $_POST['hiddenTitle'],
						'price' => $_POST['hiddenPrice'],
						'type' => $_POST['hiddenType'],
						'countAll' => $_POST['hiddenCount'],
						'count' => $_POST['count'],
						'img' => $_POST['hiddenImg'],
						); 
						array_push($_SESSION['shopCard'], $itemArray);
					} else {
						echo '<script>alert("Товар уже добавлен")</script>';
					}
				} else {
					$items = array(
						'id' => $_POST['hiddenId'],
						'title' => $_POST['hiddenTitle'],
						'price' => $_POST['hiddenPrice'],
						'type' => $_POST['hiddenType'],
						'countAll' => $_POST['hiddenCount'],
						'count' => $_POST['count'],
						'img' => $_POST['hiddenImg'],
					);
					$_SESSION['shopCard'][0] = $items;
				}
			}
		?>
		
	
	</main>
	<?php require_once "footer.php" ?>


</body>

</html>