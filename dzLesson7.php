<?php
session_start();
error_reporting(-1);
var_dump($_SESSION);

if (!empty($_SESSION['auth'])) { ?>
    <p>Ура!</p>
<?php } else { ?>
    <form action="/dzform7.php" method="post">
        <span>Введите имя:  </span><input type="text" name="login" placeholder=" от 4до 15 символов"
                                          value="<?php echo !empty($_SESSION['login']) ? $_SESSION['login'] : ''; ?>">
        <?php if (!empty($_SESSION['error_login'])) {
            echo '<span style="color: red;">' . $_SESSION['error_login'] . '</span>';
        } ?>
        <br/>
        <span>Введите слово: </span><input type="text" name="word" placeholder="слово"
                                           value="<?php echo !empty($_SESSION['word']) ? $_SESSION['word'] : ''; ?>">
        <?php if (!empty($_SESSION['error_word'])) {
            echo '<span style="color: red;">' . $_SESSION['error_word'] . '</span>';
        } ?>
        <br/>
        <span>Введите возраст: </span><input type="text" name="age" placeholder="полных лет"
                                             value="<?php echo !empty($_SESSION['age']) ? $_SESSION['age'] : ''; ?>">
        <?php if (!empty($_SESSION['error_age'])) {
            echo '<span style="color: red;">' . $_SESSION['error_age'] . '</span>';
        } ?>
        <br/>
        <input type="submit" value="Send">
    </form>
<?php } ?>