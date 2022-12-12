<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<title>Рыболов Wishlist</title>
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
		<div class="welcome">
			<p>Добро пожаловать,   <?php echo $_SESSION['name']; ?>! </p>
			<p><a href="logout.php">Выйти</a></p>
		</div>

		<?php
            $email = $_SESSION['session_username'];

            $userWishlist = mysqli_query($con, "SELECT * FROM `user_equipment` where `user_id` = (SELECT `id` FROM `users` where `email` = '$email')");
            $wishes = [];
            foreach($userWishlist as $item) {
                $wishes[] = (int)$item['eq_id'];
            }
            $elems = implode(',', $wishes);

            if ($elems) {
                $result = mysqli_query($con, "SELECT * FROM `equipment` where id in ($elems)");
            }
        ?>

        <?php if (!$elems): ?>
            <div class="registerHref">
                <p class="massages">В вашем wishlist пусто.</p>
            </div>
        <?php else : ?>
            <div class="tableWarehouse">
                <table id="tableWarehouse">
                    <caption>Wishlist</caption>
                    <tr>
                        <td> Наименование </td>
                        <td> Цена </td>
                        <td> Описание </td>
                        <td> Тип </td>
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
                        <td><img src="img/equipment/<?=$item['img']?>" alt="Рыболов" style="max-width: 200px;"></td>
                        <td style="word-wrap:break-word; min-width: 200px;">
                            <form action="add_to_wishlist.php" method="POST">
								<input type="hidden" value="delete" name="action" id="action">
								<input type="hidden" value="<?=$item['id']?>" name="eq_id" id="eq_id">
								<button type="submit">Удалить из wishlist</button>
							</form>
                        </td>		    
                    </tr>
                    <?php endforeach; ?>
                </table>
		    </div>
        <?php endif ?>

	</main>

	<?php require_once "include/footer.php" ?>
</body>

</html>