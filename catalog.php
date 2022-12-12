<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<title>Рыболов Каталог</title>
	<link rel="stylesheet" href="css/style.css">
	<style>

	</style>
</head>

<body>
	<?php require_once "include/header.php" ?>

	<main>
		<div class="basketForm">
		    <form action="catalog.php" method="get" style="margin-bottom: 5px; padding-top: 10px;">
				<input type="text" id="search_field" name="search_field" placeholder="Поиск по названию...">
				<label for="selectType"><b>Сортировка:</b></label>
					<select name="selectType" required>
						<option value="0" selected></option>
					    <option value="1">Цена (по убыванию)</option>
					    <option value="2">Цена (по возрастанию)</option>
					    <option value="3">По наличию (Количество, по убыванию)</option>
					    <option value="4">По наличию (Количество, по возрастанию)</option>
					 </select>
				<button type="submit" class="registerbtn" name="search">Поиск</button>
			</form>
			
		</div>
		<div class="rowBoat">	
			<?php
			if (isset($_SESSION['session_username'])) {
				$email = $_SESSION['session_username'];
				$userWishlist = mysqli_query($con, "SELECT * FROM `user_equipment` where `user_id` = (SELECT `id` FROM `users` where `email` = '$email')");

				$wishes = [];
				foreach($userWishlist as $item) {
					$wishes[] = (int)$item['eq_id'];
				}
			}

			$where = "";
			if (!empty($_GET['search_field'])) {
				$field = trim($_GET['search_field']);
				$where = " where `title` like '%$field%' ";
			}

			$orderBy = "order by `id`";
			if (!empty($_GET['selectType'])) {
				$selectType = $_GET['selectType'];
				switch ($selectType) {
					case '1':
						$orderBy = "order by `price` desc";
						break;
					case '2':
						$orderBy = "order by `price`";
						break;
					case '3':
						$orderBy = "order by `count` desc";
						break;
					case '4':
						$orderBy = "order by `count`";
						break;
					default:
						$orderBy = "order by `id`";
						break;
				}
			}

			$query = "SELECT * FROM `equipment` $where $orderBy";
			$result = mysqli_query($con, $query);
			foreach($result as $item) :
				$line = '...';
				$item['description'] = mb_strimwidth($item['description'], 0, 100).$line;

				if (isset($_SESSION['session_username'])) {
					$inWish = in_array($item['id'], $wishes);
				}
			?>
			<div class="columnBoat">
				<div class="cardBoat"  style="min-height: 400px;">
					<img style="width: 200px;" src="img/equipment/<?=$item['img']?>" alt="Товар">
					<h3><?=$item['title']?></h3>
					<p class="title" style="width: 300px; text-align: center;"><?=$item['description']?></p>

					<?php if (isset($_SESSION['session_username'])) : ?>
						<?php if (!$inWish) : ?>
							<form action="add_to_wishlist.php" method="POST">
								<input type="hidden" value="add" name="action" id="action">
								<input type="hidden" value="<?=$item['id']?>" name="eq_id" id="eq_id">
								<button type="submit">Добавить в wishlist</button>
							</form>
						<?php else : ?>
							<button disabled>Добавлено в wishlist</button>
						<?php endif; ?>
					<?php endif; ?>

					<p>Цена: <?=$item['price']?></p>
					<p><a href="goodsAllInfo.php?id=<?=$item['id']?>">Смотреть полностью...</a></p>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</main>
	<?php require_once "include/footer.php" ?>

</body>

</html>