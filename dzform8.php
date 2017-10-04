<?php
session_start();
error_reporting(-1);
//var_dump($_POST);

/*вывод правильного кол-ва дней в месяце*/
function checkqdays($month)
{
    $mass_right[1] = 31;
    $mass_right[2] = 28;
    $mass_right[3] = 31;
    $mass_right[4] = 30;
    $mass_right[5] = 31;
    $mass_right[6] = 30;
    $mass_right[7] = 31;
    $mass_right[8] = 31;
    $mass_right[9] = 30;
    $mass_right[10] = 30;
    $mass_right[11] = 30;
    $mass_right[12] = 31;
    foreach ($mass_right as $key => $value) {
        if ($key == $month) {
            return $mass_right[$key];
        }
    }
}
/*вычисление возраста из даты рождения*/
function age($birthday)
{
    $birthday_timestamp = strtotime($birthday);
    $age = date('Y') - date('Y', $birthday_timestamp);
    if (date('md', $birthday_timestamp) > date('md')) {
        $age--;
    }
    return $age;
}

/*транслитерация*/
function translit($str) {
    $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
    $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya');
    return str_replace($rus, $lat, $str);
}

$_SESSION['result'] = array();
$_SESSION['error'] = array();

//валидация логин
if (!empty ($_POST['login'])) {
    $mass = explode(' ', $_POST['login']);

    if (count($mass) < 2) {
        $length = mb_strlen($_POST['login']);
        if ($length < 4) {
            $_SESSION['error']['login'] = 'Логин слишком короткий!';
        } elseif ($length > 15) {
            $_SESSION['error']['login'] = 'Логин слишком длинный!';
        } else {
            $_SESSION['result']['login'] = $_POST['login']; // записываем в сессию
            $flag_l = 1;
        }
    } else {
        $_SESSION['error']['login'] = 'Логин это только одно слово!';
    }
} else {
    $_SESSION['error']['login'] = 'Вы не заполнили логин!';
}
// валидация мыло толькона наличие не более одного символа @
if (!empty ($_POST['email'])) {
    $length = mb_strlen($_POST['email']);
    if ($length < 2) {
        $_SESSION['error']['email'] = 'E-mail слишком короткий!';
    } else {
        $mass = explode('@', $_POST['email']);
        if (count($mass) == 2) {
            $_SESSION['result']['email'] = $_POST['email']; // записываем в сессию
            $flag_e = 1;

        } elseif (count($mass) > 1) {
            $_SESSION['error']['email'] = 'В e-mail  только один  @!';
        } elseif (count($mass) > 15) {
            $_SESSION['error']['email'] = 'В e-mail  только один  @!';
        } else {
            $_SESSION['error']['email'] = 'В e-mail один из символов должен быть @!';
        }
    }
} else {
    $_SESSION['error']['email'] = 'Вы не  заполнили e-mail!';
}

//валидация радио на пустоту
if (!empty($_POST['pol'])) {
    if ($_POST['pol'] = 1) {
        $_SESSION['result']['pol'] = 'Мужчина';
    } elseif ($_POST['pol'] = 2) {
        $_SESSION['result']['pol'] = 'Женщина';
    }

    $flag_p = 1;
} else {
    $_SESSION['error']['pol'] = 'Не выбран пол!';
}

//валидация день
if (!empty($_POST['day'])) {
    if ($_POST['day'] > 28) {
        $q_right = checkqdays($_POST['month']);
        if ($_POST['day'] > $q_right) {
            $_SESSION['error']['day'] = 'В этом месяце не более ' . $q_right . ' дней!';
        }
    }
    $_SESSION['result']['day'] = $_POST['day'];
    $flag_d = 1;
} else {
    $_SESSION['error']['day'] = 'Не выбран день!';
}

//валидация месяц
if (!empty($_POST['month'])) {
    $_SESSION['result']['month'] = $_POST['month'];
    $flag_m = 1;
} else {
    $_SESSION['error']['month'] = 'Не выбран месяц!';
}
//валидация год
if (!empty($_POST['year'])) {
    $_SESSION['result']['year'] = $_POST['year'];
    $flag_y = 1;
} else {
    $_SESSION['error']['year'] = 'Не выбран год!';
}

//получение возраста пользователя
if (!empty($_POST['day']) && !empty($_POST['month']) && !empty($_POST['year'])) {
    $birthday = $_POST['year'] . '-' . $_POST['month'] . '-' . $_POST['day'];
    $_SESSION['age'] = age($birthday);
}
//валидация сообщения
if (!empty($_POST['message'])) {
    $length = mb_strlen($_POST['message']);
    if ($length < 25) {
        $_SESSION['error']['message'] = 'Слишком короткое сообщение!';
    } else {
        $needle = array('черный', 'белый', 'красный');
        $replace = 'желтый';
        $haystack = $_POST['message'];
        $str = str_replace($needle, $replace, $haystack);
        $_SESSION['result']['message'] = translit($str);
        $flag_mes = 1;

    }
} else {
    $_SESSION['error']['message'] = 'Введите сообщение!';
}


if (!empty ($flag_l) && !empty($flag_e) && !empty($flag_p) && !empty($flag_d) && !empty($flag_m) && !empty($flag_y) && !empty($flag_mes)) {
    $_SESSION['auth'] = 'on';
}
header('Location: /dzlesson8.php');
exit();

