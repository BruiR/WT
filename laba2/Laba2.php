<!-- Бруй Роман -->
<!DOCTYPE html>
<html lang="ru">
<head> 
    <title>Магазин комплектующих"</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/Laba.css">
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
			<article class="info-block__article">
                <p>Вариант 5: Введите через поле ввода строку состоящую из слов разделенных запятой (например,
'Один, два, три, четыре, пять.'). Первое слово начинается с большой буквы, в конце точка.
Расставьте слова в обратном порядке. Выведите строку. Только первое слово новой строки
должно начинаться с большой буквы, в конце предложения точка.</p>				
            </article>
        </div>
        <form class="form-container" method="post">
            <p><b>Введите строку</b></p>
            <input class="form-container__input" type="text" name="input_text" id="input_text" required pattern="[A-ZА-Я][a-zа-я]*,\s([a-zа-я]+,\s)*[a-zа-я]+\." ><br>		
            <p><input type="submit" value="Отправить"></p>
        </form>
		
        <div class="form-output">
        <?php
        if (isset($_POST["input_text"])) {
            $inputString = mb_strtolower($_POST["input_text"], "utf-8");
            $inputString = mb_substr($inputString, 0, -1);
            $wordsArray = explode(", ", $inputString);
            $wordsArray = array_reverse($wordsArray);
            $outputString = implode(", ", $wordsArray);
            $outputString=mb_strtoupper(mb_substr($outputString, 0, 1 ), "utf-8").mb_substr($outputString, 1, NULL );;
            $outputString .=".";
            echo $outputString;           
        }
        ?>
        </div>
    </main>	

</body>
</html>
