<?php
session_start();
require_once 'classes.php';

/*надо тип поля отдельно выбирать, а уже от этого выводить форму для каждого типа*/
//$res = array(0 => 'text', 1 => 'password', 2 => 'email', 3 => 'checkbox', 4 => 'radio', 5 => 'select', 6 => 'textarea');// foreach
$res = array('text', 'password', 'email', 'textarea', 'radio', 'checkbox', 'select');
$send = array('Вывести на экран', 'Записать в БД', 'Отправить на почту');
//$names = array('name', 'placeholder', 'label');
//$pl = array('Имя поля (Name)', 'Подсказывающий текст (Placeholder)', 'Подпись поля(Label)');
$a = new Form;
$b = new Valid;
$c = new DB('localhost', 'root', '', 'easyphp');
/*обработчик форм*/
/*1.получили имя формы и записали в сессию*/
if (isset($_POST['addName'])) {
    $a->error = array();
    if (!$a->error['form_name'] = $b->val_Field($_POST['form_name'], 1)) {// проверка на пустоту и длину
        if (!$a->error['form_name'] = $b->sameForm($_POST['form_name'], $c)) {// проверка на уникальность имени формы
            $_SESSION['form_name'] = trim($_POST['form_name']);
            unset ($a->error['form_name']);
        }
    }
}
/*2. получила тип поля*/
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
//сохраняем вариант действия с результатами формы
if (!empty($_POST['doForm'])) {
    if (!isset($_POST['send_result'])) {
        $a->error['send_result'] = $b->val_Field($_POST['send_result']);
    } else {
        $_SESSION['send_result'] = $_POST['send_result'];
        unset ($a->error['send_result']);
    }
}

var_dump($_POST) . '<br>';
echo '<hr>';
var_dump($_SESSION);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Конструктор формы</title>
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
    <h2 class="text-left" style="margin-bottom: 20px;">Шаг 1 - Укажите имя формы</h2>
    <?php
    if (!empty($_SESSION['form_name'])) {
        echo '<p class="text-primary">Имя формы: <b>' . htmlspecialchars($_SESSION['form_name']) . '</b></p>';
    } else {
        echo $a->startForm('post');
        echo $a->makeText('form_name', 'text', 'Имя формы (Name)');
        echo $a->endForm('addName', 'Добавить');
    }

    ?>
    <hr>

    <?php
    if (empty($_SESSION['type'])) {
        echo '<h2 class="text-left" style="margin-bottom: 20px;">Шаг 2 - Выберите тип поля</h2>
    <h4 class="text-left" style="margin-bottom: 20px;">Шаг 2.1 - Выберите тип поля:</h4>';
        echo $a->startForm('post');
        echo $a->makeSelect('type', $res, 'Тип поля');
        echo $a->endForm('addType', 'Добавить!');
    } else {
        echo ' <h2 class="text-left" style="margin-bottom: 20px;">Шаг 2 - Добавьте поля для формы</h2>
    <h4 class="text-left" style="margin-bottom: 20px;">Шаг 2.2 - Добавьте данные для поля:</h4>';
        echo '<p class="text-primary">Тип поля: <b>' . ($_SESSION['type']) . '</b></p>';





    }
    ?>
    <h2 class="text-left" style="margin-bottom: 20px;">Шаг 3 - Данные из формы</h2>
    <hr>
    <?php
    if (!empty($_SESSION['send_result'])) { ?>
        <p class="text-primary"><?php foreach ($send as $k => $v) {
                if (($k + 1) == $_SESSION['send_result']) {
                    echo $v;
                }
            } ?></b></p>;
   <?php } else {
        echo $a->startForm('post');
        echo $a->makeRadio('send_result', $send);
        echo $a->endForm('doForm', 'Сохранить');
    } ?>

</main>
</body>
    <hr>
<?php
/*$aa = new Form;
 $aa->fields = $aa->MakeInput('text,text1', 'текст,текст1', 'text');
$aa->fields=$aa->MakeInput('text1', 'текст1', 'text');
var_dump($aa->fields);

/*$a->MakeInput('login', 'Введите login', 'Логин', 'text');
$a->MakeInput('pass', 'Введите пароль', 'Пароль', 'password');
$a->MakeInput('email', 'Введите email', 'Email', 'email');
$a->makeRadio('radio', ['желтый','синий']);
$a->makeCheckbox('color', ['белый','сиреневый']);
echo $aa->CreateForm('post', 'go!','form');*/
?>