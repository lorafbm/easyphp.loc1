<main>
    <div class="wrap">
        <?php echo !empty($_SESSION['info_r']) ? $_SESSION['info_r'] : ''; ?>
        <?php if (isset($_SESSION['user'])) { ?>
            <h3><?php echo $_SESSION['info_a']; ?></h3>
            <img src="/image/smile.jpg" alt="pic" style="display: block; margin: 0 auto;">
            <ol>
                <li> Вы можете редактировать содержимое любой новости, добавлять новости и удалять одну иди сразу группу
                    новостей. Для этого откройте меню <b>новости</b>.
                    При загрузке изображений исходник фотографии должен быть не меньше 200px в ширину иначе на странице
                    фотографии будут не одинакового размера.
                </li>
                <li> В меню <b>категории</b> вы можете создавать, удалять и редактировать категории новостей.</li>
                <li> В меню <b>о нас</b> вы можете менять фотографии и текст страницы. При загрузке изображений исходник должен
                    быть не меньше 900px чтобы при увеличении на сайте не потерялось качество изображения.
                </li>
                <li> Если вы хотите <b>изменить адрес, телефон или e-mail,</b> сделайте это в редактировании
                    страницы "О нас" и информация отобразится повсему сайту.
                </li>
                <li>
                    Все <b>исходники фотографий,</b> которые вы загружаете, находятся в папке /uploaded.
                    Если вы не планируете их больше нигдена сайте использовать, то можно удалятьпо необходимости.
                </li>
                <li>
                    Все <b>загруженные фотографии</b> с нужным размером для сайта (после ресайза - подборки оптимальной ширины и высоты)-
                    находятся в папке /photo. Если вы их оттудаудалите - они исчезнутс сайта. Будьте внимательны!
                </li>
                <li>
                    В меню <b>кабинет</b> вы можете сменить логин, пароль, e-mail.
                </li>
                <b>Успехов!</b>
            </ol>

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
                        <input type="submit" name="submit" value="Войти" class="btn btn-info">
                    </div>
                    <a href="/index.php?route=admin&page=reg">Регистрация</a>
                    <p style="color:red; margin-top: 10px;"><?php echo !empty($_SESSION['result']['info']) ? $_SESSION['result']['info'] : ''; ?></p>
                </form>
            </fieldset>
        </div>

    </div>

    <?php } ?>

</main>




