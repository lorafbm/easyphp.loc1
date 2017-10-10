<?php
session_start();
error_reporting(-1);

$_SESSION['result'] = array();//создаем пустые массивы чтобы каждый раз удалялись неправильные данные которые ввел пользователь
$_SESSION['error'] = array();

//валидация логин на пустоту
if (!empty ($_POST['login'])) {
    $_SESSION['result']['login'] = $_POST['login']; // записываем в сессию
    $flag_l = 1;
} else {
    $_SESSION['error']['login'] = 'Вы не заполнили логин!';
}
// валидация мыло только на пустоту
if (!empty ($_POST['email'])) {
    $_SESSION['result']['email'] = $_POST['email']; // записываем в сессию
    $flag_e = 1;
} else {
    $_SESSION['error']['email'] = 'Вы не  заполнили e-mail!';
}

//валидация сообщения на пустоту
if (!empty($_POST['message'])) {
    $flag_mes = 1;
    $_SESSION['result']['message'] = $_POST['message'];

} else {
    $_SESSION['error']['message'] = 'Введите сообщение!';
}


if (!empty ($flag_l) && !empty($flag_e)) {
    $_SESSION['auth'] = 'on';
}
header('Location: /dzlesson9_1.php');
exit();



