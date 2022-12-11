<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<title>Рыболов Рыболовная оснастка</title>
	<link rel="stylesheet" href="css/style.css">
	<style>

	</style>
</head>

<body>
	<?php require_once "header.php" ?>

	<main>
		<div class="rowBoat">	
			<?php
				$result = mysqli_query($con, "SELECT * FROM `equipment` WHERE `type` = 0");
				foreach($result as $item) :
		    		$line = '...';
		    		$item['description'] = mb_strimwidth($item['description'], 0, 100).$line;
			?>
			<div class="columnBoat">
				<div class="cardBoat"  style="min-height: 400px;">
					<form action="boats.php" method="POST">
						<img style="width: 200px;" src="img/equipment/<?=$item['img']?>" alt="Товар">
						<h3><?=$item['title']?></h3>
						<p class="title" style="width: 300px; text-align: center;"><?=$item['description']?></p>
						<p>Цена: <?=$item['price']?></p>
						<p><a href="goodsAllInfo.php?id=<?=$item['id']?>">Смотреть полностью...</a></p>
					</form>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</main>
	<?php require_once "footer.php" ?>

</body>

</html>