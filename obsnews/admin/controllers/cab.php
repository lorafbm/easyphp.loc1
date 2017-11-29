<?php

$sql = "
SELECT  * FROM `users`
WHERE  `user_id`= '" . (int)$_SESSION['user']['user_id'] . "'
LIMIT 1
";
$res = mysqli_query($connect, $sql);
while ($row = mysqli_fetch_assoc($res)){
    $data['user']=$row;
}

/*обработчик формы*/
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
        $sql1 = "
            SELECT `user_id` FROM `users`
            WHERE `user_name` = '" . $_POST['login'] . "'
            AND   `user_id`   <> " . (int)$_SESSION['user']['user_id'] . "
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
    if (!empty ($_POST['email']) && (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))) {
        /*проверяем нет ли уже такой почты*/

        $sql2 = "
            SELECT `user_id`  FROM `users`
            WHERE `email`   = '" . $_POST['email'] . "'
            AND   `user_id` <> " . (int)$_SESSION['user']['user_id'] . "
              LIMIT 1
        ";
        $res2 = mysqli_query($connect, $sql2);
        if (mysqli_num_rows($res2)) {
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
}
/* редатируем пароль если нужно*/
if (!empty ($flag_l)  && !empty($flag_e)) {

    $sql3 = "UPDATE `users` SET 
      `user_name`      ='" . mysqli_real_escape_string($connect,$_POST['login']) . "',
      `email`          ='" . mysqli_real_escape_string($connect,$_POST['email']) . "'
         " . ((!empty($_POST['password'])) ? ",`password` = '" .mysqli_real_escape_string($connect, MyHash($_POST['password'])) . "'" : "") . "
       WHERE `user_id` =" . (int)$_SESSION['user']['user_id'] . "
       ";
    mysqli_query($connect, $sql3);
    $_SESSION['info'] = 'Данные успешно изменены!';
    header('Location: /index.php?route=admin');
    exit();
}


getView_a('cab',$data);
//wtf($_SESSION,1);
//wtf($data,1);
