<!DOCTYPE html>
<html lang="en">
<head>
	<title>Магазин комплектующих"</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="./css/Questions.css">
	<link rel="shortcut icon" href="images/icon_logo.ico" type="image/x-icon">
</head>
<body>
	<header class="header-container">
		<h1 class="header-container__name">Магазин комплектующих для ПК</h1>
		<nav class="header-container__pages">
			<?php include "Pages.php"; ?>
		</nav>
	</header>
    <main class="questions-block">
		<h1 class="questions-block__header">Часто задаваемые вопросы</h1>
		<section class="questions-block__section">
			<h2 class="questions-block__section_question">Можно ли сделать предзаказ?</h2>
			<p class="questions-block__section_answer">Да, конечно. Вы можете сделать предзаказ на определённую дату, позвонив по контактным номерам. </p>
			<img class="questions-block__section_image" src="images/zakaz.png" alt="">
		</section>
	    <section class="questions-block__section">
			<h2 class="questions-block__section_question">Существуют ли скидки?</h2>
			<p class="questions-block__section_answer">Да. При покупке от 50 рублей вы получаете дисконтную карту на скидку 10% в подарок! </p>
			<img class="questions-block__section_image" src="images/discount.png" alt="">
		</section>
	    <section class="questions-block__section">
			<h2 class="questions-block__section_question">Можно ли оплатить заказ картой?</h2>
			<p class="questions-block__section_answer">Да. Вы можете оплатить свой заказ через любую платёжную систему. </p>
			<img class="questions-block__section_image" src="images/chek.png" alt="">
		</section> 
    </main>
    <footer>
     		<p>Brui Roman</p>
    </footer>
</body>
</html>