<?php
session_start();
error_reporting(-1);
echo 'занятие №8. Сессии(SESSION) Практика.<br><br>';

function week($num)
{
    if ($num == 1) {
        return 'Пн';
    } elseif ($num == 2) {
        return 'Вт';
    } elseif ($num == 3) {
        return 'Ср';
    } elseif ($num == 4) {
        return 'Чт';
    } elseif ($num == 5) {
        return 'Пт';
    } elseif ($num == 6) {
        return 'Сб';
    } elseif ($num == 7) {
        return 'Вс';
    }
}

var_dump($_POST);
var_dump($_SESSION);
$sel = !empty($_SESSION['result']['week']) ? $_SESSION['result']['week'] : '';
$rad = !empty($_SESSION['result']['pol']) ? $_SESSION['result']['pol'] : '';
?>

<fieldset>
    <form action="/form8.php" method="post" style="text-align: center;">
        <textarea name="message"></textarea><br>
        <span><?php if (!empty ($_SESSION['error']['week'])) {
                echo $_SESSION['error']['week'];
            } ?><span><br>
    <select name="week">
        <option value="0">---</option>
        <?php for ($i = 1; $i < 8; $i++) { ?>
            <option value="<?php echo $i; ?>"<?php echo !empty($sel) && $sel==$i ? 'selected' : ''; ?>><?php echo week($i); ?></option>
        <?php } ?>
    </select><br>
                <label><input type="radio" name="pol" value="1" <?php echo !empty($rad) && $rad == 1 ? 'checked' : ''; ?>>Мужчина</label><br>
                <label><input type="radio" name="pol" value="2" <?php echo !empty($rad) && $rad == 2 ? 'checked' : ''; ?>>Женщина</label><br>
      <span><?php if (!empty ($_SESSION['error']['pol'])) {
              echo $_SESSION['error']['pol'];
          } ?><span><br>
    <input type=submit>
    </form>
</fieldset>



