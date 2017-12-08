<?php getHeader_a(); ?>
    <main>
        <div class="wrap">
            <div class="wrapper">
                <fieldset>
                    <p>Ваши данные:</p>
                    <form action="" method="post" role="form">
                        <div class="form-group">
                            <input type="text" name="login" class="form-control"
                                   placeholder="Имя от 2 до 15 символов"
                                   value="<?php echo $data['user']['user_name']; ?>">
                            <?php if (!empty($_SESSION['error']['login'])) {
                                echo '<span style="color: red;">' . $_SESSION['error']['login'] . '</span>';
                            } ?>
                        </div>
                        <div class="form-group">
                            <input type="password" name="password" class="form-control"
                                   placeholder="Пароль не менее 5 символов"
                                   value="">
                            <?php if (!empty($_SESSION['error']['password'])) {
                                echo '<span style="color: red;">' . $_SESSION['error']['password'] . '</span>';
                            } ?>
                        </div>
                        <div class="form-group">
                            <input type="text" name="email" class="form-control" placeholder=" E-mail"
                                   value="<?php echo $data['user']['email']; ?>">
                            <?php if (!empty($_SESSION['error']['email'])) {
                                echo '<span style="color: red;">' . $_SESSION['error']['email'] . '</span>';
                            } ?>
                        </div>

                        <p style="color:red; margin-top: 10px; font-size: 14px;"><?php echo !empty($_SESSION['info']) ? $_SESSION['info'] : ''; ?></p>
                        <input type="submit" name="submit" value="Редактировать" class="btn btn-info">
                    </form>
                </fieldset>
            </div>
    </main>
<?php getFooter_a(); ?>