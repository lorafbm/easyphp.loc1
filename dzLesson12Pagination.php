<?php
error_reporting(-1);

define('HOST','localhost');
define('USER','root');
define('PASSWORD', '');
define('DATABASE','easyphp');

/*1.узнаем кол во записей в БД */
$connect = mysqli_connect(HOST,USER,PASSWORD,DATABASE);
$res = mysqli_fetch_assoc(mysqli_query($connect,
    "SELECT COUNT(*) AS kol FROM users"));

/*2.расчет кол ва ссылок для пагинации*/
$page_q = ceil($res['kol']/2);

/*3.выводим нужноеколичество ссылок*/
for ($i=1;$i<($page_q+1);$i++){
    echo '<a href = ./?page='.$i.'>Страница'.$i.'</a><br><br>';
}

/*4.рассчитываем с какой записи выводить*/
$page = $_GET['page']*2-2;

/*5. выводим записи согласно номеру страницы*/
$sql_page = "SELECT * FROM users ORDER BY user_id DESC LIMIT ".$page.",2";
    $query_page = mysqli_query($connect,$sql_page);
    while ($res_page[] = mysqli_fetch_assoc($query_page)){
    $users_page=$res_page;
    }
    foreach ($users_page as $user_page){
     echo 'ID: '.$user_page['user_id'].'Name: '.$user_page['user_name']. '. Password: '.$user_page['password'].'<br>';
    }