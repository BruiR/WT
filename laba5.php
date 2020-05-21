<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Лабораторная работа №5</title>
</head>
<body>
    <p>Вариант 5: написать скрипт, позволяющий добавить в произвольную таблицу БД произвольное
    количество записей со случайными данными. Скрипт должен получать в качестве входных
    данных имена и типы ("число" или "текст") полей таблицы, а также количество добавляемых
    записей.</p>	
<form method="GET" action="fill_values.php">
    Введите колличество полей: 
    <input type="text" name="fields_count" required pattern="[0-9]+"> 
    <input type="submit" value="Отправить">
</form>

</body>
</html>