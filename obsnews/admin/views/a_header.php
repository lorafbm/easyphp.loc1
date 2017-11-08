<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <!--<link rel="dns-prefetch" href="https://obsnews.loc">-->
    <title><?php echo $data['title'];?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Эти строки позволяют отключить автоматическое распознавание форматов. если вы где-нибудь на странице
     указали номер телефона в html-коде и не указали в хедере, то смартфон распознает его как телефонный номер
     и попытается набрать его по клику. То же самое и с адресом.-->

    <link rel="stylesheet" href="/vendor/public/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/vendor/public/bootstrap/dist/css/bootstrap-theme.min.css">

    <link rel="stylesheet" href="/vendor/public/fancybox/dist/jquery.fancybox.css?v=2.1.5">
    <link rel="stylesheet" href="/admin/views/styles/a_style.css">
    <script src="/vendor/public/jquery/dist/jquery.js"></script>
    <script src="/admin/views/js/scripts_v1.js"></script>
    <!--<link rel="stylesheet" href="/node_modules/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">-->

    <!--<link rel="canonical" href="https://lora.school-php.com/obsnews.loc">-->
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
            <div class="left"><p>CMS  <span>Управление сайтом</span></p>
            </div>
            <div class="right">

            </div>
        </div>
        <div class="mini-menu" onclick="$('#menu1').toggle('slow');"></div>
        <div id="menu1">
            <ul>
                <li><a href="/">Главная</a></li>
                <li><a href="#">Управление категориями&nbsp;&nbsp;<span>&#8744;</span></a>
                    <ul>
                        <?php foreach ($data['category_info'] as $key) { ?>
                            <li>
                                <a href="<?php echo mylink('category', (int)$key['category_id']); ?>"><?php echo htmlspecialchars($key['category_name']); ?></a>
                            </li>
                            <?php
                        } ?>
                    </ul>
                </li>
                <li><a href="<?php echo mylink_a('a_news'); ?>">Новости</a></li>
                <li><a href="<?php echo mylink_a('a_aboutus'); ?>">О нас</a></li>
                <li><a href="<?php echo mylink_a('a_styles'); ?>">Стили</a></li>
                <li class="last"><a href="/">Выход</a></li>
            </ul>
        </div>

        <nav class="clearfix">
            <ul>
                <li class="first"><a href="/index.php?route=admin">Главная</a></li>
                <li>
                    <a href="<?php echo mylink_a('a_categories'); ?>">Категории</a>
                    <ul>
                        <?php foreach ($data['category_info'] as $key) {
                            ?>
                            <li>
                                <a href="<?php echo mylink('category', (int)$key['category_id']); ?>"><?php echo htmlspecialchars($key['category_name']); ?></a>
                            </li>
                            <?php
                        } ?>
                    </ul>
                </li>
                <li><a href="<?php echo mylink_a('a_news'); ?>">Новости</a></li>
                <li><a href="<?php echo mylink_a('a_aboutus'); ?>">О нас</a></li>
                <li><a href="<?php echo mylink_a('a_styles'); ?>">Стили</a></li>
                <li class="last"><a href="/">Выход</a></li>
            </ul>
        </nav>
    </header>
