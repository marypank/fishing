<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8">
	<title>Рыболов О нас</title>
	<link rel="stylesheet" href="css/style.css">
	<style>
		.collapsible {
			background-color: #6da1ab;
			color: black;
			cursor: pointer;
			padding: 18px;
			margin: 20px 0 20px 0; 
			width: 100%;
			border: none;
			text-align: justify;
			outline: none;
			font-size: 18px;
		}
		.collapsible:after {
			content: '\002B';
			color: black;
			font-weight: bold;
			float: right;
			margin-left: 5px;
		}
		.active:after {
			content: "\2212";
		}
		.content {
			font-size: 18px;
			padding: 0 30px;
			max-height: 0;
			overflow: hidden;
			transition: max-height 0.2s ease-out;
		}
	</style>
</head>

<body>
	<?php require_once "header.php" ?>

	<main>
		<div class="rowDelivery" style="text-align: justify;">
				<p>Если вы заглянули к нам – значит вы любите природу и рыбную ловлю. В нашем интернет магазине вы найдете все, что может потребоваться как начинающему рыболову так и профессионалу: удилища и спиннинги; крючки и лески; прикормки и приманки; катушки и подставки под удочку; туристическое снаряжение и экипировку; чехлы и тубусы; садки и куканы; и множество других товаров, которые могут понадобиться заядлому рыбаку.
				Основной ассортимент нашего рыболовного магазина – это собственная продукция нашей компании Kaida, которая давно завоевала широкое признание среди рыбаков всего мира. Отличительная особенность товаров этой фирмы – доступная стоимость в сочетании с высоким качеством изготовления и используемых при этом материалов.</p>
				<p>Создавая наш интернет магазин, мы постарались по возможности облегчить людям, увлеченным рыбалкой, приобретение разнообразных рыболовных снастей, аксессуаров и снаряжения. Теперь совсем не обязательно тратить многие часы своего времени на посещение десятков магазинов – все, что вам потребуется, можно заказать в одном месте за несколько минут прямо из вашего дома или офиса.
				Каталог магазина «Рыболов», расположенный на нашем сайте, содержит детальное описание каждого товара. На наиболее популярные из них вы найдете также отзывы тех покупателей, которые уже смогли опробовать их на практике. Такой подход позволяет наглядно оценить достоинства и недостатки каждой снасти перед ее приобретением.</p>
				<p>Если у вас есть возможность и свободное время, вы можете посетить наши магазины, расположенные рядом с центром столицы, и «вживую» ознакомиться с нашим ассортиментом. Если же вы живете далеко от Рязани – к вашим услугам служба доставки Почты России, ЕМС Почты России, транспортной компании «Деловые линии» и компании СДЭК, готовые доставить ваш заказ в любой населенный пункт нашей страны.Также мы осуществляем доставку товара в Казахстан.</p>
		</div>

		<button class="collapsible">О доставке</button>
		<div class="content">
			<p>
				1) Доставка на пункт выдачи заказов: <br>
				Доставка транспортной компанией на более чем 500 пунктов выдачи по всей территории России. Ознакомиться с адресами пунктов в Вашем городе можно, связавшись с администратором (телефон находится на странице "О нас"). <br>
				Товар на пункте выдачи можно осмотреть перед оплатой. <br>
				*Бесплатная доставка в пункт самовывоза в Рязани при заказе от 2000 рублей.<br>
				2) Доставка курьером: <br>
				Доставка осуществляется курьером по удобному для Вас адресу. Товар можно осмотреть перед оплатой. <br>
				3) Доставка Почтой России: <br>
				Доставка осуществляется Почтой России на любое удобное для Вас отделение. Отправления как наложенным платежом, так и по предоплате на Ваш выбор. <br>
				4) Доставка EMS Почта России: <br>
				Доставка осуществляется экспресс службой Почты России.
			</p>
		</div>
		<button class="collapsible">Об оплате</button>
		<div class="content">
			<p>
				Оплатить заказ можно следующими способами: <br>
				1) При получении на пункте выдачи или же курьером:<br>
				Оплата производится при получении заказа после его полной проверки.<br>
				2) Наложенный платеж Почта России:<br>
				Вы оплачиваете полную стоимость товара и сумму доставки в отделении Почты России при получении заказа.
				*Почта России взимает 4-8% комиссии от стоимости заказа за операции по наложенному платежу.<br>
				3) Банковской картой/Яндекс деньги:<br>
				Заказ можно оплатить онлайн на сайте после его подтверждения. Оплата возможна банковской картой, а также через систему Яндекс деньги.<br>
				4) Оплата банковским переводом:<br>
				Предоплата заказа после его подтверждения. Мы высылаем Вам счет для оплаты, который можно оплатить в ближайшем отделении Сбербанка или же в терминале самообслуживания через QR-код.<br>
				5) Выставление счета (для юр. лиц):<br>
				При оформлении заказа на юр. лицо мы можем выставить счет для предоплаты заказа. Все данные запросит менеджер при подтверждении заказа.
			</p>
		</div>
		<button class="collapsible">Гарантия</button>
		<div class="content">
			<p>
				Уважаемый Покупатель! <br>
				Мы рады, что Вы выбрали интернет-магазин Рыболов! Очень надеемся, что наши услуги Вам понравятся, и в дальнейшем не возникнет никаких проблем с купленным у нас товаром. Просим Вас прочитать эту памятку, во избежание недоразумений.
				В соответствии со статьей 18 Закона РФ «О защите прав потребителей» в отношении технически сложного товара потребитель в случае обнаружения в нем недостатков вправе отказаться от исполнения договора купли-продажи и потребовать возврата уплаченной за такой товар суммы либо предъявить требование о его замене на товар этой же марки (модели, артикула) или на такой же товар другой марки (модели, артикула) с соответствующим перерасчетом покупной цены в течение пятнадцати дней со дня передачи потребителю такого товара. <br>
				По истечении этого срока указанные требования подлежат удовлетворению в одном из следующих случаев:<br>
				- обнаружение существенного* недостатка товара;<br>
				- нарушение установленных сроков устранения недостатков товара;<br>
				- невозможность использования товара в течение каждого года гарантийного срока в совокупности более чем тридцать дней вследствие неоднократного устранения его различных недостатков.<br>
				*существенный недостаток товара - неустранимый недостаток или недостаток, который не может быть устранен без несоразмерных расходов или затрат времени, или выявляется неоднократно, или проявляется вновь после его устранения, или другие подобные недостатки (из преамбулы к Закону РФ «О защите прав потребителей»)<br>
				Далее все согласно Закону РФ "О защите прав потребителей". В соответствии с п. 5 ст. 18 Закона "О защите прав потребителей" Продавец вправе, вне зависимости от желания Потребителя, провести проверку качества и экспертизу товара в сервисном центре.<br>
				Xотим обратить Ваше особое внимание на то, что выбранный Вами производитель, а не продавец, закладывает в свою продукцию качество товара, в том числе сроки ремонта и получение необходимых заключений.<br>
				Возврат денежных средств, за приобретенный товар ненадлежащего качества<br>
				Согласно Закону РФ "О защите прав потребителей". В соответствии с ст. 22 Закона "О защите прав потребителей" возврат денежных средств, за приобретенный товар не надлежащего качества осуществляется в течении 10 дней с даты предъявления покупателем требования.
			</p>
		</div>

		<script type="text/javascript">
			var coll = document.getElementsByClassName("collapsible");
			var i;

			for (i = 0; i < coll.length; i++) {
				// обработчик события
			  coll[i].addEventListener("click", function() {
				  // добавляет, убирает
			    this.classList.toggle("active");
			    var content = this.nextElementSibling;
			    if (content.style.maxHeight){
			      content.style.maxHeight = null;
			    } else {
			      content.style.maxHeight = content.scrollHeight + "px";
			    } 
			  });
			}
		</script>

	</main>
	<?php require_once "footer.php" ?>


</body>

</html>