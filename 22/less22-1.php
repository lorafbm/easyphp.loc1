<?php
session_start();
require_once 'class22.php';
/*надо тип поля отдельно выбирать, а уже от этого выводить форму для каждого типа*/
//require_once '../class22.php';
//массив атрибутов для поля
$names = array('name', 'placeholder', 'label');
//плейсхолдеры
$pl = array('Имя поля (Name)', 'Подсказывающий текст (Placeholder)', 'Подпись поля(Label)');
//массив типов полей для выбора
$res = array(0 => 'text', 1 => 'password', 2 => 'email', 3 => 'checkbox', 4 => 'radio', 5 => 'select', 6 => 'textarea');// foreach
//первый option
$opt1 = 'Тип поля';
$res1 = array('text', 'password', 'email', 'textarea');
//куда отправить данные из формы
$send = array('Вывести на экран', 'Записать в БД', 'Отправить на почту');
$a = new Form2;
$b = new Valid2;
$c = new DB('localhost', 'root', '', 'easyphp');
//$c = new DB('mysql.hostinger.com.ua', 'u836104334_test', 'vxiiS916aL', 'u836104334_main');
//получаем имя будущей формы
if (isset($_POST['addName'])) {
    $a->error = array();
    if (!$a->error['form_name'] = $b->val_Field($_POST['form_name'], 1)) {// проверка на пустоту и длину
        if (!$a->error['form_name'] = $b->sameForm($_POST['form_name'], $c)) {// проверка на уникальность имени формы
            $_SESSION['form_name'] = trim($_POST['form_name']);
            unset ($a->error['form_name']);
        }
    }
}
//получаем тип поля
if (isset($_POST['addType'])) {
    if (!isset($_POST['type'])) {
        $a->error['type'] = $b->val_Field($_POST['type']);
    } else {
        //записываем тип поля для создания формы
        foreach ($res as $k => $v) {
            if ($k == $_POST['type']) {
                $_SESSION['type'] = $v;
            }
        }
        unset ($a->error['type']);
    }
}
//обрабатываем форму по добавлению поля text, password, email, textarea
if (isset($_POST['addText'])) {
    $a->error = array();
    $a->mem = array();
    foreach ($_POST as $key => $value) {
        if (in_array($key, $names)) {
            if (!$a->error[$key] = $b->val_Field($_POST[$key], 1)) {
                $a->mem[$key] = trim($value);
                unset ($a->error[$key]);
            }
        }
    }
    if (empty($a->error)) {
        unset ($a->mem);
        if ($_SESSION['type'] == 'text' || $_SESSION['type'] == 'password' || $_SESSION['type'] == 'email') {
            $t = $a->makeText($_POST['name'], $_SESSION['type'], $_POST['placeholder'], $_POST['label']) . '&nbsp;';
        } elseif ($_SESSION['type'] == 'textarea') {
            $t = $a->make_textarea($_POST['name'], $_POST['placeholder'], $_POST['label']) . '&nbsp;';
        }
        if (empty($_SESSION['form'])) {
            //первый раз записываем поле в сессию для предварительного вывода
            $_SESSION['form'] = $t;
            unset($_SESSION['type']);
            //разбиваем сессию на массив и удаляем поле, если решили от него отказаться
            $_SESSION['form'] = explode('&nbsp;', $_SESSION['form'], -1);
        } else {//если это следующие поля, то дописываем их в сессию
            $_SESSION['form'][] = $t;
            unset($_SESSION['type']);
        }
    }
}
//обрабатываем форму по добавлению поля checkbox, radio, select
if (!empty($_POST['addList'])) {
    $a->error = array();
    $a->mem = array();
    foreach ($_POST as $key => $value) {
        if (!$a->error[$key] = $b->val_Field($_POST[$key], 1)) {
            $a->mem[$key] = trim($value);
            unset ($a->error[$key]);
        }
    }
    if (empty($a->error)) {
        unset ($a->mem);
        $list = explode(',', $_POST['field_value']);
        if($_SESSION['type'] == 'checkbox') {
            $t = $a->makeCheckbox($_POST['field_name'], $list) . '&nbsp;';
        } elseif ($_SESSION['type'] == 'radio'){
            $t = $a->makeRadio($_POST['field_name'], $list) . '&nbsp;';
        }elseif ($_SESSION['type'] == 'select'){
            $t = $a->makeSelect($_POST['field_name'], $list, $_POST['option1']) . '&nbsp;';
        }
        if (empty($_SESSION['form'])) {
            //первый раз записываем поле в сессию для предварительного вывода
            $_SESSION['form'] = $t;
            unset($_SESSION['type']);
            //разбиваем сессию на массив и удаляем поле, если решили от него отказаться
            $_SESSION['form'] = explode('&nbsp;', $_SESSION['form'], -1);
        } else {//если это следующие поля, то дописываем их в сессию
            $_SESSION['form'][] = $t;
            unset($_SESSION['type']);
        }
    }
}
//сохраняем вариант действия с результатами формы
if (!empty($_POST['doForm'])) {
    if (!isset($_POST['send_result'])) {
        $a->error['send_result'] = $b->val_Field($_POST['send_result']);
    } else {
        $_SESSION['send_result'] = $_POST['send_result'];
        unset ($a->error['send_result']);
    }
}
//удаляем поле, если оно не нужно или ошибочно добавили
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    unset($_SESSION['form'][$_GET['field_id']]);
    header("Location: less22-1.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>LESSON 22</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
          integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <style>
        main {
            padding: 50px 100px;
        }

        form {
            width: 40%;
            margin: 0 auto;
        }

        p {
            color: red;
        }
    </style>
</head>
<body>
<main>
    <?php if (empty($_SESSION['form_name'])) { ?>
        <div><h3>Шаг 1 - Укажите имя формы</h3></div>
        <?php
        echo $a->startForm('post');
        echo $a->makeText('form_name', 'text', 'Имя формы (Name)');
        echo $a->endForm('addName', 'Добавить');
    } else { ?>
        <p>Имя формы: <?php echo $_SESSION['form_name']; ?></p>
    <?php } ?>
    <hr>
    <div><h3>Шаг 2 - Добавьте поля для формы:</h3></div>
    <?php if (empty($_SESSION['type'])) { ?>
        <div><h4>Шаг 2.1 - Выберите тип поля:</h4></div>
        <?php
        echo $a->startForm('post');
        echo $a->makeSelect('type', $res, $opt1);
        echo $a->endForm('addType', 'Сохранить тип  поля');
    } else { ?>
        <p>Тип поля: <?php echo $_SESSION['type']; ?></p>
        <h4>Шаг 2.2 - Добавьте поля для формы:</h4>
        <?php
        if (in_array($_SESSION['type'], $res1)) {//text, password, email, textarea
            echo $a->startForm('post');
            for ($i = 0;
                 $i < count($names);
                 $i++) {
                echo $a->makeText($names[$i], 'text', $pl[$i]);
            }
            echo $a->endForm('addText', 'Добавить поле');
        } elseif ($_SESSION['type'] == 'checkbox' || $_SESSION['type'] == 'radio') {//checkbox and radio
            echo $a->startForm('post');
            echo $a->makeText('field_name', 'text', 'Имя поля');
            echo $a->make_textarea('field_value', 'Введите варианты для выбора через запятую!');
            echo $a->endForm('addList', 'Добавить поле');
        } elseif ($_SESSION['type'] == 'select') {//select
            echo $a->startForm('post');
            echo $a->makeText('field_name','text', 'Имя поля');
            echo $a->makeText('option1', 'text', 'Название списка');
            echo $a->make_textarea('field_value', 'Введите варианты для выбора через запятую!');
            echo $a->endForm('addList', 'Добавить поле');
        }
    }
    if (empty($_SESSION['send_result'])) { ?>
        <hr>
        <div><h3>Шаг 3 - Данные из формы:</h3></div>
        <?php
        echo $a->startForm('post');
        echo $a->makeRadio('send_result', $send);
        echo $a->endForm('doForm', 'Сохранить');
    } else { ?>
        <p>Данные из формы: <?php foreach ($send as $key => $value) {
                if (($key + 1) == $_SESSION['send_result']) {
                    echo $value;
                }
            }; ?></p>
    <?php }
    if (!empty($_SESSION['form'])) { ?>
        <hr>
        <div><h3>Шаг 4 - Сохранить форму:</h3></div>
        <p>Так будет выглядеть форма</p>
        <div style="width: 50%; margin: 0 auto;"><?php foreach ($_SESSION['form'] as $key => $item) {
                echo $item;
                echo '<a href="less22-1.php?action=delete&field_id=' . $key . '">Удалить поле</a>';
            } ?>
            <div>
                <a class="btn btn-success" href="less22saved.php" role="button">Сохранить форму</a>
                <!--                <a class="btn btn-success" href="/addon/less22saved.php" role="button">Сохранить форму</a>-->
            </div>
        </div>
    <?php } ?>
</main>
</body>

</html>