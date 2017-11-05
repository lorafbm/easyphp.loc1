<?php
session_start();
error_reporting(-1);
//var_dump($_SESSION);
?>

<link rel="stylesheet" href="/vendor/public/bootstrap/dist/css/bootstrap.css">
<style><?php echo file_get_contents('./style.css') ?></style>
<div class="flip-container">
    <div class="flipper">
        <div class="back">
            <div class="wrapper">
                <fieldset>
                    <p>Форма авторизации:</p>
                    <form action="/auth/aform.php" method="post" role="form">
                        <div class="form-group">
                            <input type="text" name="login" class="form-control"
                                   placeholder="Имя от 2 до 15 символов"
                                   value="<?php echo !empty($_SESSION['result']['login']) ? $_SESSION['result']['login'] : ''; ?>">
                            <?php if (!empty($_SESSION['error']['login'])) {
                                echo '<span style="color: red;">' . $_SESSION['error']['login'] . '</span>';
                            } ?>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control"
                                   placeholder="Пароль не менее 5 символов"
                                   value="<?php echo !empty($_SESSION['result']['password']) ? $_SESSION['result']['password'] : ''; ?>">
                            <?php if (!empty($_SESSION['error']['password'])) {
                                echo '<span style="color: red;">' . $_SESSION['error']['password'] . '</span>';
                            } ?>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Войти" class="btn btn-info">
                        </div>
                        <a href = "/auth/reg.php">Регистрация</a>
                        <p style="color:red; margin-top: 10px;"><?php echo !empty($_SESSION['result']['info']) ? $_SESSION['result']['info'] : ''; ?></p>
                    </form>
                </fieldset>
            </div>
            <!-- back content -->
        </div>
    </div>
</div>
