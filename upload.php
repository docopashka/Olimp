<?php
  $image = $_FILES["name"];
  $email = $_COOKIE['user'];
  require_once('validation/db.php');
  $result = $mysql->query("SELECT * FROM `users` WHERE `email` = '$email'");
  $user = $result->fetch_assoc();
  if(!is_dir(filename:'user_agreement')) {
    mkdir(directory:'user_agreement', permissions: 0777, recursive:true);
  }

  $extension = pathinfo($image["name"], PATHINFO_EXTENSION);

  $filename = $user["id"] . "_" . $user["lastname"] . "_" . $user["firstname"] . '.' . $extension;

  move_uploaded_file($image["tmp_name"], "user_agreement/" .  $filename);

  echo "Файл загружен";
  header('Location: profile.php');
?>