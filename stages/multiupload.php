<?php
    // получаем массив данных о загружаемых файлах
    $images = $_FILES["z"];

    // переменная для формирования читаемого массива с файлами
    $normalizeImages = [];

    // перебираем всех ключи name, tmp_name и т.д.
    foreach ($images as $key_name => $value) {
        // перебираем все значения текущего ключа
        foreach ($value as $key => $item) {
            // упаковываем все в переменную @normalizeImages
            $normalizeImages[$key][$key_name] = $item;
        }
    }
    $email = $_COOKIE['user'];
    require_once('../validation/db.php');
    $result = $mysql->query("SELECT * FROM `users` WHERE `email` = '$email'");
    $user = $result->fetch_assoc();
    $n = 1;
    foreach ($normalizeImages as $image) {
        // валидация
        // типы файлов, которые можно загружать
        $types = ["text/plain"];

        // ищем в массиве с типами тип текущего файла
        if (!in_array($image["type"], $types)) {
            // в случае ошибки пропускаем итерацию
            continue;
        }

        // определяем размер файла в мегабайтах
        $fileSize = $image["size"] / 1000000;
        // максимальный размер файла в мегабайтах
        $maxSize = 1;

        // проверяем, чтобы размер файла не превышал ограничение
        if ($fileSize > $maxSize) {
            // в случае ошибки пропускаем итерацию
            continue;
        }
        $dir = $user["id"] . "_" . $user["lastname"] . "_" . $user["firstname"];
        // создаем папку uploads в корне проекта, если её нет
        if (!is_dir('../uploads/' . $dir)) {
            mkdir(directory:'../uploads/' . $dir, permissions: 0777, recursive:true);
        }

        // изнаем расширение текущего файла
        $extension = pathinfo($image["name"], PATHINFO_EXTENSION);
        // формируем уникальное имя с помощью функции time()
        $fileName = $user["id"] . "_" . $user["lastname"] . "_" . $user["firstname"] . "№$n" . ".$extension";
        print_r($fileName);
        // загружаем файл и проверяем
        // если во премя загрузки файла произошла ошибка, возвращаем die()
        if (!move_uploaded_file($image["tmp_name"], "../uploads/" . $dir . "/" . $fileName)) {
            // в случае ошибки пропускаем итерацию
            continue;
        }
        $n++;

        // Подключаем файл для загрузки файлов на Яндекс.Диск
        require_once('drive.php');
    }
    header('Location: ../profile.php');
?>