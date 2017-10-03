<?php
session_start();
error_reporting(-1);
//echo 'занятие №7. Алгоритмы.Сессии(SESSION)<br><br>';


/*$_SESSION['a'] = 6;
echo $_SESSION['a'];
unset($_SESSION['a']);*/

//$a = 12;
//echo $a == 12 ? 'ok' : '';
var_dump($_SESSION);
/*if (!empty($_SESSION['auth'])) { ?>
    <p>Ура, вы авторизовались!</p>
<?php } else { ?>
    <form action="/form7.php" method="post">
        <input type="text" name="login" placeholder="Login"
               value="<?php echo !empty($_SESSION['login']) ? $_SESSION['login'] : ''; ?>">
        <?php if (!empty($_SESSION['error_login'])) {
            echo '<span style="color: red;">' . $_SESSION['error_login'] . '<span>';
        } ?>
        <br/>
        <input type="password" name="password" placeholder="Password"
               value="<?php echo !empty($_SESSION['password']) ? $_SESSION['password'] : ''; ?>">
        <?php if (!empty($_SESSION['error_password'])) {
            echo '<span style="color: red;">' . $_SESSION['error_password'] . '<span>';
        } ?>
        <br/>
        <input type="submit" value="Send">
    </form>
<?php } ?>*/


