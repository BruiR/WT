<!-- Бруй Роман -->
<!DOCTYPE html>
<html lang="ru">
<head> 
    <title>Лабораторная работа №4.</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./Laba.css"> 
</head>
<body>
    <header class="header-container">
        <h1 class="header-container__name">Лабораторная работа №4</h1>
    </header>
    <main>
        <div class="info-block">
                <p>Вариант 5: в произвольном тексте все URL'ы вывести красным цветом и привести к виду &lt;a
                href="URL"&gt;URL&lt;/a&gt;. Если до преобразования присутствовала человекочитаемая часть URL'а,
                выводить URL в виде &lt;a href="URL"&gt;URL; человекочитаемая_часть&lt;/a&gt;. Текст загружать из
                файла.</p>		
        </div>
        <div class="output-block">
        <?php
            function createURL($matches)
            {
                preg_match_all("/(\/[a-z0-9\-_]+)+[\/]*$/i", $matches[0], $h, PREG_PATTERN_ORDER);
                if (isset($h[0][0])) {				
                    $str="<a href =". $matches[0]." style=\"color:red;\">".$matches[0]."; ".$h[0][0]."</a>";
                }else{
                    $str="<a href =". $matches[0]." style=\"color:red;\">".$matches[0]."</a>";
                }
			    return $str; 
            }
			
            if (is_file('input.txt'))
            {
                $inputText = file_get_contents('input.txt');
                $pattern = "/\b((https?:\/\/(www\.|[a-z0-9\.]+\.[a-z]{2,6}|\/))[^\s()<>]+)/i";
                $inputText=preg_replace_callback($pattern,"createURL", $inputText);
                echo $inputText;
                file_put_contents("./text_out2.txt", $inputText);
            } else{
                echo "файл input.txt не найден";
            }						
        ?>
        </div>
    </main>	
</body>
</html>
