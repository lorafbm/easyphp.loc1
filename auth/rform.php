<?php
session_start();
error_reporting(-1);

define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DATABASE', 'easyphp');

//include_once ("./capcha.php");

function MyHash($var)
{
    $salt = 'ABC';
    $salt2 = 'CBA';
    $var = crypt(md5($var . $salt), $salt2);
    return $var;

}

// запрос в БД
/*function q($query,$key=0)
{
    $connect = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
    $res = mysqli_query($connect, $query);

    if ($res === false) {
        $info = debug_backtrace();
        $error = "QUERY: " . $query ."<br>\n".
            "error: " .mysqli_error($connect)."<br>\n".
            "the error in file:" . $info[0]['file'] ."<br>\n".
            "on the line: " . $info[0]['line'] ."<br>\n".
            "date: " . date("Y-m-d H-i-s")."<br>\n".
            "=======================================================";

        echo $error;        exit();
    } else {
        return $res;
    }
}*/



$_SESSION['result'] = array();//создаем пустые массивы чтобы каждый раз удалялись неправильные данные которые ввел пользователь
$_SESSION['error'] = array();
$connect = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
//валидация логина на пустоту и существование
if (!empty ($_POST['login'])) {
    if (mb_strlen($_POST['login']) < 2) {
        $_SESSION['error']['login'] = 'Логин слишком короткий!';
    } elseif (mb_strlen($_POST['login']) > 16) {
        $_SESSION['error']['login'] = 'Логин слишком длинный!';
    }
    /*проверяем нет ли уже такого логина*/
    $sql1 = "
            SELECT `user_id` FROM `users`
            WHERE `user_name`= '" . $_POST['login'] . "'
              LIMIT 1
        ";
    $res1 = mysqli_query($connect, $sql1);
    if (mysqli_num_rows($res1)) {
        $_SESSION['error']['login'] = 'Такой логин уже существует!';
    } else {
        $_SESSION['result']['login'] = $_POST['login'];//записываем в сессию
        $flag_l = 1;
    }
} else {
    $_SESSION['error']['login'] = 'Заполните логин!';
}
// валидация мыло на пустоту и существование
if (!empty ($_POST['email'])  && (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))) {
    /*проверяем нет ли уже такой почты*/

    $sql2 = "
            SELECT `user_id`  FROM `users`
            WHERE `email` = '" .$_POST['email'] . "'
              LIMIT 1
        ";
    $res2 = mysqli_query($connect, $sql2);
    if ($res2->num_rows) {
        $_SESSION['error']['email'] = 'Такой email уже существует!';
    } else {
        $_SESSION['result']['email'] = $_POST['email']; // записываем в сессию чтоб выводить в форме
        $flag_e = 1;
    }
} else {
    $_SESSION['error']['email'] = 'Заполните e-mail!';
}

/*пароль*/
if (!empty ($_POST['password'])) {
    if (mb_strlen($_POST['password']) < 5) {
        $_SESSION['error']['password'] = 'Пароль слишком короткий!';
    } else {
        $_SESSION['result']['password'] = $_POST['password'];//записываем в сессию
        $flag_p = 1;
    }
} else {
    $_SESSION['error']['password'] = 'Вы не заполнили пароль!';

}


/*капча*/
if(isset($_POST['capcha']) && isset($_SESSION['captcha'])) {
    if (!empty ($_POST['capcha'])) {
        // unset($_SESSION['captcha']);

        if (strtoupper($_POST['capcha']) == strtoupper($_SESSION['captcha'])) {
            $_SESSION['captcha'] = strtoupper($_POST['capcha']);//записываем в сессию
            $flag_c = 1;
        } else {
            $_SESSION['error']['capcha'] = 'Не правильный код с картинки!';
            header("Location: /auth/reg.php");
        }
    } else {
        $_SESSION['error']['capcha'] = 'Введите код с картинки!';

    }
}

if (!empty ($flag_l) && !empty($flag_p) && !empty($flag_e) && !empty($flag_c) ) {

    $sql3 = "INSERT INTO `users` SET
           `user_name`  ='" . $_POST['login'] . "',
           `password`   ='" . MyHash($_POST['password']) . "',
           `email`      ='" .$_POST['email'] . "',
           `hash`       ='" . MyHash($_POST['login'] . ":" . $_POST['email']) . "' 
         
         ";
    mysqli_query($connect, $sql3);

    $_SESSION['result']['info'] = 'Вы зарегистрированы!';
    header('Location: /auth/index.php');
    exit();
}
header('Location: /auth/reg.php');
exit();



