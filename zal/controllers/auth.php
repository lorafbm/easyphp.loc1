<?php
/*авторизация через форму*/
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
            $_SESSION['error']['capcha'] = 'Неправильный код с картинки!';
        }
    } else {
        $_SESSION['error']['capcha'] = 'Введите код с картинки!';
    }
    /*если все ОК то тогда запрос в базу на проверку логина и пароля*/
    if (!empty($flag_l) && !empty($flag_p) && !empty($flag_c)) {
        foreach ($_POST as $k => $v) {
            $_POST[$k] = trimAll($v);
        }

        $res = q(" SELECT * FROM `user_zal`
                 WHERE `user_name`= '" . $_POST['login'] . "' 
                 AND  `password`  = '" . (MyHash($_POST['password'])) . "'
                  LIMIT 1
                ");

        if (mysqli_num_rows($res)) {
            $_SESSION['user'] = mysqli_fetch_assoc($res);//если авторизировалисьто храним в сессии данный идентификатор сессии
            $row = mysqli_fetch_assoc($res);// извлекаем всю информацию о пользователе
            $_SESSION['info_a'] = 'Здравствуйте, ' . ($_SESSION['user']['user_name']) . '!';
            header('Location: /');
            exit();
        } else {
            $_SESSION['result']['info'] = 'Нет пользователя с таким логином и паролем! ';
        }
    }
}
/*авторизация через Facebook*/
if (isset($_GET['code'])) {
    $res = get_token($_GET['code']);
    if (!empty($res)) { // если пользователь залогинен в f
        $result=get_data($res);
        // записали в сессию данные пользователя
        $_SESSION['user']['user_name'] = htmlspecialchars($result->name);
        $_SESSION['user']['user_id'] = $result->id;
        $_SESSION ['flag_f']= 1;
        if (!empty($result->email)) {
            $_SESSION['user']['email'] = $result->email;
        }
        // сначала ищем его в нашей БД по id f
        $sql = q("SELECT `user_id`, `user_name` FROM `user_zal`
                   WHERE  `f_id`  = '" . $result->id . "'
                   LIMIT 1
                ");
        if (mysqli_num_rows($sql)) { // если есть такой
            $data = $sql->fetch_assoc();
            $_SESSION['user']['id'] = $data['user_id'];
            $_SESSION['info_a'] = 'Здравствуйте, ' . $_SESSION['user']['user_name'] . '!';
            header('Location: /');
            exit();
        } else {
            if (!empty($result->email)) {
                // пробуем найти пользователя зарег на этот же email
                $sql_email = q("SELECT `user_id` FROM `user_zal`
                   WHERE  `email`  = '" . $result->email . "'
                   LIMIT 1
                   ");
                if (mysqli_num_rows($sql_email)) { //если уже есть пользователь с таким email то проставляем ему id из f
                    $data = $sql_email->fetch_assoc();
                    $sql = q("UPDATE `user_zal` SET
                            `f_id`  = '" . $result->id . "'
                             WHERE `email`  = '" . $result->email . "'
                             ");
                    $_SESSION['user']['id'] = $data['user_id']; // записали в сессию его id
                    $_SESSION['info_a'] = 'Здравствуйте, ' . $_SESSION['user']['user_name'] . '!';
                    header('Location: /');
                    exit();
                } else {
                    // если нет еще такого ни по id f ни по email  то записываем в бд нового пользователя
                    $sql = q("INSERT INTO `user_zal` SET
                      `user_name`  = '" . res($result->name) . "',
                      `f_id`  = '" . $result->id . "'
                      " . ((!empty($result->email)) ? ",`email` = '" . $result->email . "'" : "") . "
                     ");
                    $_SESSION['user']['id'] = DB::_()->insert_id; // записали в сессию его id
                    $_SESSION['info_a'] = 'Здравствуйте, ' . $_SESSION['user']['user_name'] . '!';
                    header('Location: /');
                    exit();
                }
            }
        }

    } else{
        /*переадресация на авторизацию в  f*/
        header('Location: https://www.facebook.com/');
        exit();
    }
}

getView('auth');
//wtf($data,1);






