<?php
session_start();
error_reporting(-1);
echo 'Занятие №24.Полиморфизм. <br><br>';


define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DATABASE', 'easyphp');
/*define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DATABASE', 'main');*/

$connect = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
//var_dump($connect);



/*выбратьфильмы где >2 актеров*/
$sq="SELECT * FROM `publications`";
$qu = mysqli_query($connect, $sq);
while ($re[]=mysqli_fetch_assoc($qu)){
    $us=$re;
}
foreach ($us as $u){
    echo 'Новость: '.$u['title'].'- Автор:'.$u['author_name'].'<br>';
}

