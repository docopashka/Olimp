<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Изменение данных</title>
    <link rel="stylesheet" href="CSS/stylereg.css">
</head>
<body>
    <?php
        $email = $_COOKIE['user'];
        require_once('validation/db.php');
        $result = $mysql->query("SELECT * FROM `users` WHERE `email` = '$email'");
        $user = $result->fetch_assoc();
    ?>
    <div id="range5"> 
        <div class="outer">
            <div class="middle">
                <div class="inner">
                    <div class="login-wr">
                        <div class="form">  
                            <form action="validation/edit.php" method="POST">
                
                                <input  class="input1" type="text" name="firstname" id="firstname" value="<?=$user["firstname"];?>" required>
                        
                                <input  class="input1" type="text" name="lastname" id="lastname" value="<?=$user["lastname"];?>" required>
                                
                                <input  class="input1" type="text" name="patronymic" id="patronymic" value="<?=$user["patronymic"];?>"><br>
                                <label>Дата рождения</label>
                                <input  class="input" type="date" name="date" id="date" value="<?=$user["date"];?>" required>
                            
                                <!-- <input  class="input" type="email" name="email" id="email" value="<?=$user["email"];?>" pattern="{1,}@{1,}" required> -->
                            
                                <input  class="input2" type="text" name="tel" id="tel" placeholder="Ваш номер телефона +7" value="<?=$user["tel"];?>" required>
                            
                                <input  class="input" type="password" name="lastpass" id="password" placeholder="Старый пароль">
                            
                                <input  class="input" type="password" name="newpass" placeholder="Новый пароль">

                                <input  class="input1" type="text" name="city" id="city" value="<?=$user["city"];?>" required>
                                
                                <select  class="select" name="status" id="status" >
                                    <option id = "o1">Статус</option>
                                    <option id = "o2">Школьник</option>
                                    <option id = "o3">Студент СПО</option>
                                    <option id = "o4">Студент ВУЗа</option>
                                    <option id = "o5">Закончил</option>
                                </select>
                                <br>
                            
                                <label class="label">Данные паспорта:</label>
                                <input class="input1" type="text" name="ser" id="ser" value="<?=$user["ser"];?>" pattern="[0-9]{4}" required>

                                <input class="input1" type="text" name="nom" id="nom" value="<?=$user["nom"];?>" pattern="[0-9]{6}" required>

                                <input class="input1" type="text" name="org" id="org" value="<?=$user["org"];?>" required><br>

                                <label>Дата выдачи паспорта</label>
                                <input class="input" type="date" name="datepass" id="datepass" value="<?=$user["datepass"];?>" required>
                            
                                <label>СНИЛС:</label>
                                <input class="input1" type="text" name="snils" id="snils" value="<?=$user["snils"];?>" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3} [0-9]{2}">
                            
                                <button class="btn" type="submit" >Сохранить</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script>
    document.addEventListener('DOMContentLoaded', function (){
        for(let i = 1;i < 6;i++){
            elem = document.getElementById("o"+i);
            if(elem.value == "<?=$user["status"];?>"){
                
                elem.setAttribute("selected","selected");
            }
        }
    });
</script>