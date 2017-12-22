<?php
$_SESSION['result'] = array();
$_SESSION['error'] = array();

if (!empty ($_POST['submit'])) {
//валидация логина на пустоту и существование
    if (!empty ($_POST['login'])) {
        if (mb_strlen($_POST['login']) < 2) {
            $_SESSION['error']['login'] = 'Логин слишком короткий!';
        } elseif (mb_strlen($_POST['login']) > 16) {
            $_SESSION['error']['login'] = 'Логин слишком длинный!';
        }
        /*проверяем нет ли уже такого логина*/
        $res1 = q("SELECT `user_id` FROM `user`
                  WHERE `user_name`= '" . $_POST['login'] . "'
                  LIMIT 1
                 ");

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
    if (!empty ($_POST['email']) && (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))) {
        /*проверяем нет ли уже такой почты*/
        $res2 = q("SELECT `user_id`  FROM `user`
                 WHERE `email` = '" . $_POST['email'] . "'
                 LIMIT 1
                 ");

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
    if (isset($_POST['capcha']) && isset($_SESSION['captcha'])) {
        if (!empty ($_POST['capcha'])) {

            if (strtoupper($_POST['capcha']) == strtoupper($_SESSION['captcha'])) {
                $_SESSION['captcha'] = strtoupper($_POST['capcha']);//записываем в сессию
                $flag_c = 1;
            } else {
                $_SESSION['error']['capcha'] = 'Не правильный код с картинки!';
                header("Location: /index.php?route=admin&page=reg");
            }
        } else {
            $_SESSION['error']['capcha'] = 'Введите код с картинки!';
        }
    }
}
if (!empty ($flag_l) && !empty($flag_p) && !empty($flag_e) && !empty($flag_c)) {

    $sql3 = q("INSERT INTO `user` SET
           `user_name`  ='" . $_POST['login'] . "',
           `password`   ='" . MyHash($_POST['password']) . "',
           `email`      ='" . $_POST['email'] . "',
           `hash`       ='" . MyHash($_POST['login'] . ":" . $_POST['email']) . "' 
            ");
    $_SESSION['info_r'] = 'Вы зарегистрированы!';
    header('Location: /');
    exit();
}
getView('reg');
//wtf($data,1);
//wtf($_SESSION,1);
//wtf($_COOKIE,1);
//wtf($_POST,1);


