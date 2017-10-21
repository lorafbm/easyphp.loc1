<?php
session_start();
error_reporting(-1);
echo 'Занятие №11.Подключение к БД. Константы. <br><br>';


/*define('ABC','qwerty');
echo ABC;
define('ABC',12);
echo ABC;
*/

define('HOST','localhost');
define('USER','root');
define('PASSWORD', '');
define('DATABASE','easyphp');

/*$dbh = mysql_connect(HOST,USER,PASSWORD) or die ('Нет соединения с БД');
mysql_select_db(DATABASE) or die ('DB');

$sql = "SELECT * FROM `users` ";
$query = mysql_query($sql);
while($res[] = mysql_fetch_assoc($query)){
    $users = $res;
}
var_dump($users);*/
$connect = mysqli_connect(HOST,USER,PASSWORD,DATABASE);

$sql = "SELECT * FROM `users` ";

$query = mysqli_query($connect,$sql);



while ($res[] = mysqli_fetch_assoc($query)){
    $users = $res;
}

var_dump($users);
//phpinfo();
