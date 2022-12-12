<div>
	<header>
		<div class="wrapper">
			<div class="logo">
				<a href="main.php"><img src="img/boat.png"></a>
			</div>
			<nav>
				<a href="main.php">Главная</a>
				<!-- <div class="dropdown">
					<button class="dropbtn">Новости</button>
					<div class="dropdown-content">
						<a href="about.php">О нас</a>
						<a href="delivery.php">Доставка и оплата</a>
					</div>
				</div> -->
				<a href="about.php">О нас</a>
				<a href="delivery.php">Доставка и оплата</a>
				<a href="catalog.php">Каталог</a>
				<!-- <div class="dropdown">
					<button class="dropbtn">Магазин</button>
					<div class="dropdown-content">
						<a href="fishEquipment.php">Рыболовная оснастка</a>
						<a href="rods.php">Спининги/Удилища/Удочки</a>
						<a href="equipment.php">Экипировка</a>
						<a href="boat.php">Лодки/Катера</a>
					</div>
				</div> -->
				<?php
					require_once "db.php";
					if (isset($_SESSION['session_username'])):
				?>
					<a href="basket.php">Корзина</a>
					<a href="wishlist.php">Wishlist</a>

					<?php if ($_SESSION['access'] === '0'): ?>
						<a href="register.php">Личный кабинет</a>
					<?php else: ?>
						<a href="enter.php">Личный кабинет</a>
					<?php endif; ?>

				<?php else: ?>
					<a href="basket.php">Корзина</a>
					<a href="enter.php">Вход/Регистрация</a>
				<?php endif; ?>
			</nav>
		</div>
	</header>
</div>