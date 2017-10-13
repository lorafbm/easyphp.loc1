<?php
session_start();
error_reporting(-1);



$sel_mes = !empty($_SESSION['result']['message']) ? $_SESSION['result']['message'] : '';

if (!empty($_SESSION['auth'])) { ?>
    <p>Ура, вы авторизовались!</p>
    <?php

    echo file_get_contents('comments.txt');


   ?>
    <?php } else { ?>
    <link rel="stylesheet" href="/vendor/public/bootstrap/dist/css/bootstrap.css">
    <style><?php echo file_get_contents('./dz8style.css') ?></style>
    <div class="wrapper">
        <fieldset>
            <p>Форма :</p>
            <form action="/form10.php" method="post" role="form">
                <div class="form-group">
                    <input type="text" name="login" class="form-control"
                           placeholder="Имя от 4 до 15 символов"
                           value="<?php echo !empty($_SESSION['result']['login']) ? $_SESSION['result']['login'] : ''; ?>">
                    <?php if (!empty($_SESSION['error']['login'])) {
                        echo '<span style="color: red;">' . $_SESSION['error']['login'] . '</span>';
                    } ?>
                </div>
               <textarea name="message" class="form-control"
                          placeholder="Сообщение не менее 25 символов"><?php echo !empty($_SESSION['result']['message']) ? $_SESSION['result']['message'] : ''; ?></textarea>
                <p><?php if (!empty ($_SESSION['error']['message'])) {
                        echo '<span style="color: red;">' . $_SESSION['error']['message'] . '</span>';
                    } ?></p>
                <div class="form-group">
                    <input type="submit" value="Отправить" class="btn btn-info">
                </div>
            </form>
        </fieldset>
    </div>
<?php } ?>
