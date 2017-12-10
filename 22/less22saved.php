<?php
session_start();
$_SESSION['info'] = array();
require_once 'class22.php';
//require_once '../class22.php';
$db = new DB('localhost', 'root', '', 'easyphp');
//$db = new DB('mysql.hostinger.com.ua', 'u836104334_test', 'vxiiS916aL', 'u836104334_main');
if (!empty($_SESSION['form']) && !empty($_SESSION['form_name']) && !empty($_SESSION['send_result'])) {
    $str = implode('&nbsp;', $_SESSION['form']);
    echo $str;
    $f = new Form2;
    $form = $f->startForm('post', $_SESSION['form_name']);
    $form .= $str;
    $form .= $f->endForm('submit', 'send');
    $query = "INSERT INTO `forms` SET
              `form_content` = '" . $form . "',
              `form_name`    = '" . $_SESSION['form_name'] . "',
              `send_result`  = '" . $_SESSION['send_result'] . "'              
               ";
    $q = $db->myQuery($query);
    if ($q != false) {
        $_SESSION['info']['cong'] = 'Поздравляем, форма успешно добавлена в БД!';
        $_SESSION['info']['show'] = 'Показать форму';
//        unset($_SESSION['form']);
//        unset($_SESSION['form_name']);
//        unset($_SESSION['send_result']);
    } else {
        $_SESSION['info']['error'] = 'Шаблон формы не сохранен в БД!';
    }
} else {
    $_SESSION['info']['error'] = 'Шаблон формы не создан!';
}
if (!empty($_GET['show'])) {
    $query1 = "SELECT `form_content`, `send_result` FROM `forms` ORDER BY `id` DESC LIMIT 1";
    $q1 = $db->myQuery($query1);
    unset($_SESSION['info']['error']);
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
<main style="padding: 50px 100px;"><?php if (!empty($_SESSION['info']['error'])) { ?>
        <div class="alert alert-primary" role="alert"><?php echo $_SESSION['info']['error'];
            unset($_SESSION['info']['error']); ?>
        </div>
        <a href="less22-1.php">Назад к конструктору формы</a>
    <?php } elseif(!empty($_SESSION['info']['cong']) && !empty($_SESSION['info']['show'])) { ?>
        <div class="alert alert-primary" role="alert"><?php echo $_SESSION['info']['cong'];
            unset($_SESSION['info']['cong']); ?></div>
        <div class="alert alert-warning" role="alert"><a
                    href="less22saved.php?show=yes"><?php echo $_SESSION['info']['show'];
                unset($_SESSION['info']['show']); ?></a></div>
        <!--        <div class="alert alert-warning" role="alert"><a-->
        <!--                    href="/addon/less22saved.php?show=yes">--><?php //echo $_SESSION['info']['show']; ?><!--</a></div>-->
    <?php }
    if (!empty($_GET['show'])) {
        if (mysqli_num_rows($q1)) {
            $res[] = mysqli_fetch_assoc($q1);
            foreach ($res as $v) {
                ?>
                <div><?php echo $v['form_content']; ?></div>
            <?php } ?>
            <a href="less22-1.php">Назад к конструктору формы</a>
            <?php
            unset($_SESSION['form']);
            unset($_SESSION['form_name']);
            unset($_SESSION['send_result']);
        }
    }
    ?>
</main>
</body>
</html>