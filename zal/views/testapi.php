<?php getHeader(); ?>
<div class="container">
    <div class="wrapper">
        <h4>Ваши данные:</h4>
        <p class="text-left"><?php echo '<span>Ваш ID:</span><b> ' . $_SESSION['user']['id']; ?></b></p>
        <p class="text-left"><?php if (!empty ($_SESSION['user']['user_id'])) {
                echo '<span>Ваш ID facebook: </span><b>' . $_SESSION['user']['user_id'] . '</b>';
            } else {
                echo '<span>Ваш ID facebook: </span>';
            } ?></p>
        <p class="text-left"><?php echo '<span>Ваш login: </span><b>' . $_SESSION['user']['user_name'] . '</b>'; ?></p>
        <p class="text-left"><?php if (!empty ($_SESSION['user']['email'])) {
                echo '<span>Email: </span><b>' . $_SESSION['user']['email'] . '</b>';
            } else {
                echo '<span>Email: </span>';
            } ?></p>
        <p class="text-left"><?php echo '<span>Ваш token:</span><b> ' . $_SESSION['user']['hash']; ?></b></p>
        <hr style="border-top: 1px solid #ffffff;">
        <h4>Получить токен</h4>
        <p class="text-left">URL: lora.school-php.com/testapi/{login}/{password}</p>
        <p class="text-left">Метод: POST</p>
        <p class="text-left">Параметры запроса:</p>
        <table class="test">
            <th>
                <tr>
                    <td>Параметр</td>
                    <td>Тип данных</td>
                    <td>Описание</td>
                </tr>
            </th>
            <tbody>
            <tr>
                <td>login</td>
                <td>string</td>
                <td>Логин</td>
            </tr>
            <tr>
                <td>password</td>
                <td>string</td>
                <td>Пароль</td>
            </tr>
            </tbody>
        </table>
        <p class="text-left">Ответ:</p>
        <table class="test">
            <th>
                <tr>
                    <td>Параметр</td>
                    <td>Тип данных</td>
                    <td>Описание</td>
                </tr>
            </th>
            <tbody>
            <tr>
                <td>status</td>
                <td>string</td>
                <td>Статус "ok" или "error"</td>
            </tr>
            <tr>
                <td>response</td>
                <td>string</td>
                <td>Тело ответа: непосредственно токен</td>
            </tr>
            <tr>
                <td>error</td>
                <td>string</td>
                <td>Статус ошибки: 0 или текст ошибки</td>
            </tr>
            <tr>
                <td>id</td>
                <td>integer</td>
                <td>id пользователя</td>
            </tr>
            </tbody>
        </table>
        <fieldset>
            <h6 class="text-left">Тест получить токен:</h6>
            <form action="" method="post" role="form" id="getToken" onsubmit="return get_Token(login,password)">
                <div class="form-group">
                    <input type="text" name="login" id="login" class="form-control"
                           placeholder="Login">
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" class="form-control"
                           placeholder="Password">
                </div>
                <div class="form-group">
                    <input type="submit" name="getToken" value="Получить" class="btn btn-info">
                </div>
                <div id="result_token" style="border: 0px solid white;padding: 5px;"></div>
            </form>
        </fieldset>
        <hr style="border-top: 1px solid #ffffff;">
        <h4>Получить список сетей привязанных к аккаунту</h4>
        <p class="text-left">URL: lora.school-php.com/testapi/{token}/{format}</p>
        <p class="text-left">Метод: POST</p>
        <p class="text-left">Параметры запроса:</p>
        <table class="test">
            <th>
                <tr>
                    <td>Параметр</td>
                    <td>Тип данных</td>
                    <td>Описание</td>
                </tr>
            </th>
            <tbody>
            <tr>
                <td>token</td>
                <td>string</td>
                <td>Токен</td>
            </tr>
            <tr>
                <td>format</td>
                <td>string</td>
                <td>JSON, XML. По умолчанию JSON</td>
            </tr>
            </tbody>
        </table>
        <p class="text-left">Ответ:</p>
        <table class="test">
            <th>
                <tr>
                    <td>Параметр</td>
                    <td>Тип данных</td>
                    <td>Описание</td>
                </tr>
            </th>
            <tbody>
            <tr>
                <td>status</td>
                <td>string</td>
                <td>Статус "ok" или "error"</td>
            </tr>
            <tr>
                <td>response</td>
                <td>string</td>
                <td>Тело ответа: непосредственно название сети</td>
            </tr>
            <tr>
                <td>error</td>
                <td>string</td>
                <td>Статус ошибки: 0 или текст ошибки</td>
            </tr>
            </tbody>
        </table>
        <h6 class="text-left">Тест получить список сетей:</h6>
        <fieldset>
            <form action="" method="post" role="form" id="getListSocial" onsubmit="return getListSocial(token)">
                <div class="form-group">
                    <input type="text" name="token" id="token" class="form-control"
                           placeholder="Token">
                </div>
                <div class="form-group">
                    <input type="text" name="format"  id="format" class="form-control"
                           placeholder="xml или пустое для json">
                </div>
                <div class="form-group">
                    <input type="submit" name="getList" value="Получить" class="btn btn-info">
                </div>
                <div id="result_list" style="border: 0px solid white;padding: 5px;"></div>
            </form>
        </fieldset>
        <hr style="border-top: 1px solid #ffffff;">
        <h4>Отвязать аккаунт от соц сетей:</h4>
        <p class="text-left">URL: lora.school-php.com/testapi/{token}</p>
        <p class="text-left">Метод: DELETE</p>
        <p class="text-left">Параметры запроса:</p>
        <table class="test">
            <th>
                <tr>
                    <td>Параметр</td>
                    <td>Тип данных</td>
                    <td>Описание</td>
                </tr>
            </th>
            <tbody>
            <tr>
                <td>token</td>
                <td>string</td>
                <td>Токен</td>
            </tr>
            </tbody>
        </table>
        <p class="text-left">Ответ:</p>
        <table class="test">
            <th>
                <tr>
                    <td>Параметр</td>
                    <td>Тип данных</td>
                    <td>Описание</td>
                </tr>
            </th>
            <tbody>
            <tr>
                <td>status</td>
                <td>string</td>
                <td>Статус "ok" или "error"</td>
            </tr>
            <tr>
                <td>text</td>
                <td>string</td>
                <td>Тело ответа: сообщение об отвязке</td>
            </tr>
            <tr>
                <td>error</td>
                <td>string</td>
                <td>Статус ошибки: 0 или текст ошибки</td>
            </tr>
            </tbody>
        </table>
        <h6 class="text-left">Тест отвязать аккаунт:</h6>
        <fieldset>
            <form action="" method="post" role="form" id="delSocial" onsubmit="return del_f(id)">
                <div class="form-group">
                    <input type="text" name="id" id="id" class="form-control"
                           placeholder="id">
                </div>
                <div class="form-group">
                    <input type="submit" name="delete" value="Отвязать" class="btn btn-info">
                 </div>
                <div id="delete" style="border: 0px solid white;padding: 5px;"></div>
            </form>
        </fieldset>
    </div>
</div>
</main>
<?php getFooter(); ?>


