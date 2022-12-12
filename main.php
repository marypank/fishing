<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Рыболов</title>
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/slider.css">
</head>

<body>
	<?php require_once "include/header.php" ?>

	<main>
		<div id="slider">
			<div class="slides">
				<div class="slider">
					<div class="legend"></div>
					<div class="images">
						<img src="img/slider1.jpg">
					</div>
				</div>
				<div class="slider">
					<div class="legend"></div>
					<div class="images">
						<img src="img/slider2.jpg">
					</div>
				</div>
				<div class="slider">
					<div class="legend"></div>
					<div class="images">
						<img src="img/slider3.jpeg">
					</div>
				</div>
				<div class="slider">
					<div class="legend"></div>
					<div class="images">
						<img src="img/slider4.jpg">
					</div>
				</div>
			</div>
		</div>

		<div class="vertical-menu">
			<a href="main.php">Главная</a> <!-- class="active" -->
			<a href="about.php">О нас</a>
			<a href="delivery.php">Доставка и оплата</a>
			<a href="catalog.php">Каталог</a>
			<a href="basket.php">Корзина</a>
			<?php
				require_once "db.php";
				if (isset($_SESSION['session_username'])):
			?>
				<a href="wishlist.php">Wishlist</a>

				<?php if ($_SESSION['access'] === '0'): ?>
					<a href="register.php">Личный кабинет</a>
				<?php else: ?>
					<a href="enter.php">Личный кабинет</a>
				<?php endif; ?>

			<?php else: ?>
				<a href="enter.php">Вход/Регистрация</a>
			<?php endif; ?>
		</div>

		<div class="mainColumn">
			<div class="mainRow">
				<p>
				    Интернет магазин fishing.ru представляет рыболовные снасти и товары для туризма по самым низким розничным ценам в Рязани. Здесь можно купить все для зимней и летней рыбалки, активного отдыха. В каталоге вы найдете продукцию высокого качества, как отечественного производства, так и импортного.
				    Что мы предлагаем:
				</p>
				<ul style="margin-left: 40px;">
  					<li>теплую экипировку;</li>
  					<li>ящики, коробки, санки;</li>
  					<li>комплекты спиннингов;</li>
  					<li>летние и зимние снасти;</li>
  					<li>очки, легкая одежда, обувь;</li>
  					<li>сумки, чехлы;</li>
  					<li>спасательные жилеты;</li>
  					<li>лодки (разнообразные);</li>
				</ul>
				<p>Наши преимущества:</p>
				<ul style="margin-left: 40px;">
  					<li>Компания Fishing регулярно пополняет свой ассортимент, отслеживает появление новинок на мировом рынке. Благодаря сезонным распродажам наши клиенты всегда могут приобрести рыболовные снасти недорого (скидки достигают 50%).</li>
  					<li>Мы производим оперативную доставку продукции по всей стране. Заказчикам доступны несколько способов оплаты и доставки. Наш магазин рыболовных товаров принимает наличный, безналичный расчет, оплату банковскими картами, через виртуальные кошельки. Мы готовы доставить вам товар Почтой России или посредством популярных транспортных и курьерских служб.</li>
  					<li>Главное наше преимущество – честное и открытое отношение к клиентам. Каждый заказчик может публиковать свои отзывы и пожелания на сайте. Мы всегда рады прислушиваться к вашему мнению и пожеланиям, совершенствоваться и расти.</li>
				</ul>
			</div>
		</div>

	</main>

	<?php require_once "include/footer.php" ?>
</body>

</html>