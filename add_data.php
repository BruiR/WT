<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Лабораторная работа №5</title>
</head>
<body>
<?php
    $host = 'localhost'; 
    $user = 'root';
    $password = 'password';  //введите пароль
    $database = 'test_bd';    //введите бд     
    $tableName = 'tableName_laba5';	//введите имя таблицы

    function checkNameUniqueness($fieldsCount){
        for($i = 1; $i <= $fieldsCount-1; $i++){
            for ($j = $i+1; $j <= $fieldsCount; $j++){
                if ($_GET["field$i"] === $_GET["field$j"]){
                    return false;
                }
            }
        }
        return true;
    }
	
    function addRecords($tableName, $fieldsCount, $link){
        for ($i = 1; $i <= $_GET['records_ammount']; $i++){
            $requestText="INSERT INTO $tableName VALUES(NULL, ";
            for($j = 1; $j <= $fieldsCount; $j++){
                $type = $_GET["type$j"];
                if($type === "number"){
                    $requestText = $requestText.rand(0,10);   
                }
                else{
                    $requestText = $requestText."'".substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 5)."'";
                }
                if($j < $fieldsCount){
                    $requestText = $requestText.", ";
                }
            }
            $requestText = $requestText.")";
            $result = mysqli_query($link, $requestText); 
        }
    }
	
    function createTable($name,$fieldsCount,$link){
        $requestText ="CREATE Table $name (id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, ";
        for($i = 1; $i <= $fieldsCount; $i++){
            if($_GET["type$i"] === "number"){
                $requestText = $requestText.$_GET["field$i"]." INT(10) NOT NULL";                
            }
            else{
                $requestText = $requestText.$_GET["field$i"]." VARCHAR(10) NOT NULL";
            }
            if($i < $fieldsCount){
                $requestText = $requestText.", ";
            }
        }
        $requestText = $requestText.")";
        return mysqli_query($link, $requestText);
    }

    function delete_table($name, $link){
        $requestText ="DROP TABLE $name";
        return mysqli_query($link, $requestText); 
    }

    $fieldsCount = 1;
    while(isset($_GET["field$fieldsCount"])){
        $fieldsCount++;
    }
    --$fieldsCount;
    if(checkNameUniqueness($fieldsCount)){
        $bool = true;
        if( !$link = mysqli_connect($host, $user, $password, $database) ) {
            die('No connection: ' . mysqli_connect_error());
        }
        mysqli_set_charset($link, "utf8");
        $q = 'SELECT * FROM '.$tableName.' LIMIT 1';
        $mysql_table_check = mysqli_query($link, $q);
        if($mysql_table_check) { 
            echo 'Такая таблица есть, идет проверка на совпадение  количества полей <br>'; 
            $result = mysqli_query($link, "SELECT * FROM $tableName");
            $fields = mysqli_num_fields($result);
            if($fields ===  $fieldsCount+1){
                echo 'Количество полей совпадает с количеством полей в таблице <br>';
                $result = mysqli_query($link, "SELECT * FROM $tableName");
                for ($i=1; $i <= $fieldsCount; $i++) {
                    $finfo = mysqli_fetch_field_direct($result, $i);				
                    if (!($_GET["field$i"] == $finfo->name)){
                        $bool = false;
                        echo "$i -ое  имя не совпадает, таблица будет создана заново. <br>";
                    }
                    if (!(($finfo->type === 3)&&($_GET["type$i"] === "number")||(($finfo->type === 253)&&($_GET["type$i"] === "text")))){
                        $bool = false;
                        echo "$i -ый тип не совпадает, таблица будет создана заново. <br>";
                    }						
                }		
            }
            else{
                echo 'Количество полей не совпадает с количеством полей в таблице, таблица будет создана заново. <br>';
                $bool = false;
			}
			if (!$bool){
                delete_table($tableName, $link);
                if(createTable($tableName,$fieldsCount, $link)){					
                    echo "Таблица была удалена и создана заново <br>";
                    addRecords($tableName, $fieldsCount, $link);
                    echo " Добавлено в  таблицу ";					
                }
                else{
                    echo "Ошибка создания таблицы <br>";
                    exit;
                }				
			}
			else{
                addRecords($tableName, $fieldsCount, $link);
                echo " Добавлено в текущую таблицу ";
			}			
        }
        else{ 
            echo 'Такой таблицы нет, таблица будет создана. <br>'; 
            if(createTable($tableName,$fieldsCount, $link))
            {
                echo "Таблица создана ";
                addRecords($tableName, $fieldsCount, $link);
                echo " Добавлено в  таблицу ";				
            }
            else{
                echo "Ошибка создания таблицы <br>";
                exit;
            }			
        }		
        mysqli_close($link);
	}
    else{ 
        echo "Имена не уникальные <br>";
    }
?>
</body>
</html>