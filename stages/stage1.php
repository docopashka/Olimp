<html>
<head>
    <title>Отборочный тест</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="teststyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
</head>
<body class="text-center">

    <?php
        if(isset($_COOKIE['user']) == false):
            header('Location: ../login.html');
        endif;
        require_once('../validation/db.php');
        // $user = $_COOKIE['user'];
        // // Выцепляем олимпиаду, в которой участвует пользователь
        // $olimp = mysqli_query($mysql, "SELECT `id_olimp` FROM `users_olimp` WHERE `id_users` = '$user'");
        // $qolimp = mysqli_fetch_row($olimp);
        // $id_olimp = $qolimp[0];
        $id_stage = 2;
        $test = mysqli_query($mysql, "SELECT `numb_quest` FROM `stage` WHERE `id_stage` = '$id_stage'");
        $n = mysqli_fetch_row($test);
        $n = $n[0];
        $result = $mysql->query("SELECT `content`,`image` FROM `question` WHERE `id_stage` = '$id_stage'");
        $qustion = mysqli_fetch_all($result);
        $qustions = json_encode($qustion);
    ?>

    <div class="card">
        <div class="card-body" id = "card-body">
            <div id="questions">
                <div id="vopros1" style="display:block;">
                    <p>Вопрос 1</p>
                    <div class="alert alert-secondary" role="alert">
                        <p><span id="v_1"></span> <textarea class="form-control" id="z_1" rows="1"></textarea></p>
                    </div>
                </div>
            </div>
            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                <div id="btn-group me-2" class="btn-group btn-lg btn-primary btn-block" role="group" aria-label="First group">
                    <button id="kn_1" type="button" class="btn btn-primary" onclick="vopr(1);">1</button>
                </div>
            </div>
            <button id="kn_pr" class="btn btn-lg btn-primary btn-block" data-bs-toggle="modal" data-bs-target="#staticBackdrop" id="button">Завершить</button>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Внимание!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="modal_p"></p>
                </div>
                <div class="modal-footer" style="align-self:center;">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="proverit();">Да</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Нет</button>
                </div>
            </div>
        </div>
    </div>

    <div class="timer">
        <div class="timer__items">
            <div class="timer__item timer__hours">00</div>
            <div class="timer__item timer__minutes">00</div>
            <div class="timer__item timer__seconds">00</div>
        </div>
    </div>
    <script type="text/javascript" src="scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
        crossorigin="anonymous"></script>
</body>
</html>

<script>
    var id = <?=$id_stage?>;
    var n = <?=$n?>;
    var vop = <?=$qustions?>;
</script>
