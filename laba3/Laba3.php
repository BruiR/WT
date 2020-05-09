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
		<h1 class="header-container__name">Лабораторная работа №3</h1>
	</header>
	<main>
		<div class="info-block">
            <article class="info-block__article">
                <p>Вариант 5: написать функцию, формирующую календарь на год. Календарь представить в виде
HTML-таблицы, в которой основные праздники отображаются жирным красным шрифтом, и
отобразить подсказку (hint). Год, за который следует формировать календарь, получать через
веб-форму. Сохранить результат в текстовый html-файл для последующего просмотра в браузере</p>				
            </article>
        </div>
        <form class="form-container" method="post">
            <p><b>Введите год</b></p>
            <input class="form-container__input" type="text" name="input_number" id="input_number2" required pattern="[0-9]+" ><br>		
            <p><input type="submit" value="Отправить"></p>
        </form>
		
        <div class="form-output">
        <?php
            function isThisDayHoliday($holidaysList, $month, $day) {
                foreach ($holidaysList as $value){
                    if (($value[0] === $month) and ($value[1] === $day)) {
                        return $value[2];
                    }
                }	
            }
			
            function createHtmlFile(&$HtmlCode) {
				file_put_contents("./calendar.html","<!DOCTYPE html>                            
                            <head>
                                <meta charset=\"utf-8\">
                                <title>Calendar</title>
                            </head>
                                <body>". $HtmlCode ."</body>
                            </html>");
            }
			
            function addMonthToCalendar(&$HtmlCode, $holidaysList, $calendarForMonth, $countOfWeeks, $month, $year) {				
                $HtmlCode .=  "<h3>".date('F',mktime(0, 0, 0, $month, 1, $year) )."</h3> <table border=\"1\" bgcolor=\"white\">";
                for($week = 1; $week < $countOfWeeks; $week++) {
                    $HtmlCode .= "<tr>";
                    for($day = 1; $day <= 7; $day++) {
                        if(!empty($calendarForMonth[$week][$day])) {							
                            if (isThisDayHoliday($holidaysList, $month, $calendarForMonth[$week][$day])){
                                $nameOfHoliday = isThisDayHoliday($holidaysList, $month, $calendarForMonth[$week][$day]);
                                $HtmlCode .= "<td bgcolor=\"NavajoWhite\"><strong><font title=\"". $nameOfHoliday ."\" color=\"red\">".$calendarForMonth[$week][$day]."</strong></font></td>";
                            }elseif(($day == 6) or ($day == 7)){
                                $HtmlCode .= "<td bgcolor=\"NavajoWhite\"><font >".$calendarForMonth[$week][$day]."</font></td>";
                            }else{
                                $HtmlCode .= "<td>".$calendarForMonth[$week][$day]."</td>";
                            }
                        }
                        else{
                            $HtmlCode .= "<td></td>";
                        }
                    }
                    $HtmlCode .= "</tr>";
                }
                $HtmlCode .= "</table>";
            }

		
        if (isset($_POST["input_number"])) {
            $holidaysList = array(
                array(1, 1, "Новый год"),
                array(1, 7, "Рождество Христово (православное)"),
                array(2, 23, "День защитника отечества"),
                array(3, 8, "День женщин"),
                array(5, 1, "Праздник  труда"),
                array(5, 9, "День победы"),
                array(7, 3, "День Независимости Республики Беларусь"),
                array(11, 7, "День Октябрьской революции"), 
                array(12, 25, "Рождество Христово (католическое)"),
            );			
			
            $year = $_POST["input_number"];
            $HtmlCode = "<h1>".$year." Calendar </h1>";
            for ($month = 1; $month <= 12; $month++) { 
                $dayNumber = 1;
                $countOfWeeks = 1;
                $calendarForMonth = array();
                $daysInMonth = date('t', mktime(0, 0, 0, $month, 1, $year));				
                $dayOfWeek = date('w', mktime(0, 0, 0, $month, 1, $year));
                if($dayOfWeek == 0) {
                    $dayOfWeek = 7;
                } 
				
				//для 1-ой недели 
                for($day = $dayOfWeek; $day <= 7; $day++) {
                    $calendarForMonth[$countOfWeeks][$day] = $dayNumber;
                    $dayNumber++;
				} 				
				//для след. недель;
                $countOfWeeks++;
                while ($dayNumber <= $daysInMonth) {
                    $day = 1;
                    while(($day <= 7)and($dayNumber <= $daysInMonth)) {
                        $calendarForMonth[$countOfWeeks][$day] = $dayNumber;
                        $dayNumber++;						
                        $day++;
                    }
                    $countOfWeeks++;
                }
                addMonthToCalendar($HtmlCode, $holidaysList, $calendarForMonth, $countOfWeeks, $month, $year);
            }
            echo $HtmlCode;
            createHtmlFile($HtmlCode);               
        }
        ?>
        </div>
    </main>	

</body>
</html>
