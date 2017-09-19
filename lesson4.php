<?php
error_reporting(-1);
echo 'занятие №4 Функции<br>';
$name = 'abc';
function hello($name)
{
    return 'Hello, ' . $name;
}

$name = 'Lora';
//echo hello($name);

function num($a, $b, $c = 0, $d = 0)
{
    if ($a > $b) {
        return 'a > b';
    } elseif ($a == $b) {
        return 'a = b';
    } else {
        return 'a < b';
    }
}




