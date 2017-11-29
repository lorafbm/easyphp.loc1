<?php getHeader_a(); ?>
    <main>
        <div class="wrap">
            <div class="wrapper">
                <fieldset>
                    <p>Форма регистрации:</p>
                    <form action="" method="post" role="form">
                        <div class="form-group">
                            <input type="text" name="login" class="form-control"
                                   placeholder="Имя от 2 до 15 символов"
                                   value="<?php echo !empty($_SESSION['result']['login']) ? htmlspecialchars($_SESSION['result']['login']) : ''; ?>">
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
                            <input type="text" name="email" class="form-control" placeholder=" E-mail"
                                   value="<?php echo !empty($_SESSION['result']['email']) ? $_SESSION['result']['email'] : ''; ?>">
                            <?php if (!empty($_SESSION['error']['email'])) {
                                echo '<span style="color: red;">' . $_SESSION['error']['email'] . '</span>';
                            } ?>
                        </div>
                        <div class="form-group">
                            <input type="text" name="capcha" class="form-control" placeholder=" введите код с картинки"
                                   value="">
                            <?php if (!empty($_SESSION['error']['capcha'])) {
                                echo '<span style="color: red;">' . $_SESSION['error']['capcha'] . '</span>';
                            } ?>
                        </div>
                        <img src="/admin/views/capcha.php" id="capcha" alt="capcha"><br>
                        <?php echo '<input type="button" onclick="document.getElementById(\'capcha\').src=\'/admin/views/capcha.php?id=\'+
Math.round(Math.random()*9999)" value="Другой код" class=" btn btn-primary">'; ?>
                        <div class="form-group">
                            <input type="submit" name="submit" value="Отправить" class="btn btn-info">
                        </div>
                    </form>
                </fieldset>
            </div>
        </div>
    </main>
<?php getFooter_a(); ?>