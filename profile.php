<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/stagestyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
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
        <h1>Личный кабинет</h1>
    </div>
    <div class="inf">
        <div class="edittt"><h2>Мои данные</h2></div>
        <div class="editt_btn">
        <form action="edit.php" method="post">
            <button class="edit_btn" type="submit" ><img src="img/pine.png"></button>
        </form>
        </div>
        <br><br>
        <p>Имя: <?=$user["firstname"];?> <p>
        <p>Фамилия: <?=$user["lastname"];?> <p>
        <?php
            if($user['patronymic']):
        ?>
        <p>Отчество: <?=$user["patronymic"];?> <p>
        <?php endif; ?>
        <p>Дата рождения: <?=$user["date"];?> <p>
        <p>E-mail: <?=$user["email"];?> <p>
        <p>Телефон: <?=$user["tel"];?> <p>
        <p>Город: <?=$user["city"];?> <p>
        <p>Статус: <?=$user["status"];?> <p>

        <button class="btn"><a href="phpword/word.php" target= "_blank">Соглашение на обработку персональных данных</a></button>

        <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="name" >
        <button type="submit"> Загрузить </button>
            <style>
                input, button {
                    display: block;
                    margin-bottom: 10px;
                    font-size: 22px;
                    border-radius:6px;
                }
            </style>
        </form>
    </div>

    <div class="stage">
    <section class="grid">
        <article class="grid-item">
            <div class="image">
                <img src="img\prog.jpg">
            </div>
            <div class="info">
                <h2>Тренировка</h2>
                <div class="button-wrap">
                    <a class="atuin-btn" href="stages/test.php">Начать</a>
                </div>
            </div>
        </article>

        <article class="grid-item">
            <div class="image">
                <img src="img\prog.jpg">
            </div>
            <div class="info">
                <h2>Отборочный этап</h2>
                <div class="button-wrap">
                    <?php if($user["test"] == 0): ?>
                        <a class="atuin-btn" href="stages/stage1.php">Начать</a>
                    <?php else: ?>
                        <button onclick="swa()" type="button" class="atuin-btn">Начать</button>
                    <?php endif; ?>
                </div>
            </div>
        </article>

        <article class="grid-item">
            <div class="image">
                <img src="img\prog1.jpg">
            </div>
            <div class="info">
                <h2>Финальный этап</h2>
                <div class="button-wrap">
                    <a class="atuin-btn" href="stages/stage2.php">Начать</a>
                </div>
            </div>
        </article>
    </section>
    </div>
    <div id="overlay">
    <div class="popup">
        <button class="close" title="Закрыть окно" onclick="swa2()"></button>
        <p class="zag">Внимание!</p>
        <p>Вы уже прошли тест</p>
    </div>
    </div>
    <?php include 'modal.php'; ?>
</body>
</html>