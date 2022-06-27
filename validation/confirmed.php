<?php
// Подключаем коннект к БД
//  require_once ('/db.php');
//$mysql = new mysqli('localhost', 'root', 'root', 'bd');
require_once 'db.php';
// Проверка есть ли хеш
    // Получаем id и подтверждено ли Email
    if ($result = mysqli_query($mysql, "SELECT `id`, `email_confirmed` FROM `user` WHERE `password` = '$password' ")) {
        while( $row = mysqli_fetch_assoc($result) ) {
            echo $row['id'] . " " . $row['email_confirmed'];
            // Проверяет получаем ли id и Email подтверждён ли
            if ($row['email_confirmed'] == 1) {
                // Если всё верно, то делаем подтверждение
                mysqli_query($mysql, "UPDATE `user` SET `email_confirmed`=0 WHERE `id`=". $row['id'] );
                echo "Email подтверждён";
            } else {
                echo "Что то пошло не так";
            }
        }
    } else {
        echo "Что то пошло не так";
    }
