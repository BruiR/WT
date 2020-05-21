<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Лабораторная работа №5</title>
</head>
<body>
    <form method="GET" action="add_data.php">
        <?php
            if(isset($_GET['fields_count'])){
                $fieldsCount = $_GET['fields_count'];
                for($i = 1; $i<=$fieldsCount; $i++){
                    echo "<p> Поле № ".$i.": 
                        <input type='text' name='field$i' required> 
                        <input type='radio' name='type$i' value='text' required> Текст
                        <input type='radio' name='type$i' value='number' required> Число
                        </p>";
                }
                echo "<p> Количество записей : <input type='text' name='records_ammount' required pattern='[0-9]+'> </p>";
                echo "<input type='submit' value='Отправить'>";
            }
        ?>
    </form>
</body>
</html>