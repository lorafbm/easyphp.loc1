<?php
session_start();
error_reporting(-1);

function week($num)
{
    if ($num == 1) {
        return 'Пн';
    } elseif ($num == 2) {
        return 'Вт';
    } elseif ($num == 3) {
        return 'Ср';
    } elseif ($num == 4) {
        return 'Чт';
    } elseif ($num == 5) {
        return 'Пт';
    } elseif ($num == 6) {
        return 'Сб';
    } elseif ($num == 7) {
        return 'Вс';
    }
}

/*var_dump($_POST);
var_dump($_SESSION);*/
$_SESSION['result'] = array();
$_SESSION['error'] = array();

if (!empty($_POST['week'])) {
    $_SESSION['result']['week'] = $_POST['week'];
} else {
    $_SESSION['error']['week'] = '<span style="color: red">Нет дня недели!</span>';
}

if (!empty($_POST['pol'])) {
    $_SESSION['result']['pol'] = $_POST['pol'];
} else {
    $_SESSION['error']['pol'] = '<span style="color: red">Не выбран пол!</span>';
}

header('Location:/lesson8.php');
exit();
?>