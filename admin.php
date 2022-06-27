<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/stagestyle.css">
    <title>CCC</title>
</head>
<body>
    <?php
        if(isset($_COOKIE['user']) == false):
            header('Location: login.html');
        endif;
        $email = $_COOKIE['user'];
        require_once('validation/db.php');
        $result = $mysql->query("SELECT * FROM `users` WHERE `email` = '$email'");
        $user = $result->fetch_assoc();
    ?>
    <?php include 'header.php'; ?>
    <div class="heading">
        <h1>Администратор</h1>
    </div>

    <div class="stage_name1">
        <div id="stage1" class="stage_name">
            <h2>Создание этапов</h2>
            <div id="stage" class="stage_adm">
                <button id="b" onclick="create();">Создать этап</button>
            </div>
        </div>
    
        <div id="lend" class="stage_name">
            <h2>Изменение лендинга</h2>
            <div id="stage" class="stage_adm">
                <button><a href="textolite">Изменить</a></button>
            </div>
        </div>
        <div id="arch" class="stage_name">
            <h2>Добавить задание в архив</h2>
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <input type="file" name="name" >
                <button type="submit"> Загрузить </button>
            </form>
        </div>
    </div>
</body>
</html>

<script>
    let iter = 1;
    function create() {
        let parent = document.getElementById("stage");
        let newf = document.createElement("form");
        newf.setAttribute("id","f");
        newf.setAttribute("method","post");
        newf.setAttribute("action","create_stage.php");
        newf.innerHTML = "<select  class='stage_type' name='status' id='status' placeholder='Статус'><option>Тип</option><option>Тренировочный тест</option><option>Отборочный тест</option><option>Финальный этап</option></select>";
        newf.innerHTML += "<button class='stage_btn' type='submit' >Загрузить</button>";
        my_div = document.getElementById("b");
        parent.insertBefore(newf, my_div);
        parent.innerHTML += "<button id='add' onclick='addQuestion(1);'>Текст</button>";
        parent.innerHTML += "<button id='add' onclick='addQuestion(2);'>Изображение</button>";
        document.getElementById("b").style.display = "none";
        document.getElementById("lend").style.display = "none";
        document.getElementById("arch").style.display = "none";
    }
    function addQuestion(x) {
        f = document.getElementById("f");
        if (x == 1) {
            f.innerHTML += "<br>"+iter+": <br><textarea class='stage_inp' id='v_"+iter+"' name='v[]' rows='1' placeholder='Вопрос'>";
            f.innerHTML += "</textarea><textarea class='stage_inp' id='a_"+iter+"' rows='1' name='a[]' placeholder='Ответ'></textarea>";
            f.innerHTML += "<input class='stage_inp' type='text' name='ball[]' id='ball_"+iter+"' placeholder='Количество баллов' required>";
        }
        if (x == 2) {
            f.innerHTML += "<br>"+iter+": <input type='file' name='image[]' />";
            f.innerHTML += "</textarea><textarea class='stage_inp1' id='a_"+iter+"' name='a[]' rows='1' placeholder='Ответ'></textarea>";
            f.innerHTML += "<input class='stage_inp' type='text' name='ball[]' id='ball_"+iter+"' placeholder='Количество баллов' required>";
        }
        iter++;
    }
</script>