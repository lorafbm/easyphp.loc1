<?php
session_start();
error_reporting(-1);
//var_dump($_SESSION);
define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DATABASE', 'easyphp');

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

?>

<link rel="stylesheet" href="/vendor/public/bootstrap/dist/css/bootstrap.css">
<style><?php echo file_get_contents('./style.css') ?></style>
<div class="wrapper">
    <fieldset>
        <p>Ваши данные:</p>
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
                       value="<?php echo $row['password']; ?>">
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
                <a  href="/auth/uedit.php/?id=<?php echo (int)$row['user_id']; ?>">Редактировать</a>
            </div>
            <p style="color:red; margin-top: 10px;"><?php echo !empty($_SESSION['info']) ? $_SESSION['info'] : ''; ?></p>
        </form>
    </fieldset>
</div>
