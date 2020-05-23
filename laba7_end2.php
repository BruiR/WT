<?php

error_reporting(0);
function sendMail($to, $From, $topic, $message)
{
	$boundary = "--".md5(uniqid(time())); 
	$EOL = "\r\n"; 
	$subject = '=?utf-8?B?' . base64_encode($topic) . '?=';
	$headers = "MIME-Version: 1.0;$EOL";   
	$headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"$EOL";  
	$headers .= "From: $From\nReply-To: $to\n";  
	$mail_message  = "--$boundary$EOL";   
	$mail_message .= "Content-Type: text/html; charset=utf-8$EOL";   
	$mail_message .= "Content-Transfer-Encoding: base64$EOL";   
	$mail_message .= $EOL; 
	$mail_message .= chunk_split(base64_encode($message));   
	foreach($_FILES["filesList"]["name"] as $key => $value){
		$filename = $_FILES["filesList"]["tmp_name"][$key];
		$file = fopen($filename, "rb");
		$data = fread($file,  filesize( $filename ) );
		fclose($file);
		$NameFile = $_FILES["filesList"]["name"][$key];
		$File = $data;
		$mail_message .=  "$EOL--$boundary$EOL";   
		$mail_message .= "Content-Type: application/octet-stream; name=\"$NameFile\"$EOL";   
		$mail_message .= "Content-Transfer-Encoding: base64$EOL";   
		$mail_message .= "Content-Disposition: attachment; filename=\"$NameFile\"$EOL";   
		$mail_message .= $EOL;
		$mail_message .= chunk_split(base64_encode($File));   
	}
	$mail_message .= "$EOL--$boundary--$EOL";
	if(!mail($to, $subject, $mail_message, $headers)){
		echo 'Письмо не отправлено';
	}
	else{
		echo 'Письмо отправлено';
	}
}
	
function createCaptcha()
{
	$fontfile = "D:/arial.ttf";
	$captchaPath = "images/captcha.png";
	$captchaCode = random_int(1000, 9999);
	$_SESSION["captchaKey"]= $captchaCode;
	$captcha = imagecreatetruecolor(100, 40);
    $text = strval($captchaCode);
    $white = imagecolorallocate($captcha, 255, 255, 255);
    $black = imagecolorallocate($captcha, 0, 0, 0);
	imagefilledrectangle($captcha, 0, 0, 100, 40, $white);
	imagefttext($captcha, 24, 0, 10, 30, $black, $fontfile, $text);
	for($i=0;$i<1000;$i++) {
		imagesetpixel($captcha,rand()%100,rand()%40,$black);
	}
	imagepng($captcha, $captchaPath);	
}	
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Лаба7</title>
</head>
<body>
    <h1>Вариант 5</h1>
    <p>Написать скрипт, отправляющий полученное через форму письмо указанному
адресату. Письмо может содержать произвольное количество вложений (attachments). Для
подтверждения отправки создать текстовую и (или) графическую капчу.
    </p>
<?php
	session_start();
	if($_POST['captcha'] != $_SESSION['captchaKey']){
		echo "Введите капчу правильно <br>";
	}else {
	echo "Капча введена верно <br>";
		if ((isset($_POST['mail']))&& (isset($_POST['topic']))&& (isset($_POST['message']))) {
			$from = "laitevt@mail.ru";
			sendMail($_POST['mail'], $from, $_POST['topic'], $_POST['message']);		
		}
	}
createCaptcha();
?>	
	
<form enctype="multipart/form-data" action="laba7_end2.php" method="post">
	<label>Кому:</label>
	<input type = "email" name = "mail"  required ><br><br>
	<label>Заголовок:</label>
	<textarea name="topic" cols="24" rows="1" required></textarea><br><br>
	<label>Сообщение:</label><br>
	<textarea name="message" cols="35" rows="10" required></textarea><br><br>
	<label>Вложения <input type="file" name="filesList[]" multiple ></label>
	<h3>Проверчный код</h3>
	<img src = "images/captcha.png" >;
	<input type = "text" name = "captcha" required  >
	<input type = "submit" value = "Отправить" >
</form>
</body>
</html>

