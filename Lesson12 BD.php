<?php
session_start();
error_reporting(-1);
echo 'Занятие №12.БД. Запросы. <br><br>';


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
}*/
//var_dump($users);
$connect = mysqli_connect(HOST,USER,PASSWORD,DATABASE);

$sql = "SELECT * FROM `users` ";

$query = mysqli_query($connect,$sql);



while ($res[] = mysqli_fetch_assoc($query)){
    $users = $res;
}
foreach ($users as $user){
 //   echo $user['user_id'].'.Имя: '.$user['user_name'].', пароль: '.$user['password'].'<br>';
}


$connect = mysqli_connect(HOST,USER,PASSWORD,DATABASE);
$res = mysqli_fetch_assoc(mysqli_query($connect,
    "SELECT COUNT(*) AS kol FROM users"));
//echo $res['kol'].'<br>';

//var_dump($users);
//phpinfo();
/*добавить*/
$sql2 = "INSERT INTO users SET user_name='Venya',password='qwerty123'";
//mysqli_query($connect,$sql2);

/*удалить*/
$sql3 = "DELETE FROM users WHERE user_id=2";
//mysqli_query($connect,$sql3);

/*обновление*/
$sql4 = "UPDATE users SET password='xxx' WHERE user_id=1";
//mysqli_query($connect,$sql4);

/*добавить в цикле 50 записей*/

for($i=1; $i<51;$i++){
    $ins = "INSERT INTO users SET
      user_name='Login".$i."',password='pass".$i."'";
  //  mysqli_query($connect,$ins);
}

/*сортировки*/
$sql5="SELECT user_name, password FROM users ORDER BY user_id ASC ";
$query5 = mysqli_query($connect,$sql5);
while ($res5[] = mysqli_fetch_assoc($query5)){
    $users5=$res5;
}
foreach ($users5 as $user5){
    //echo 'Name: '.$user5['user_name']. '. Password: '.$user5['password'].'<br>';
}
/*$page = 1970;
$sql6 = "SELECT user_name, password FROM users ORDER BY user_id DESC LIMIT ".$page.",10";
$query6 = mysqli_query($connect,$sql6);
while ($res6[] = mysqli_fetch_assoc($query6)){
    $users6=$res6;
}
foreach ($users6 as $user6){
   // echo 'Name: '.$user6['user_name']. '. Password: '.$user6['password'].'<br>';
}
*/

$sql7="SELECT * FROM users WHERE user_id > 10 AND user_id < 30";
$sql8="SELECT * FROM users WHERE (user_id = 15 OR user_id = 25)
AND user_id <20";
$query8 = mysqli_query($connect,$sql8);
while ($res8[] = mysqli_fetch_assoc($query8)){
    $a = $res8;
}
var_dump($a);