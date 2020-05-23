<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Лабораторная работа №8</title>
</head>
<body>
    <h1>Вариант 5</h1>
    <p>Написать скрипт, собирающий статистику по ip-адресам, с которых посетители
заходили на сайт. Выводить результаты в виде HTML-таблицы со списком ip-аресов, 
отсортированным по убыванию количества посещений с каждого адреса. 
    </p>
<?php
    $host = 'localhost';
    $database = 'test_bd';
    $user = 'root';
    $password = 'password';
    $tableName = 'laba8';
    if( $link = mysqli_connect($host, $user, $password, $database)){
        mysqli_set_charset($link, "utf8");
        $ipAdr = $_SERVER['REMOTE_ADDR'];
        $query ="SELECT * FROM $tableName WHERE IP_address ='$ipAdr'";
        if ($note = mysqli_query($link, $query)) {
            if (mysqli_fetch_array($note)) {
                $query = "UPDATE $tableName SET visitsCount = visitsCount + '1' WHERE IP_address = '$ipAdr'";
                if (!$result = mysqli_query($link, $query)) {
					echo "Ошибка выполнения";
                    mysqli_free_result($result);
                }
            } else {
                $query = "INSERT INTO $tableName VALUES (NULL, '$ipAdr', '1')";
                if (!$result = mysqli_query($link, $query)) {
                    echo 'Ошибка выполнения';
                    mysqli_free_result($result);
                }
            }
        }else {
            echo 'Ошибка выполнения';
            mysqli_free_result($result);
        }		
        $query = "SELECT IP_address,visitsCount FROM $tableName ORDER BY visitsCount DESC";
        if ($Table = mysqli_query($link, $query)) {
            echo '<table border=2>';
            echo '<tr><td>IP adress</td><td>visitsCount</td></tr>';
            while ($row = mysqli_fetch_array($Table)) {
                echo '<tr>';
                echo '<td>'.$row['IP_address'].'</td><td>'.$row['visitsCount'].'</td>';
                echo '</tr>';
            }
            echo '</table>';
        }else {
            echo 'Ошибка выполнения';
            mysqli_free_result($result);
        }
        mysqli_close($link);
    }
    else{
        echo "Ошибка  подключения";
    }	
?>
</body>
</html>