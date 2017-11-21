<?php
//создаем пустые массивы чтобы каждый раз удалялись неправильные данные которые ввел пользователь
$_SESSION['result'] = array();
$_SESSION['error'] = array();
if (!empty($_POST['submit'])) {

    if (!empty ($_POST['login']) && !empty ($_POST['password'])) {
        $sql = "
            SELECT  * FROM `users`
             WHERE  `user_name`= '" . mysqli_real_escape_string($connect,$_POST['login']) . "' 
             AND    `password` = '" . mysqli_real_escape_string($connect,(MyHash($_POST['password']))) . "'
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
            if (isset($_COOKIE['access1'], $_COOKIE['access2'])) {
                include './exit.php';
            }
        }
    } else {
        $_SESSION['error']['login'] = 'Вы не заполнили логин!';
        $_SESSION['error']['password'] = 'Вы не заполнили пароль!';
    }
}
$data['title'] = ' Админ «ОБСновости»';

getHeader_a($data);
getView_a('a_home', $data);
//wtf($data,1);
//wtf($_SESSION,1);
//wtf($_COOKIE,1);
//wtf($_POST, 1);
getFooter_a();






