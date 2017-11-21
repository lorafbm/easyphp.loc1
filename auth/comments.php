<?php
session_start();
error_reporting(-1);
//var_dump($_SESSION);
//var_dump($_POST);
define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DATABASE', 'easyphp');



$connect = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

function hsc($el)
{  // обработка вывод на экран : Преобразует специальные символы в HTML сущности
    if (!is_array($el)) {
        $el = htmlspecialchars($el);
    } else {
        $el = array_map('hsc', $el);
    }
    return $el;
}

$_SESSION['result'] = array();
$_SESSION['error'] = array();

/*валидация формы*/
if (empty($_POST['login'])) {
    $_SESSION['error']['login'] = 'Заполните имя!';
} else {
    $_SESSION['result']['login'] = $_POST['login'];//записываем в сессию
    $flag_l = 1;
}
if (empty($_POST['age'])) {
    $_SESSION['error']['age'] = 'Заполните возраст!';
} else {
    $_SESSION['result']['age'] = $_POST['age'];//записываем в сессию
    $flag_a = 1;
}
if (empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error']['email'] = 'Заполните e-mail!';
} else {
    $_SESSION['result']['email'] = $_POST['email'];//записываем в сессию
    $flag_e = 1;
}
if (empty($_POST['message'])) {
    $_SESSION['error']['message'] = 'Заполните комментарий!';
} else {
    $length = mb_strlen($_POST['message']);
    if ($length < 10) {
        $_SESSION['error']['message'] = 'Cлишком короткое сообщение!';
    } else {
        $_SESSION['result']['message'] = $_POST['message'];//записываем в сессию
        $flag_m = 1;
    }
}


if (!empty ($flag_l) && !empty($flag_a) && !empty($flag_e)  && !empty($flag_m)) {//вставляем данные в БД

    $sql = "
            INSERT INTO `comments` SET 
            `name`    ='" . $_POST['login'] . "',
            `age`     ='". $_POST['age'] . "',
            `email`   ='" . $_POST['email'] . "',
            `comments`='" . $_POST['message'] . "'
        ";

    $res = mysqli_query($connect, $sql);
    $_SESSION['infocom'] = 'Ваш комментарий принят!';
    header('Location: /auth/comments.php');
    exit();
}



/*вывод комментариев*/
$sql1 = "
        SELECT * ,DATE_FORMAT( date,  '%d %M %Y %T'  ) as date
        FROM `comments` ORDER BY `id` DESC 
    ";
$res1 = mysqli_query($connect, $sql1);
// получаем список комментариев для вывода их количества на php
$sql2 = "
    SELECT COUNT(*)
    FROM `comments` 
";
$res2 = mysqli_query($connect, $sql2);
$tnum = mysqli_fetch_row($res2);
$num = $tnum[0];

?>


<link rel="stylesheet" href="/vendor/public/bootstrap/dist/css/bootstrap.css">
<link rel="stylesheet" href="./style.css">
<div class="wrapper">
    <?php if (isset($_SESSION['user'])) { ?>
    <fieldset>
        <p>Оставьте свой комментарий:</p>
        <form action="" method="post" role="form">
            <div class="form-group">
                <input type="text" name="login" class="form-control"
                       placeholder="Имя"
                       value="<?php echo !empty($_SESSION['result']['login']) ? $_SESSION['result']['login'] : ''; ?>">
                <?php if (!empty($_SESSION['error']['login'])) {
                    echo '<span style="color: red;">' . $_SESSION['error']['login'] . '</span>';
                } ?>
            </div>
            <div class="form-group">
                <input type="text" name="age" class="form-control"
                       placeholder="Возраст"
                       value="<?php echo !empty($_SESSION['result']['age']) ? $_SESSION['result']['age'] : ''; ?>">
                <?php if (!empty($_SESSION['error']['age'])) {
                    echo '<span style="color: red;">' . $_SESSION['error']['age'] . '</span>';
                } ?>
            </div>
            <div class="form-group">
                <input type="text" name="email" class="form-control" placeholder=" E-mail"
                       value="<?php echo !empty($_SESSION['result']['email']) ? $_SESSION['result']['email'] : ''; ?>">
                <?php if (!empty($_SESSION['error']['email'])) {
                    echo '<span style="color: red;">' . $_SESSION['error']['email'] . '</span>';
                } ?>
            </div>
            <textarea name="message" class="form-control"
                      placeholder="Сообщение не менее 10 символов" value=
                      "<?php echo !empty($_SESSION['result']['message']) ? $_SESSION['result']['message'] : ''; ?>"></textarea>
            <?php if (!empty($_SESSION['error']['message'])) {
                echo '<span style="color: red;">' . $_SESSION['error']['message'] . '</span>';
            } ?>
            <div class="form-group">
                <input type="submit" name="submit" value="Отправить" class="btn btn-info">
            </div>
            <p style="color:red; margin-top: 10px;"><?php echo !empty($_SESSION['infocom']) ? $_SESSION['infocom'] : ''; ?></p>
        </form>
    </fieldset>
    <?php } else {
        echo 'Авторизиуйтесь на сайте для того, чтобы оставлять комментарии !';
    } ?>
</div>
<hr>
<div style="text-align: left; max-width: 980px;margin: 0 auto;">
        <h2 style="text-align: center">Комментарии:</h2>
        <?php if (mysqli_num_rows($res2)) {
            echo '<div id="num"><p style="text-align: center; font-weight: bold;">У нас ' . (int)$num . ' комментариев:</p></div>
    ';
        } else {
            echo '<p class="game">У нас пока нет комментариев.</p> ';
        } ?>
        <?php while ($row = mysqli_fetch_assoc($res1)) {
            echo '<div class="com">
    <div class="commentboxbodycom">' . hsc($row['comments']) . '</div>
    <div class="commentboxname">-' . hsc($row['name']) . ' ' . (int)$row['age'] . ' лет</div>
    <div class="commentboxname">' . hsc($row['date']) . '</div></div><hr>';
        } ?>
</div>





