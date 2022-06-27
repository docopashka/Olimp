<?php
    $q = $_POST['otv'];
    $id_stage = $_POST['id'];
    $ball = [];
    $email = $_COOKIE['user'];
    // Подключаем базу данных
    require_once('../validation/db.php');
    $result = $mysql->query("SELECT * FROM `users` WHERE `email` = '$email'");
    $user = $result->fetch_assoc();
    $filename = "Stage_".$id_stage."_ID_" . $user["id"] . "_" . $user["lastname"] . "_" . $user["firstname"] . '.txt';
    // проверка на наличие папки
    $dir = "../uploads/" . $user["id"] . "_" . $user["lastname"] . "_" . $user["firstname"];
    // создаем папку uploads в корне проекта, если её нет
    if (!is_dir($dir)) {
        mkdir(directory: $dir, permissions: 0777, recursive:true);
    }
    
    $test = mysqli_query($mysql, "SELECT `numb_quest` FROM `stage` WHERE `id_stage` = '$id_stage'");
    $n = mysqli_fetch_row($test);
    $n = $n[0];
    $resultat = $mysql->query("SELECT `answer`, `ball` FROM `question` WHERE `id_stage` = '$id_stage'");
    $answer = mysqli_fetch_all($resultat);

    for ($i=0; $i < $n; $i++) { 
        if ($q[$i] == $answer[$i][0] && $q[$i] != '') {
            $ball[$i] = $answer[$i][1];
        }
        else {
            $ball[$i] = 0;
        }
    }

    $z=fopen($dir . "/" . $filename,'at') or die('Проблема!');
    flock($z,2);
    fputs($z,"ID: ".$user["id"]." | ".$user["lastname"]." ".$user["firstname"].
        " | ".date('d-m-Y')." | Сумма баллов: " . array_sum($ball) . "\n");
    for($i = 0;$i<$n;$i++){
        fputs($z, "Задание " . $i+1 . ": | Баллы: " . $ball[$i] . "\n");
        fputs($z, $q[$i] . "\n");
    }
    flock($z,3);
    fclose($z);
    
    // Подключаем файл для загрузки файлов на Яндекс.Диск
    require_once('drive.php');

    mysqli_query($mysql, "UPDATE users SET test = 1 WHERE email = '$email'");
    $mysql->close();
?>