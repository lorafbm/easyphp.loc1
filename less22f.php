<?php

include_once 'less22.php';

//$connect = mysqli_connect('localhost', 'root', '', 'project1');
//$res1 = mysqli_query($connect,"SELECT `category_id`, `category_name` FROM `category`");//while
//$res = array(0 => array('id' => 48, 'name' => 'coffee'), 1 => array('id' => 53, 'name' => 'tea'), 2 => array('id' => 77, 'name' => 'juice'));//while
$res = array(1 => 'текстовое поле', 2 => 'текстовая область', 3 => 'список', 4 => 'пароль', 5=>'радио',6=>'чекбокс');// foreach
$opt1 = 'Тип поля';
$check = array(12 => 'winter', 13 => 'spring', 14 => 'summer', 15 => 'autumn');
$pol = array('мужчина', 'женщина');

//создаем форму
$a = new Form1;

//валидируем форму
if (isset($_POST['submit'])) {
    $b = new Valid1;
    $a->error = array();
    $a->mem = array();
    foreach ($_POST as $key => $value) {
        if ($key == 'email') {
            if (!$a->error[$key] = $b->val_Field($_POST[$key], 1)) {
                $a->mem[$key] = trim($value);
            }
        } else {
            if (!$a->error[$key] = $b->val_Field($_POST[$key])) {
                $a->mem[$key] = trim($value);
            }
        }
    }
    if (!isset($_POST['check'])) {
        $a->error['check'] = $b->val_Field($_POST['check']);
    } else {
        foreach ($_POST['check'] as $k => $v) {
            $a->mem['check'][$k] = $v;
        }
    }
    if (!isset($_POST['pol'])) {
        $a->error['pol'] = $b->val_Field($_POST['pol']);
    } else {
        $a->mem['pol'] = $_POST['pol'];
    }
    if (!isset($_POST['select'])) {
        $a->error['select'] = $b->val_Field($_POST['select']);
    } else {
        $a->mem['select'] = $_POST['select'];
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>LESSON 21</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
          integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <style>main {
            padding: 50px 0;
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
    <?php
    echo $a->startForm('post');
    //например, нужно несколько полей одного типа
    $names = array('name_field', 'placeholder','value');
    $placeholders = array('Подпись к полю', 'Имя поля','Значение');
    for ($i = 0;
         $i < count($names);
         $i++) {
        echo $a->makeText($names[$i], $placeholders[$i]);
    }
    // илитолько одно поле определенного типа
 //   echo $a->makeText('label', 'Подпись к полю');
  //  echo $a->makePass('name', 'Имя поля');
   // echo $a->makeEmail('email', 'e-mail');
  //  echo $a->make_textarea('textarea', 'print some text', 7);
 //   echo $a->makeRadio('pol', $pol);
  //  echo $a->makeCheckbox('check', $check);
    //echo $a->make_select('select', 3, ['one', 'two', 'three']);
    echo $a->makeSelect('select', $res, $opt1);
    //echo $a->makeSelect('select', $res1, 'Выберите категорию новостей');
    echo $a->endForm('submit', 'send');
    ?>
</main>
</body>
</html>
