<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<title>Рыболов Заказы пользователей</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/slider.css">
</head>

<body>
	<?php require_once "header.php" ?>

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

		<?php $result = mysqli_query($con, "SELECT * FROM `orders` where `execution` = 0 group by `date`, `fullName`, `userEmail`"); ?>
		<div class="tableOrders">
			<table id="tableOrders">
			<caption>Заказы</caption>
			<tr>
			    <td>ФИО </td>
			    <td>Email и телефон</td>
			    <td>Город</td>
			    <td>Цена</td>
			    <td>Дата</td>
			    <td>Сожержимое заказа</td>
			    <td>Операция</td>
			</tr>
			<?php foreach($result as $item):
				$userEmail =  $item['userEmail'];
				$fullName =  $item['fullName'];
				$date = $item['date'];
			?>
			<tr>
			    <td><?=$item['fullName']?></td>
			    <td style="width: 140px;"><?=$item['userEmail']?>,<?=$item['phone']?></td>
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
			    <td style="min-width: 150px; text-align: center;">
			    	<form action="ordersNew.php" method="POST">
			    		<button type="submit" class="executeOrderBtn" name="executeOrder">Выполнить заказ</button>
			    		<input type="hidden" name="hiddenEmail" value="<?=$item['userEmail']?>">
			    		<input type="hidden" name="hiddenFullName" value="<?=$item['fullName']?>">
						<input type="hidden" name="hiddenDate" value="<?=$item['date']?>">
			    	</form>
			    </td>		    
			</tr>
			<?php endforeach; ?>
			</table>
		</div>

		<?php
			$data = $_POST;

			if (isset($data['executeOrder'])) {
				$updateValue = 0;
				$hiddenEmail = $data['hiddenEmail'];
				$hiddenDate = $data['hiddenDate'];
				$hiddenFullName = $data['hiddenFullName'];
				
				$search = mysqli_query($con, "SELECT * FROM `orders` where `date` = '$hiddenDate' and `userEmail` = '$hiddenEmail' and `fullName` = '$hiddenFullName'");
				foreach ($search as $value) {
					$id = $value['id'];
					$result = mysqli_query($con, "UPDATE `orders` SET  `execution` = 1 WHERE `id`='$id'");
					$updateValue = 1;
				}
				if ($updateValue === 1) {
				    echo '<script>window.location="ordersNew.php"</script>';
				}
			}
		?>


		<?php else :
			echo '<script>window.location="main.php"</script>';
		?>
		<?php endif; ?>
	</main>

	<?php require_once "footer.php" ?>
</body>

</html>