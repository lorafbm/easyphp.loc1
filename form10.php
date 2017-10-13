<?php
session_start();
error_reporting(-1);


//валидация логин
if (!empty ($_POST['login'])) {
    $_SESSION['result']['login'] = $_POST['login']; // записываем в сессию
    $flag_l = 1;
} else {
    $_SESSION['error']['login'] = 'Вы не заполнили логин!';
}


//валидация сообщения
if (!empty($_POST['message'])) {
    $_SESSION['result']['message'] = $_POST['message']; // записываем в сессию
    $flag_m = 1;
} else {
    $_SESSION['error']['message'] = 'Введите сообщение!';
}


if (!empty ($flag_l) && !empty($flag_m)) {
    $_SESSION['newmes'] = $_POST['login'] . '<br>' . date('y-M-d-D h:i:s') . '<br>' . $_POST['message'] . '<br>';
    $_SESSION['auth'] = 'on';
    $file = fopen("comments.txt", "a+"); //открываем для перезаписи файл message.txt лежаший в одной папке с текущей страницей
    fwrite($file, $_SESSION['newmes'] . PHP_EOL); // пишем в файл
    fclose($file); // закрываем файл

}
header('Location: /lesson10.php');
exit();

