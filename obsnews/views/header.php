<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <!--<link rel="dns-prefetch" href="https://obsnews.loc">-->
    <title><?php echo $data['title']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords"
          content="ОБС новости, новости украины, горячие новости">
    <meta name="author" content="Larisa Kirko">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Эти строки позволяют отключить автоматическое распознавание форматов. если вы где-нибудь на странице
     указали номер телефона в html-коде и не указали в хедере, то смартфон распознает его как телефонный номер
     и попытается набрать его по клику. То же самое и с адресом.-->
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="address=no">
    <!--    <link rel="stylesheet" href="/vendor/public/bootstrap/dist/css/bootstrap.min.css">-->
    <!--    <link rel="stylesheet" href="/vendor/public/bootstrap/dist/css/bootstrap-theme.min.css">-->
    <script src="/vendor/public/jquery/dist/jquery.js"></script>
    <link rel="stylesheet" href="/vendor/public/fancybox/dist/jquery.fancybox.css?v=2.1.5">
    <script src="/vendor/public/fancybox/dist/jquery.fancybox.js"></script>
    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">-->
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.css">

    <link rel="stylesheet" href="/views/styles/style.css">
    <!--    <script src="/vendor/public/jquery/dist/jquery.js"></script>-->

    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <!--Safari в iOS и дефолтный браузер в Андроиде-сохранение закладок на сайты и веб-приложения на рабочем столе,
     наряду с иконками для обычных приложений.-->
    <link rel="apple-touch-icon" href="/touch-icon-iphone.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/touch-icon-ipad.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/touch-icon-ipad-retina.png">
</head>
<body>
<div class="content">
    <header>
        <div class="clearfix">
            <div class="left"><a href="/"><img src="/logo.png" width="230" height="88" alt="obsновости"></a>
            </div>
            <div class="right">
                <p><?php echo htmlspecialchars($data['info']['address']) ?></p>
                <p><?php echo htmlspecialchars($data['info']['phone']) ?> </p>
                <p><?php echo htmlspecialchars($data['info']['email']) ?></p>
            </div>
        </div>
        <div class="mini-menu" onclick="$('#menu1').toggle('slow');"></div>
        <div id="menu1">
            <ul>
                <li><a href="/">Главная</a></li>
                <li><a href="#">Категории&nbsp;&nbsp;<span>&#8744;</span></a>
                    <ul>
                        <?php foreach ($data['category_info'] as $key) { ?>
                            <li>
                                <a href="<?php echo mylink('category', $key['category_id']); ?>"><?php echo $key['category_name']; ?></a>
                            </li>
                            <?php
                        } ?>
                    </ul>
                </li>
                <li><a href="/index.php?route=popular">Популярное</a></li>
                <li><a href="#">Бизнес</a></li>
                <li><a href="#">Спорт</a></li>
                <li class="last"><a href="/index.php?route=Aboutus">О нас</a></li>
            </ul>
        </div>
<!--        <a href="/index.php?route=admin">Вход в Admin панель</a>-->
        <nav class="clearfix">
            <ul>
                <li class="first"><a href="/">Главная</a></li>
                <li>
                    <a href="#"> Все категории&nbsp;&nbsp;<span>&#8744;</span></a>
                    <ul>
                        <?php foreach ($data['category_info'] as $key) {
                            ?>
                            <li>
                                <a href="<?php echo mylink('category', $key['category_id']); ?>"><?php echo $key['category_name']; ?></a>
                            </li>
                            <?php
                        } ?>
                    </ul>
                </li>
                <li><a href="/index.php?route=popular">Популярное</a></li>
                <li><a href="/index.php?route=category&category_id=2">Бизнес</a></li>
                <li><a href="/index.php?route=category&category_id=4">Спорт</a></li>
                <li class="last"><a href="/index.php?route=Aboutus">О нас</a></li>
            </ul>
        </nav>
    </header>
