<?php
  $images = $_FILES["image"];
  require_once('../validation/db.php');
  move_uploaded_file($images["tmp_name"], $images['name']);
  //$path = $images["name"];
  $mysql->query("INSERT INTO `question` (`id_test`,`content`,`answer`,`image`) 
    VALUES ('1','$images["name"]','11','1')");
 ?>