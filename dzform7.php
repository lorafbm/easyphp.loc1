<?php
session_start();
error_reporting(-1);

//валидация логин
if (!empty ($_POST['login'])) {
    $length = mb_strlen($_POST['login']);

    if ($length < 4) {
        $_SESSION['error_login'] = 'Логин слишком короткий!';
        unset($_SESSION['login']); // удаляем неправильный логин
    } elseif ($length > 15) {
        $_SESSION['error_login'] = 'Логин слишком длинный!';
        unset($_SESSION['login']); // удаляем неправильный логин
    } else {
        $_SESSION['login'] = $_POST['login']; // записываем в сессию
        unset($_SESSION['error_login']); // удаляем ошибку
        $flag_l = 1;
    }
} else {
    $_SESSION['error_login'] = 'Вы не  заполнили логин!';

}
//замена слова
$str = 'Петя любит мороженное';
if (!empty ($_POST['word'])) {
    $mass = explode(' ', $str);
    foreach ($mass as $key => $value) {
        if ($mass[$key] == 'Петя') {
            $mass[$key] = $_POST['word'];
        }
    }
    $success = implode(' ', $mass);

    if ($success) {
        $_SESSION['word'] = $success;
        unset($_SESSION['error_word']);
        $flag_w = 1;
    } else {
        unset($_SESSION['word']);
    }
} else {
    $_SESSION['error_word'] = 'Вы не  ввели слово!';
    unset($_SESSION['word']);
}

//валидация возраст
if (!empty ($_POST['age'])) {
    if (($_POST['age'] == intval($_POST['age']) && ($_POST['age']) > 0)) {
        $_POST['age']  = (int)$_POST['age'];
       /* echo $_POST['age'];
        exit();*/
        $_SESSION['age'] = (int)$_POST['age']; // записываем в сессию
        unset($_SESSION['error_age']); // удаляем ошибку
        $flag_a = 1;
    } else {
        $_SESSION['error_age'] = 'Введите целое положительное число!';
        unset($_SESSION['age']); // удаляем неправильный логин
    }
} else {
    $_SESSION['error_age'] = 'Вы не  заполнили возраст!';
}

if (!empty ($flag_l) && !empty($flag_a) && !empty($flag_w)) {
    $_SESSION['auth'] = 'on';
    unset($_SESSION['login']);
    unset($_SESSION['age']);
    unset($_SESSION['word']);
    unset($_SESSION['error_login']);
    unset($_SESSION['error_age']);
    unset($_SESSION['error_word']);
}
header('Location: /dzlesson7.php');
exit();

