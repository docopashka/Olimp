<?php
	$email = filter_var(trim($_POST['email']),FILTER_SANITIZE_STRING);
	$password = filter_var(trim($_POST['password']),FILTER_SANITIZE_STRING);

	$password = md5($password."Bespalov");

	$mysql = new mysqli('localhost', 'root', 'root', 'bd');

	$result = $mysql->query("SELECT * FROM `users` WHERE `email` = '$email' AND `password` = '$password'");

	$user = $result->fetch_assoc();
	if(empty($user) or count($user) == 0){
		echo "Такой пользователь не найден";
		exit();
	}

	setcookie('user', $user['email'], time() + 3600, '/');

	$mysql->close();
	header('Location: ../profile.php');
?>
