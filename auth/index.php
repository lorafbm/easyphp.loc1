<?php
session_start();
error_reporting(-1); ?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>ДЗ урок №13 Работа с БД.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Larisa Kirko">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Эти строки позволяют отключить автоматическое распознавание форматов. если вы где-нибудь на странице
     указали номер телефона в html-коде и не указали в хедере, то смартфон распознает его как телефонный номер
     и попытается набрать его по клику. То же самое и с адресом.-->
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="address=no">
    <link rel="stylesheet" href="/vendor/public/bootstrap/dist/css/bootstrap.css">
    <style><?php echo file_get_contents('./style.css') ?></style>
</head>
<body>
<header>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Заголовок -->
            <div class="navbar-header">
            </div>
            <!-- Основная часть меню (может содержать ссылки, формы и другие элементы) -->
            <div class="collapse navbar-collapse" id="navbar-main">
                <!-- Содержимое основной части -->
                <ul class="nav navbar-nav">
                    <!-- Ссылки -->
                    <li class="active"><a href="/auth/index.php">Главная</a></li>
                    <li><a href="/auth/comments.php">Комментарии</a></li>
                    <?php if (!isset($_SESSION['user'])){ ?>
                    <li><a href="/auth/auth.php">Войти</a></li> <?php } ?>
                    <?php if (isset($_SESSION['user'])){ ?>
                    <li><a href="/auth/info.php">Инфо</a></li>
                        <li><a href="/auth/cab.php">Кабинет</a></li>
                    <li><a href="/auth/exit.php">Выход</a></li><?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <?php if (!empty($_SESSION['user'])) {
        echo 'Здраствуйте, ' .$_SESSION['user']['user_name'];} ?>
    <?php if (!empty($_SESSION['result']['info'])) {
            echo  $_SESSION['result']['info']; } ?>
</header>
</body>
</html>
