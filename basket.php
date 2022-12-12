<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<title>Рыболов Корзина</title>
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<?php require_once "include/header.php" ?>

	<main>
		<?php 
		include('db.php');
		$data = $_POST;
		?>
		<?php 
			if (isset($_SESSION['session_username'])) :
		?>
			<div class="basketForm">
		      <form action="basket.php" method="post">
		            <label for="fname">ФИО</label>
		            <input type="text" id="fname" name="firstname" placeholder="Иванов Иван Иванович" required>
		            <label for="phone">Телефон</label>
		            <input type="number" id="phone" name="phone" placeholder="81119994455" required min="80000000000" max="89999999999">
		            <label for="adr">Город</label>
		            <input type="text" id="adr" name="address" placeholder="Рязань" required>
		        	<button type="submit" class="registerbtn" name="orderbtn">Сделать заказ</button>
		      </form>
		    </div>
		<?php else : ?>
		<div class="registerHref">
			<p class="massages">Чтобы сделать заказ, <a href="enter.php">войдите</a>.</p>
		</div>
		<?php endif; ?>

	    <?php 
			if (!empty($_SESSION['shopCard'])) :
				if (isset($_GET['action'])) {
				    if ($_GET['action'] == 'delete') {
				        foreach ($_SESSION['shopCard'] as $key => $value) {
				            if ($value['id'] == $_GET['id']) {
				                unset($_SESSION['shopCard'][$key]);
				                echo '<script>alert("Товар удален")</script>';
				                echo '<script>window.location="basket.php"</script>';
				            }
				        }
				    }
				}
			$totalCost = 0;				
		?>
		<div class="basketTable">
			<table id="basketTable">
			<tr>
			    <td></td>
			    <td>Название</td>
			    <td>Количество</td>
			    <td>Цена за единицу</td>
			    <td></td>
			</tr>
			<?php 
				foreach ($_SESSION['shopCard'] as  $key => $value):
				$totalCost = $totalCost + $value['price'] * $value['count'];
			?>
			<tr>
			    <td><img src="img/equipment/<?=$value['img']?>" alt="Товар" style="width: 50px;"></td>
			    <td><?=$value['title']?></td>
			    <td><?=$value['count'] ?></td>
			    <td><?=$value['price']?> рублей</td>
			    <td class="deleteItem"><a href="basket.php?action=delete&id=<?=$value['id'] ?>">Удалить</a><br></td>		    
			</tr>
		<?php endforeach; ?>
			</table>
		</div>
		   	<?php 
		   	 	$number = 0;
		   	 	if (isset($data['orderbtn'])) {
					$firstname = $data['firstname'];
					$phone = $data['phone'];
					$address = $data['address'];
					$userEmail = $_SESSION['session_username'];
					$allPrice = $totalCost;
					$today = date("d.m.y");
					foreach ($_SESSION['shopCard'] as $key => $value) {
						$title = $value['title'];
						$countGoods = $value['count'];
						$costItem = $value['price'];
						$idGoods = $value['id'];
						$countDB =  mysqli_query($con, "SELECT * from `equipment` where `id` = '$idGoods' ");
						$countDB = mysqli_fetch_assoc($countDB);
						$lastCount =  $countDB['count'] - $countGoods;
						$result = mysqli_query($con, "UPDATE `equipment` SET `count` = '$lastCount' WHERE `id`='$idGoods'");

						$result = mysqli_query($con, "INSERT INTO `orders` (`userEmail`, `phone`, `fullName`, `goodsTitle`, `goodCount`, `goodPrice`, `allPrice`, `address`, `date`, `execution`) VALUES ('$userEmail', '$phone', '$firstname', '$title', '$countGoods', '$costItem', '$allPrice', '$address', '$today', '0')");

						$number = 1;
					}
					if ($number === 1) {
						unset($_SESSION['shopCard']);
						echo '<script>alert("Заказ оформлен, с вами свяжется администратор")</script>';
					    echo '<script>window.location="basket.php"</script>';
					}
		   	 	}
			?>
		   	<p class="totalCost">Общая стоимость: <?=$totalCost ?> рублей</p>
		<?php else : ?>
			<div class="registerHref">
				<p class="massages">В корзине пусто</a>.</p>
			</div>
		<?php endif; ?>


	</main>
	<?php require_once "include/footer.php" ?>

</body>

</html>