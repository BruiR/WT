<!-- Бруй Роман -->
<!DOCTYPE html>
<html lang="ru">
<head> 
	<title>Магазин комплектующих"</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="./css/Main.css">
	<link rel="shortcut icon" href="images/icon_logo.ico" type="image/x-icon">

</head>
<body>
	<header class="header-container">
		<img class="header-container__image" src="images/logo_img.png" align="left" alt="" >
		<h1 class="header-container__name">Магазин комплектующих для ПК</h1>
		<nav class="header-container__pages">
			<?php include "Pages.php"; ?>				
		</nav>
	</header>
	<main>
		<div class="info-block">
			<h2  class="info-block__tagline">Тот, у кого есть компьютер, располагает всеми опубликованными знаниями</h2>
			<h2 class="info-block__tagline">Покупая компьютерные комплектующие в нашем интернет - магазине, Вы экономите на цене и времени!.</h2>
			<article class="info-block__article">
				<p>Мы рады приветствовать вас на сайте нашего магазина. Сегодня компьютер - это неотъемлемая часть жизни каждого 
				человека, потому важно правильно подобрать комплектующие. Наш магазин представляет широкий 
				выбор процессоров и материнских плат для вашего ПК.</p>
				<strong>Почему стоит выбрать имеено наш магазин?</strong>
				<ul>
				<li>В первую очередь наш интернет-магазин — это удобной сервис с хорошими условиями для покупки и
				надежными товарами. </li>
				<li>Наши квалифицированные консультанты помогут всем клиентам подобрать устройство в зависимости от предъявленных 
				требований и бюджета, делая каждую покупку разумной, рациональной и выгодной.</li>
				</ul>				
			</article>
		</div>
		<form class="form-container">
			<p><b>Какая видеокарта является лучшей  по цене/качество?</b></p>
			<input class="form-container__input" type="radio" name="graphics_card" value="rtx2080"> RTX 2080<br>
			<input class="form-container__input" type="radio" name="graphics_card" value="gtx1070"> GTX 1070<br>
			<input class="form-container__input" type="radio" name="graphics_card" value="gtx1080"> GTX 1080<br>
	        <label class="form-container__label" for="email">Введите вашу почтуl:</label><br>
			<input class="form-container__input" type="email" name="contact-info" id="email"><br>
			<label class="form-container__label" for="message">Отправьте нам пожелания:</label><br>
			<textarea class="form-container_message" name="message" id="message" cols="60" rows="10"></textarea><br>		
			<p><input type="submit" value="Отправить"></p>
		</form>
	</main>	
	<footer> 
		<p>Brui Roman</p>
	</footer>
</body>
</html>
