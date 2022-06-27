<?php
    require_once 'vendor/autoload.php';

    $document = new \PhpOffice\PhpWord\TemplateProcessor('./soglasie.docx');
    require_once('../validation/db.php');
    $uploadDir =  __DIR__;
    $outputFile = 'soglasie1.docx';
    $uploadFile = $uploadDir . '\\' . basename($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile);

    $email = $_COOKIE['user'];

    $result = $mysql->query("SELECT * FROM `users` WHERE `email` = '$email'");
    $user = $result->fetch_assoc();
    $lastname = $user['lastname'];
    $firstname = $user['firstname'];
    $patronymic = $user['patronymic'];
    $date = $user['date'];
    $tel = $user['tel'];
    $ser = $user['ser'];
    $nom = $user['nom'];
    $datepass = $user['datepass'];
    $org = $user['org'];
    $snils = $user['snils'];

    $document->setValue('firstname', $firstname);
    $document->setValue('lastname', $lastname);
    $document->setValue('patronymic', $patronymic);
    $document->setValue('tel', $tel);
    $document->setValue('email', $email);
    $document->setValue('date', $date);
    $document->setValue('ser', $ser);
    $document->setValue('nom', $nom);
    $document->setValue('datepass', $datepass);
    $document->setValue('org', $org);
    $document->setValue('snils', $snils);

    $document->saveAs($outputFile);

    // Имя скачиваемого файла
    $downloadFile = $outputFile;

    // Контент-тип означающий скачивание
    header("Content-Type: application/octet-stream");

    // Размер в байтах
    header("Accept-Ranges: bytes");

    // Размер файла
    header("Content-Length: ".filesize($downloadFile));

    // Расположение скачиваемого файла
    header("Content-Disposition: attachment; filename=".$downloadFile);  

    // Прочитать файл
    readfile($downloadFile);

    unlink($uploadFile);
    unlink($outputFile);
?>