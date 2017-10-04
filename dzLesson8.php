<?php
session_start();
error_reporting(-1);
//var_dump($_SESSION);
//var_dump($_POST);
/*вывод названий месяцев*/
function month($num)
{
    if ($num == 1) {
        return 'Январь';
    } elseif ($num == 2) {
        return 'Февраль';
    } elseif ($num == 3) {
        return 'Март';
    } elseif ($num == 4) {
        return 'Апрель';
    } elseif ($num == 5) {
        return 'Май';
    } elseif ($num == 6) {
        return 'Июнь';
    } elseif ($num == 7) {
        return 'Июль';
    } elseif ($num == 8) {
        return 'Август';
    } elseif ($num == 9) {
        return 'Сентябрь';
    } elseif ($num == 10) {
        return 'Октябрь';
    } elseif ($num == 11) {
        return 'Ноябрь';
    } elseif ($num == 12) {
        return 'Декабрь';
    }
}


$sel = !empty($_SESSION['result']['day']) ? $_SESSION['result']['day'] : '';
$rad = !empty($_SESSION['result']['pol']) ? $_SESSION['result']['pol'] : '';
$sel_m = !empty($_SESSION['result']['month']) ? $_SESSION['result']['month'] : '';
$sel_y = !empty($_SESSION['result']['year']) ? $_SESSION['result']['year'] : '';
$sel_mes = !empty($_SESSION['result']['message']) ? $_SESSION['result']['message'] : '';

if (!empty($_SESSION['auth'])) { ?>
    <p>Ура, вы авторизовались!</p>
    <p><?php echo 'Здравствуйте, ' . $_SESSION['result']['login']; ?></p>
    <p><?php echo 'Вашe-mail: ' . $_SESSION['result']['email']; ?></p>
    <p><?php echo 'Вы: ' . $_SESSION['result']['pol']; ?></p>
    <p><?php echo 'Дата рождения: ' . $_SESSION['result']['day'] . ' ' . month($_SESSION['result']['month']) . ' ' . $_SESSION['result']['year']; ?></p>
    <p><?php echo 'Вам: ' . $_SESSION['age'] . 'лет'; ?></p>
    <p><?php echo 'Ваше сообщение: ' . $_SESSION['result']['message']; ?></p>
<?php } else { ?>
    <link rel="stylesheet" href="/vendor/public/bootstrap/dist/css/bootstrap.css">
    <style><?php echo file_get_contents('./dz8style.css') ?></style>
    <div class="wrapper">
        <fieldset>
            <p>Форма регистации:</p>
            <form action="/dzform8.php" method="post" role="form">
                <div class="form-group">
                    <input type="text" name="login" class="form-control"
                           placeholder="Имя от 4 до 15 символов"
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
                <div class="form-group">
                    <label class="radio-inline"><input type="radio" name="pol"
                                                       value="1" <?php echo !empty($rad) && $rad == 1 ? 'checked' : ''; ?>>Мужчина</label>
                    <label class="radio-inline"><input type="radio" name="pol" class="radio-inline"
                                                       value="2" <?php echo !empty($rad) && $rad == 2 ? 'checked' : ''; ?>>Женщина</label>
                    <p><?php if (!empty ($_SESSION['error']['pol'])) {
                            echo '<span style="color: red;">'.$_SESSION['error']['pol'].'</span>';
                        } ?></p>
                </div>
                <select name="day" class="form-control">
                    <option value="0">-День-</option>
                    <?php for ($i = 1; $i < 32; $i++) { ?>
                        <option value="<?php echo $i; ?>"<?php echo !empty($sel) && $sel == $i ? 'selected' : ''; ?>><?php echo $i; ?></option>
                    <?php } ?>
                </select>
                <p><?php if (!empty ($_SESSION['error']['day'])) {
                        echo '<span style="color: red;">'.$_SESSION['error']['day'].'</span>';
                    } ?></p>
                <select name="month" class="form-control">
                    <option value="0">-Месяц-</option>
                    <?php for ($i = 1; $i < 13; $i++) { ?>
                        <option value="<?php echo $i; ?>"<?php echo !empty($sel_m) && $sel_m == $i ? 'selected' : ''; ?>><?php echo month($i); ?></option>
                    <?php } ?>
                </select>
                <p><?php if (!empty ($_SESSION['error']['month'])) {
                        echo '<span style="color: red;">'.$_SESSION['error']['month'].'</span>';
                    } ?></p>
                <select name="year" class="form-control">
                    <option value="0">-Год-</option>
                    <?php for ($i = 1950; $i < 2017; $i++) { ?>
                        <option value="<?php echo $i; ?>"<?php echo !empty($sel_y) && $sel_y == $i ? 'selected' : ''; ?>><?php echo $i; ?></option>
                    <?php } ?>
                </select>
                <p><?php if (!empty ($_SESSION['error']['year'])) {
                        echo '<span style="color: red;">'.$_SESSION['error']['year'].'</span>';
                    } ?></p>

                <textarea name="message" class="form-control"
                          placeholder="Сообщение не менее 25 символов"><?php echo !empty($_SESSION['result']['message']) ? $_SESSION['result']['message'] : ''; ?></textarea>
                <p><?php if (!empty ($_SESSION['error']['message'])) {
                        echo '<span style="color: red;">'.$_SESSION['error']['message'].'</span>';
                    } ?></p>
                <div class="form-group">
                    <input type="submit" value="Отправить" class="btn btn-info">
                </div>
            </form>
        </fieldset>
    </div>
<?php } ?>
