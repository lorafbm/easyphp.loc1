<?php
session_start();
error_reporting(-1);

define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DATABASE', 'easyphp');

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

if (!empty ($_POST['login']) && !empty ($_POST['password'])) {
    $sql= "
            SELECT  * FROM `users`
             WHERE  `user_name`= '" . $_POST['login'] . "' 
             AND    `password` = '" . (MyHash($_POST['password'])) . "'
              LIMIT 1
        ";
    $res = mysqli_query($connect, $sql);
    if (mysqli_num_rows($res)) {
        $_SESSION['user'] = mysqli_fetch_assoc($res);//если авторизировалисьто храним в сессии данный идентификатор сессии
        $row = mysqli_fetch_assoc($res);// извлекаем всю информацию о пользователе
       // $_SESSION['info'] = '<p class="game">Вы авторизованы,' . ($_SESSION['result']['login']) . '!<p>';


        if (isset($_POST['remember'])) {
            //новые ключи записываем в cookies браузера пользователя
            setcookie('access1', $_SESSION['user']['user_id'], time() + 60 * 60 * 24);
            $_COOKIE['access1'] = $_SESSION['user']['user_id'];
            setcookie('access2', MyHash($row['user_name'] . $row['email']), time() + 60 * 60 * 24);
            $_COOKIE['access2'] = MyHash($row['user_name'] . $row['email']);
            $new_hash = MyHash($row['user_name'] . $row['email']);//генерируем новый секретный ключ из (логина +email)
            // всю вычисленную информацию записываем в базу данных;

            $sql1 =  "
                UPDATE `users` SET
                `hash`               ='" . $new_hash . "',
                `ip`                 ='" . $_POST['ip'] . "',
                `httpuseragent`      ='" . $_POST['hua'] . "'
                   WHERE `user_name` ='" . $_POST['login'] . "'
            ";
            $res1 = mysqli_query($connect, $sql1);

        }
        header('Location: /auth/index.php');
        exit();
    } else {
        $_SESSION['result']['info'] = 'Нет пользователя с таким логином и паролем! ';
        if (isset($_COOKIE['access1'], $_COOKIE['access2'])){
            include './exit.php';
        }
    }

} else {
    $_SESSION['error']['login'] = 'Вы не заполнили логин!';
    $_SESSION['error']['password'] = 'Вы не заполнили пароль!';

}
header('Location: /auth/auth.php');
exit();










