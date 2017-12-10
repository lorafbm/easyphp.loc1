<?php
session_start();
$_SESSION['info'] = '';
require_once 'class22.php';
//require_once '../class22.php';
$db = new DB('localhost', 'root', '', 'easyphp');
//$db = new DB('mysql.hostinger.com.ua', 'u836104334_test', 'vxiiS916aL', 'u836104334_main');
$query1 = "SELECT `form_content`, `send_result` FROM `forms` ORDER BY `id` DESC LIMIT 1";
$q1 = $db->myQuery($query1);
if (mysqli_num_rows($q1)) {
    $res = mysqli_fetch_assoc($q1);
} else {
    $_SESSION['info'] = 'Форма не существует!';
}
if (!empty($_POST['submit'])) {
    $b = new Valid2;
    $error = array();

    if (!$error['address'] = $b->val_Field($_POST['address'], 1)) {
        if($res['send_result'] == 1) {
            //выводим данніе на єкран
            $_SESSION['address'] = trim($_POST['address']);
        } elseif ($res['send_result'] == 2){
            //записываем в БД
            $query2 = "INSERT INTO `results` SET `content` = '".trim($_POST['address'])."'";
            $q2 = $db->myQuery($query2);
            if($q2 != false){
                $_SESSION['info'] = 'Данные записаны в БД!';
            }
        }elseif ($res['send_result'] == 3){
            //отправляем на почту
            $message = trim($_POST['address']);
            // На случай если какая-то строка письма длиннее 70 символов мы используем wordwrap()
            $message = wordwrap($message, 70, "\r\n");
            // Отправляем
           if(mail('l.fatyan@gmail.com', 'My Subject', $message)) {
               $_SESSION['info'] = 'Данные отправлены на почту!';
           }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>LESSON 22</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
          integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb"
          crossorigin="anonymous">
    <style>
        main {
            padding: 50px 0;
        }

        form {
            width: 40%;
            margin: 0 auto;
        }

        p {
            color: red;
        }
    </style>
</head>
<body>
<main>
    <?php if (!empty($_SESSION['info'])) { ?>
        <div class="alert alert-primary" role="alert"><?php echo $_SESSION['info'];
            unset($_SESSION['info']); ?></div>
    <?php }
    if (!empty($res)) { ?>
        <div><?php echo $res['form_content']; ?></div>
    <?php }
    if(!empty($_SESSION['address'])){
        echo 'адрес: '.$_SESSION['address'];
        unset($_SESSION['address']);
    }elseif (!empty($error['address'])){
        echo $error['address'];
    }
    ?>
</main>
</body>
</html>
