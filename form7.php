<?php
session_start();
//error_reporting(-1);


/*$login = 'login';
$password = 'password';

if(!empty($_POST['login']) && trim($_POST['login']) == $login){
    $_SESSION['login'] = $login; // записываем в сессию логин правильный
    $flag_l = 1;
    unset($_SESSION['error_login']); // удаляем ошибку
}else{
    $_SESSION['error_login'] = 'Поле логин введено неверно'; // создаем ошибку в сессии
    unset($_SESSION['login']); // удаляем неправильный логин
}
if(!empty($_POST['password']) && trim($_POST['password']) == $password){
    $_SESSION['password'] = $password; // записываем в сессию логин правильный
    $flag_p = 1;
    unset($_SESSION['error_password']); // удаляем ошибку
}else{
    $_SESSION['error_password'] = 'Поле пароль введено неверно'; // создаем ошибку в сессии
    unset($_SESSION['password']); // удаляем неправильный логин
}
if(!empty ($flag_l) && !empty($flag_p)){
    $_SESSION['auth'] = 'on';
    unset($_SESSION['login']);
    unset($_SESSION['password']);
    unset($_SESSION['error_login']);
    unset($_SESSION['error_password']);
}
header('Location: /lesson7.php');
exit();
//var_dump($_SESSION);
?>*/


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

$str = 'Петя любит мороженное';
if (!empty ($_POST['word'])) {
    $mass = explode(' ', $str);
    foreach ($mass as $key => $value) {
        if ($mass[$key] == 'Петя') {
            $mass[$key] = $_POST['word'];
        }
    }

    $success = implode(' ', $mass);

// $success = str_replace('Петя', $_POST['word'], $str);


    if ($success) {
        $_SESSION['word'] = $success;
        //echo '<br>'.$success;
        unset($_SESSION['error_word']);
        $flag_w = 1;
    } else {
        unset($_SESSION['word']);
    }

} else {
    $_SESSION['error_word'] = 'Вы не  ввели слово!';
    unset($_SESSION['word']);

}


if (!empty ($_POST['age'])) {
    if (($_POST['age'] == intval($_POST['age']) && ($_POST['age']) > 0)) {
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

if (!empty ($flag_l) && !empty($flag_a)) {
    $_SESSION['auth'] = 'on';
    unset($_SESSION['login']);
    unset($_SESSION['age']);
    unset($_SESSION['error_login']);
    unset($_SESSION['error_age']);
}
header('Location: /lesson7.php');
exit();

