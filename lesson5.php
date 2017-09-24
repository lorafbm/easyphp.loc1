<?php
error_reporting(-1);
echo 'занятие №5 Глобальные массивы<br>';


//isset empty
//isset проверяет есть ли переменная а empty просто не пустая ли она.
//null уничтож значениепеременной $a= null то не isset

$a = 'qwerty';
$b = '          qwerty  ';
if($a== trim ($b)){
 //   echo 'OK';
}
//trim обрезает вначале и в конце пробелы.

?>



<h3 style="text-align:center">Форма</h3>
<form action = "/form5.php" method="post" style="text-align: center">
    <input type = "text" name = "a" placeholder="a"><br>
    <input type = "text" name = "b" placeholder="b"><br>
    <input type = "text" name = "c" placeholder="c"><br>
    <input type = "submit" value="Отправить"><br>
</form>


