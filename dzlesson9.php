<?php
session_start();
error_reporting(-1);

$sel_mes = !empty($_SESSION['result']['message']) ? $_SESSION['result']['message'] : '';

if (!empty($_SESSION['auth'])) { ?>
    <p>Ура, вы авторизовались!</p>
<?php } else { ?>
    <link rel="stylesheet" href="/vendor/public/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="dz9style.css">
    <div class="wrapper">
        <fieldset>
            <p>Форма регистации:</p>
            <form action="/dzform9.php" method="post" role="form">
                <div class="form-group">
                    <input type="text" name="login" class="form-control"
                           placeholder="Имя"
                           value="<?php echo !empty($_SESSION['result']['login']) ? $_SESSION['result']['login'] : ''; ?>">
                    <?php if (!empty($_SESSION['error']['login'])) {
                        echo '<span style="color: red;">' . $_SESSION['error']['login'] . '</span>';
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

