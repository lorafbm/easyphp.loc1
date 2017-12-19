<?php getHeader(); ?>
<div class="container">

        <?php echo !empty($_SESSION['info_r']) ? $_SESSION['info_r'] : ''; ?>
        <?php if (isset($_SESSION['user'])) { ?>
            <h3><?php echo $_SESSION['info_a']; ?></h3>
            <img src="/image/smile.jpg" alt="pic" style="display: block; margin: 0 auto;">

        <?php } else { ?>
            <div class="wrapper">
                <fieldset>
                    <p>Форма авторизации:</p>
                    <form action="" method="post" role="form">
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
                            <input type="text" name="capcha" class="form-control" placeholder=" введите код с картинки"
                                   value="">
                            <?php if (!empty($_SESSION['error']['capcha'])) {
                                echo '<span style="color: red;">' . $_SESSION['error']['capcha'] . '</span>';
                            } ?>
                        </div>
                        <img src="/views/capcha.php" id="capcha" alt="capcha"><br>
                        <?php echo '<input type="button" onclick="document.getElementById(\'capcha\').src=\'/views/capcha.php?id=\'+
Math.round(Math.random()*9999)" value="Другой код" class=" btn btn-primary">'; ?>
                        <div class="form-group">
                            <div class="form-group">
                                <input type="submit" name="submit" value="Войти" class="btn btn-info">
                            </div>
                            <a href="/index.php?route=reg">Регистрация</a>
                            <p style="color:red; margin-top: 10px;"><?php echo !empty($_SESSION['result']['info']) ? $_SESSION['result']['info'] : ''; ?></p>
                    </form>
                </fieldset>
            </div>
        <?php } ?>
</div>
</main>
<?php getFooter(); ?>




