<?php
	$firstname = filter_var(trim($_POST['firstname']),FILTER_SANITIZE_STRING);
	$lastname = filter_var(trim($_POST['lastname']),FILTER_SANITIZE_STRING);
	$patronymic = filter_var(trim($_POST['patronymic']),FILTER_SANITIZE_STRING);
	$email = filter_var(trim($_POST['email']),FILTER_SANITIZE_STRING);
	$tel = filter_var(trim($_POST['tel']),FILTER_SANITIZE_STRING);
	$password = filter_var(trim($_POST['password']),FILTER_SANITIZE_STRING);
	$password_confirm = filter_var(trim($_POST['password_confirm']),FILTER_SANITIZE_STRING);
	$city = filter_var(trim($_POST['city']),FILTER_SANITIZE_STRING);
	$status = filter_var(trim($_POST['status']),FILTER_SANITIZE_STRING);
	$date = $_POST['date'];//filter_var(trin($_POST['date']),FILTER_SANITIZE_STRING);
	$ser = filter_var(trim($_POST['ser']),FILTER_SANITIZE_STRING);
	$nom = filter_var(trim($_POST['nom']),FILTER_SANITIZE_STRING);
	$org = filter_var(trim($_POST['org']),FILTER_SANITIZE_STRING);
	$datepass = $_POST['datepass'];
	$snils = filter_var(trim($_POST['snils']),FILTER_SANITIZE_STRING);

	if(mb_strlen($firstname)<1 || mb_strlen($firstname)>25){
		echo "Поле имя не правильно заполнено";
		exit();
	}
	if(mb_strlen($lastname)<1 || mb_strlen($lastname)>25){
		echo "Поле фамилия не правильно заполнено";
		exit();
	}
	if(mb_strlen($patronymic)>25){
		echo "Поле отчество не правильно заполнено";
		exit();
	}
	if(mb_strlen($email)<1 || mb_strlen($email)>25){
		echo "Поле E-mail не правильно заполнено";
		exit();
	}
	if(mb_strlen($tel)<12 || mb_strlen($tel)>12){
		echo "Поле телефон не правильно заполнено";
		exit();
	}
	if(mb_strlen($password)<3 || mb_strlen($password)>25){
		echo "Поле пароль не правильно заполнено";
		exit();
	}
	if(mb_strlen($password_confirm)<3 || mb_strlen($password_confirm)>25){
		echo "Поле подтвердите пароль не правильно заполнено";
		exit();
	} elseif ($password_confirm != $password) {
		echo "Пароль не подтвержден";
		exit();
	}
	if(mb_strlen($city)<1 || mb_strlen($city)>50){
		echo "Поле город не правильно заполнено";
		exit();
	}
	if($status == 'Статус'){
		echo "Поле статус не правильно заполнено";
		exit();
	}
	require_once 'db.php';
	$password = md5($password."Bespalov");

	//$mysql = new mysqli('localhost', 'root', 'root', 'bd');
	$result = $mysql->query("SELECT * FROM `users` WHERE `email` = '$email'");
	$user = $result->fetch_assoc();
	if(empty($user) or count($user) == 0){
		$mysql->query("INSERT INTO `users` (`firstname`, `lastname`, `patronymic`, `date`, `email`, `tel`, `password`,`email_confirmed`, `city`, `status`, `ser`, `nom`, `org`, `datepass`, `snils`)
			VALUES('$firstname', '$lastname', '$patronymic', '$date', '$email', '$tel', '$password','1', '$city', '$status', '$ser', '$nom', '$org', '$datepass', '$snils')");
	} else {
		echo "Пользователь с такой почтой уже существует.";
		exit();
	}
	// Переменная $headers нужна для Email заголовка
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=utf-8\r\n";
	$headers .= "To: <".$email.">\r\n";
	$headers .= "From: <smit4276@mail.ru>\r\n";
	// Сообщение для Email
	$message = '
			<html>
			<head>
			<title>Подтвердите Email</title>
			</head>
			<body>
			<p>Что бы подтвердить Email, перейдите по <a href="http://example.com/confirmed.php?">ссылка</a></p>
			</body>
			</html>
			';
	mail($email, "Подтвердите Email на сайте", $message, $headers);
	// проверяет отправилась ли почта
	if (mail($email, "Подтвердите Email на сайте", $message, $headers)) {
		// Если да, то выводит сообщение
		echo 'Подтвердите на почте';
	} else{
		//echo 'Потерпели неудачу, при отправке';
		$errorMessage = error_get_last()['message'];
		print_r($errorMessage);
	}

	$mysql->close();
	header('Location: ../profile.php');
?>
