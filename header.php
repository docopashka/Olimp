<header class="header">
    <div class="container1">
        <div class="header__inner">
            <div class="header__logo">
                <a href="index.php"><h1>Олимпиады ИМИТ АлтГУ</h1></a>
            </div>
                <nav class="nav">
                <a class="nav__link" href="news.php">Новости</a>
                <a class="nav__link" href="contacts.php">Контакты</a>
                <a class="nav__link" href="job-archive.php">Архив заданий</a>
                <?php
                    if(isset($_COOKIE['user']) == false):
                ?>
                <a class="nav__link" href="login.html">Вход/Регистрация</a>
                <?php else: ?>
                <a class="nav__link" href="profile.php">Личный кабинет</a>
                <a class="nav__link" href="exit.php">Выйти</a>
                <?php endif;?>
            </nav>
        </div>
    </div>
</header>
