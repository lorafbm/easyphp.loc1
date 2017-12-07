<?php
session_start();
error_reporting(-1);
echo 'Занятие №23.Многие ко многим. <br><br>';


define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DATABASE', 'easyphp');

$connect = mysqli_connect(HOST,USER,PASSWORD,DATABASE);
//var_dump($connect);
$qu = "SELECT u.user_name, ui.phone FROM users u LEFT JOIN user_info ui ON (u.user_id=ui.id) ";

while ($re[]=mysqli_fetch_assoc($qu)){
    $us=$re;
}
foreach ($us as $u){
    echo 'Name:'.$u['name'].'Phone:'.$u['phone'].'<br>';
}
var_dump($us);

