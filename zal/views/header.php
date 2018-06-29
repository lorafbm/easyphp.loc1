<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <!--<link rel="dns-prefetch" href="https://.loc">-->
    <title>Заказ билетов</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keywords"
          content="">
    <meta name="author" content="Larisa Kirko">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--Эти строки позволяют отключить автоматическое распознавание форматов. если вы где-нибудь на странице
     указали номер телефона в html-коде и не указали в хедере, то смартфон распознает его как телефонный номер
     и попытается набрать его по клику. То же самое и с адресом.-->
    <meta name="format-detection" content="telephone=no">
    <meta name="format-detection" content="address=no">
    <script src="/vendor/public/jquery/dist/jquery.js"></script>
    <script src="/vendor/public/fancybox/dist/jquery.fancybox.js"></script>
    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">-->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="/views/styles/styles.css">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <!--Safari в iOS и дефолтный браузер в Андроиде-сохранение закладок на сайты и веб-приложения на рабочем столе,
     наряду с иконками для обычных приложений.-->
    <link rel="apple-touch-icon" href="/touch-icon-iphone.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/touch-icon-ipad.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/touch-icon-iphone-retina.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/touch-icon-ipad-retina.png">
    <script>
        function delAdd(action, id) {
            if (confirm('Уверены?')) {
                $.ajax({
                    url: '/index.php?route=zakaz',
                    type: "POST",
                    cache: false,
                    data: {
                        id: id,
                        action: action
                    },
                    success: function (msg) {
                        var response = JSON.parse(msg);
                        if (response.status == 'ok') {
                            if (response.flag_f == 'off') {
                                $('#del_f').css('display', 'none');
                                $('#add_f').css('display', 'block');
                            }
                            if (response.flag_f == 'on') {
                                $('#add_f').css('display', 'none');
                                $('#del_f').css('display', 'block');
                            }
                        }
                    },
                });
            }
            return false;
        }
    </script>
    <script>
        function get_Token(login, password) {
            $.ajax({
                url: '/index.php?route=testapi',
                type: "POST",
                cache: false,
                data: {
                    getToken: 'getToken',
                    login: $('#login').val(),
                    password: $('#password').val()
                },
                success: function (msg) {
                    var response = JSON.parse(msg);
                    if (response.status == 'ok') {
                        //очищаем форму
                        form = document.getElementById('getToken');
                        form.login.value = "";
                        form.password.value = "";
                        form1 = document.getElementById('getListSocial');
                        form1.token.value = response.response;
                        form2 = document.getElementById('delSocial');
                        form2.id.value = response.id;
                        //выводим результат
                        $('#result_token').text(msg);
                        $('#result_token').css('border-width','1px');
                        $('#id').val(response.id);
                    }
                },
            });

            return false;
        }

        function getListSocial() {
            $.ajax({
                url: '/index.php?route=testapi',
                type: "POST",
                cache: false,
                data: {
                    token: $('#token').val(),
                    getList: 'getList',
                    format: $('#format').val()
                },
                success: function (msg) {
                    var format = $('#format').val();
                    if (!format) {
                        var response = JSON.parse(msg);
                        if (response.status == 'ok') {
                            $('#result_list').text(msg);
                            $('#result_list').css('border-width','1px');
                            $('#token').val(response.id);
                        }
                    }else if(format == 'xml'){
                        $('#result_list').text(msg);
                        $('#result_list').css('border-width','1px');
                    }
                },
            });

            return false;
        }

        function del_f(id) {
            $.ajax({
                url: '/index.php?route=testapi',
                type: "POST",
                cache: false,
                data: {
                    id: $('#id').val(),
                    action: 'delete'
                },
                success: function (msg) {
                    var response = JSON.parse(msg);
                    if (response.status == 'ok') {
                        $('#delete').text(msg);
                        $('#delete').css('border-width','1px');
                    }
                },
            });

            return false;
        }
    </script>
</head>
<body>
<main>
    <header>
        <div class="container">
            <p><img src="/image/logo.png"></p>
            <nav class="breadcrumb">
                <a class="breadcrumb-item" href="/">Главная</a>
                <a class="breadcrumb-item" href="/index.php?route=kassa">Касса</a>
                <a class="breadcrumb-item" href="/index.php?route=zakaz">Кабинет</a>
                <?php if (!isset($_SESSION['user'])) { ?>
                    <a class="breadcrumb-item" href="/index.php?route=auth">Войти</a>
                <?php } else { ?>
                    <a class="breadcrumb-item" href="/index.php?route=testapi">TestApi</a>
                    <a class="breadcrumb-item" href="/index.php?route=exit">Выход</a>
                <?php } ?>
            </nav>
        </div>
    </header>
