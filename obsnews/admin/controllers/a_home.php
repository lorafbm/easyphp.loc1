<?php
//создаем пустые массивы чтобы каждый раз удалялись неправильные данные которые ввел пользователь
$_SESSION['result'] = array();
$_SESSION['error'] = array();

if (!empty($_POST['submit'])) {
    /*проверки на пустоту и правильность введенной капчи*/
    if (!empty ($_POST['login'])) {
        $_SESSION['result']['login'] = $_POST['login'];
        $flag_l = 1;
    } else {
        $_SESSION['error']['login'] = 'Вы не заполнили логин!';
    }

    if (!empty ($_POST['password'])) {
        $_SESSION['result']['password'] = $_POST['password'];
        $flag_p = 1;
    } else {
        $_SESSION['error']['password'] = 'Вы не заполнили пароль!';
    }
    if (!empty ($_POST['capcha'])) {
        if (strtoupper($_POST['capcha']) == strtoupper($_SESSION['captcha'])) {
            $_SESSION['captcha'] = strtoupper($_POST['capcha']);//записываем в сессию
            $flag_c = 1;
        } else {
            $_SESSION['error']['capcha'] = 'Не правильный код с картинки!';
        }
    } else {
        $_SESSION['error']['capcha'] = 'Введите код с картинки!';
    }
    /*если все ОК то тогда запрос в базу на проверку логина и пароля*/
    if (!empty($flag_l) && !empty($flag_p) && !empty($flag_c)) {

        $sql = " SELECT * FROM `users`
                 WHERE `user_name`= '" . mysqli_real_escape_string($connect, $_POST['login']) . "' 
                 AND  `password` = '" . mysqli_real_escape_string($connect, (MyHash($_POST['password']))) . "'
                  LIMIT 1
                ";
        $res = mysqli_query($connect, $sql);
        if (mysqli_num_rows($res)) {
            $_SESSION['user'] = mysqli_fetch_assoc($res);//если авторизировалисьто храним в сессии данный идентификатор сессии
            $row = mysqli_fetch_assoc($res);// извлекаем всю информацию о пользователе
            $_SESSION['info_a'] = 'Здравствуйте, ' . ($_SESSION['user']['user_name']) . '! Добро пожаловать в управление контентом сайта!';
            header('Location: /index.php?route=admin');
            exit();
        } else {
            $_SESSION['result']['info'] = 'Нет пользователя с таким логином и паролем! ';
        }
    }
}
$data['title'] = ' Админ «ABCновости»';

getHeader_a($data);
getView_a('a_home', $data);
//wtf($data,1);
//wtf($_SESSION,1);
//wtf($_POST, 1);
getFooter_a();






