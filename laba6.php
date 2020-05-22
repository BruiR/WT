<?php
$colorsArray = array(
    array("color" => "White", "text" => "Белый"),
    array("color" => "Black", "text" => "Черный"),
    array("color" => "ForestGreen", "text" => "Зеленый"),
    array("color" => "Red", "text" => "Красный"),
    array("color" => "Gold", "text" => "Золотой"),
    array("color" => "Cyan", "text" => "Голубой")
);
	
$sizesArray = array(
    array("size" => "18px", "text" => "18px"),
    array("size" => "24px", "text" => "24px"),
	array("size" => "28px", "text" => "28px"),
    array("size" => "36px", "text" => "36px"),
    array("size" => "148px", "text" => "148px"),
    array("size" => "48px", "text" => "48px")
);

function createList($value, $text, $SetValue)
{
    if (!$SetValue) {
        echo "<option value='$value'>$text</option>";
    } else {
        echo "<option selected value='$value'>$text</option>";
    }
}


function checkRelevance($value, $standardValue)
{
    if (isset($_POST[$value])) {
        $_SESSION[$value] = $_POST[$value];
    } 
    elseif (!isset($_SESSION[$value])) {        
        $_SESSION[$value] = $standardValue;
        }  
}	

session_start();
checkRelevance("backgroundColor", "white");
checkRelevance("mainColor", "black");
checkRelevance("mainSize", "28px");
checkRelevance("headlineColor", "black");
checkRelevance("headlineSize", "48px");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Лаба6</title>
    <style>
    <?php
    echo "body {background-color:".$_SESSION["backgroundColor"].";}";
    echo "h1 {font-size: ".$_SESSION["headlineSize"]."; color:".$_SESSION["headlineColor"].";} ";
    echo "p {font-size: ".$_SESSION["mainSize"]."; color:".$_SESSION["mainColor"]."; } ";
    ?>
	</style>
</head>
<body>
    <h1>Вариант 5</h1>
    <p>Выведите форму со списками выбора цвета фона страницы, размера и цвета
    основного шрифта и заголовка. При отправке соответствующих значений они должны сохраниться в SESSION пользователя. Сразу после отправки формы, а также и без отправки (например, при перезагрузке страницы или повторном вызове скрипта через некоторое время), если уже
    есть соответствующая сессия, должны быть установлены ранее заданные параметры стилей
    страницы.
    </p>
<form action="laba6.php" method="post">
    <p>Фон страницы
        <select name="backgroundColor">
            <?php
            foreach ($colorsArray as $key) {
                createList($key["color"], $key["text"], $key["color"] === $_SESSION["backgroundColor"]);
            }
            ?>
        </select>
    </p>
    <p>Цвет основного текста
        <select name="mainColor">
            <?php
            foreach ($colorsArray as $key) {
                createList($key["color"], $key["text"], $key["color"] === $_SESSION["mainColor"]);
            }
            ?>
        </select>		
    </p>
    <p>Цвет заголовка
        <select name="headlineColor">
            <?php
            foreach ($colorsArray as $key) {
                createList($key["color"], $key["text"], $key["color"] === $_SESSION["headlineColor"]);
            }
            ?>
        </select>		
    </p>
    <p>Размер основного текста
        <select name="mainSize">
            <?php
            foreach ($sizesArray as $key) {
                createList($key["size"], $key["text"], $key["size"] === $_SESSION["mainSize"]);
            }
            ?>
        </select>		
    </p>
    <p>Размер заголовка
        <select name="headlineSize">
            <?php
            foreach ($sizesArray as $key) {
                createList($key["size"], $key["text"], $key["size"] === $_SESSION["headlineSize"]);
            }
            ?>
        </select>		
    </p>
    <p><input type="submit" value="Применить"></p>
</form>
</body>
</html>