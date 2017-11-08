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

$connect = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

$_SESSION['result'] = array();//создаем пустые массивы чтобы каждый раз удалялись неправильные данные которые ввел пользователь
$_SESSION['error'] = array();

$sql = "
SELECT  * FROM `users`
WHERE  `user_id`= '" . (int)$_SESSION['user']['user_id'] . "'
LIMIT 1
";
$res = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($res);

/*обработчик формы*/

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
            AND   `user_id`   <> " . (int)$_GET['id'] . "
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
            AND   `user_id` <> " . (int)$_GET['id'] . "
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
/* редатируем пароль если нужно*/
if (!empty ($flag_l)  && !empty($flag_e)) {

    $sql3 = "UPDATE `users` SET 
      `user_name`      ='" . $_POST['login'] . "',
      `email`          ='" . $_POST['email'] . "'
         " . ((!empty($_POST['password'])) ? ",`password` = '" . MyHash($_POST['password']) . "'" : "") . "
       WHERE `user_id` =" . (int)$_GET['id'] . "
       ";
    mysqli_query($connect, $sql3);

    $_SESSION['info'] = 'Данные успешно изменены!';
    header('Location: /auth/cab.php');
    exit();
}

?>

    <link rel="stylesheet" href="/vendor/public/bootstrap/dist/css/bootstrap.css">
    <style><?php echo file_get_contents('./style.css') ?></style>
    <div class="wrapper">
        <fieldset>
            <p>Изменить данные:</p>
            <form action="" method="post" role="form">
                <div class="form-group">
                    <input type="text" name="login" class="form-control"
                           placeholder="Имя от 2 до 15 символов"
                           value="<?php echo $row['user_name']; ?>">
                    <?php if (!empty($_SESSION['error']['login'])) {
                        echo '<span style="color: red;">' . $_SESSION['error']['login'] . '</span>';
                    } ?>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control"
                           placeholder="Пароль не менее 5 символов"
                           value="">
                    <?php if (!empty($_SESSION['error']['password'])) {
                        echo '<span style="color: red;">' . $_SESSION['error']['password'] . '</span>';
                    } ?>
                </div>
                <div class="form-group">
                    <input type="text" name="email" class="form-control" placeholder=" E-mail"
                           value="<?php echo $row['email']; ?>">
                    <?php if (!empty($_SESSION['error']['email'])) {
                        echo '<span style="color: red;">' . $_SESSION['error']['email'] . '</span>';
                    } ?>
                </div>
                <div class="form-group">
                    <input type="submit" value="Редактировать" class="btn btn-info">
                </div>
                <!--<p style="color:red; margin-top: 10px;"><?php echo !empty($_SESSION['info']) ? $_SESSION['info'] : ''; ?></p>-->
            </form>
        </fieldset>
    </div>
