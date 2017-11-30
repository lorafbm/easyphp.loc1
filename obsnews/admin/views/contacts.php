<?php getHeader_a(); ?>
<main>
    <div class="wrap">
        <div class="wrapper">
            <fieldset>
                <p>Изменить контакты:</p>
                <form action="" method="post" role="form">
                    <div class="form-group">
                        <input type="text" name="address" class="form-control"
                               placeholder="Введите адрес"
                               value="<?php echo $data['contacts']['address']; ?>">
                        <?php if (!empty($data['errors']['address'])) {
                            echo '<span style="color: red;">' . $data['errors']['address'] . '</span>';
                        } ?>
                    </div>
                    <div class="form-group">
                        <input type="text" name="phone" class="form-control"
                               placeholder="Введите телефон"
                               value="<?php echo $data['contacts']['phone']; ?>">
                        <?php if (!empty($data['errors']['phone'])) {
                            echo '<span style="color: red;">' . $data['errors']['phone'] . '</span>';
                        } ?>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder=" Введите e-mail"
                               value="<?php echo $data['contacts']['email']; ?>">
                        <?php if (!empty($data['errors']['email'])) {
                            echo '<span style="color: red;">' . $data['errors']['email'] . '</span>';
                        } ?>
                    </div>
<!--                    <p style="color:red; margin-top: 10px; font-size: 14px;">--><?php //echo !empty($_SESSION['info']) ? $_SESSION['info'] : ''; ?><!--</p>-->
                    <input type="submit" name="submit" value="Редактировать" class="btn btn-info">
                </form>
            </fieldset>
        </div>
</main>
<?php getFooter_a(); ?>