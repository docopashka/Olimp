<?php
	$firstname = filter_var(trim($_POST['firstname']),FILTER_SANITIZE_STRING);
	$lastname = filter_var(trim($_POST['lastname']),FILTER_SANITIZE_STRING);
	$patronymic = filter_var(trim($_POST['patronymic']),FILTER_SANITIZE_STRING);
	$email = $_COOKIE['user'];
	$tel = filter_var(trim($_POST['tel']),FILTER_SANITIZE_STRING);
	$lastpass = filter_var(trim($_POST['lastpass']),FILTER_SANITIZE_STRING);
  	$newpass = filter_var(trim($_POST['newpass']),FILTER_SANITIZE_STRING);
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
	if(mb_strlen($city)<1 || mb_strlen($city)>50){
		echo "Поле город не правильно заполнено";
		exit();
	}
	if($status == 'Статус'){
		echo "Поле статус не правильно заполнено";
		exit();
	}

	require_once 'db.php';
	if(strlen($lastpass) > 0 and strlen($newpass) > 0){
		if(mb_strlen($lastpass)<3 || mb_strlen($lastpass)>25){
			echo "Поле старый пароль не правильно заполнено";
			exit();
		}
		if(mb_strlen($newpass)<3 || mb_strlen($newpass)>25){
			echo "Поле новый пароль не правильно заполнено";
			exit();
		}
		$lastpass = md5($lastpass."Bespalov");
  		$newpass = md5($newpass."Bespalov");
		$result = $mysql->query("SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$lastpass'");
		$user = $result->fetch_assoc();
		if(empty($user) or count($user) == 0){
			echo "Неверный пароль";
			exit();
		}
		mysqli_query($mysql, "UPDATE users SET firstname = '$firstname', lastname = '$lastname', patronymic = '$patronymic', tel = '$tel', password = '$newpass', city = '$city', 
			status = '$status', date = '$date', ser = '$ser', nom = '$nom', org = '$org', datepass = '$datepass', snils = '$snils' WHERE email = '$email'");
	}else{
		mysqli_query($mysql, "UPDATE users SET firstname = '$firstname', lastname = '$lastname', patronymic = '$patronymic', tel = '$tel', city = '$city', 
			status = '$status', date = '$date', ser = '$ser', nom = '$nom', org = '$org', datepass = '$datepass', snils = '$snils' WHERE email = '$email'");
	}
	$mysql->close();
	header('Location: ../profile.php');
?>
