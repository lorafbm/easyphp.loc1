<?php
error_reporting(-1);
echo 'занятие №6. Формы. Обработка форм<br><br>';

?>
<!--<fieldset>
<form action = "/form6.php" method="post">
    <span>Сколькобудет 2*2?</span><br>
    <label><input type = "radio" name = "q1" value="1">2</label><br>
    <label><input type = "radio" name = "q1" value="2">4</label><br>
    <label><input type = "radio" name = "q1" value="3">6</label><br>
    <br><br>
    <span>Сколькобудет 11*11?</span><br>
    <label><input type = "radio" name = "q2" value="1">121</label><br>
    <label><input type = "radio" name = "q2" value="2">111</label><br>
    <label><input type = "radio" name = "q2" value="3">666</label><br>
    <br><br>
    <span>Сколькобудет 7*7?</span><br>
    <label><input type = "radio" name = "q3" value="1">45</label><br>
    <label><input type = "radio" name = "q3" value="2">77</label><br>
    <label><input type = "radio" name = "q3" value="3">49</label><br>
    <br>
    <input type="submit" value="Отправить">
</form>
</fieldset>-->

<form action = "/form6.php" method="get">

    <input type = "checkbox" name = "w1[q1]" value="1">1<br>
    <input type = "checkbox" name = "w2[q2]" value="2">2<br>
    <input type = "checkbox" name = "w3[q3]" value="3">3<br>
<br><br>

    <select name="color">
        <option value="0">-Выберите цвет-</option>
        <option value="1">Red-</option>
        <option value="2">Green</option>
        <option value="3">Blue</option>
    </select>

    <input type="submit" value="Отправить">

</form>


