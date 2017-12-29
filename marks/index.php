<?php
error_reporting(-1);
ini_set('display_errors', - 1);
header('Content-type: text/html; charset=utf-8');
session_start();
/*константы,функции,переменные*/

include_once './config.php';
include_once './system/request.php';
//echo  $_SERVER['REQUEST_URI'];
/*проверка соединения с БД*/
/*$res=q("SELECT NOW()");
while ($row = $res->fetch_assoc()){
    wtf($row,1);
}
$res->close();
DB::close();
echo 'OK!';
exit();*/

if (!empty($_GET['route'])) {
    $filename = $_SERVER['DOCUMENT_ROOT'] . "/controllers/" . $_GET['route'] . ".php";
   /* if (($_GET['route']) == 'admin' && !empty($_GET['page'])) {
        $filename = $_SERVER['DOCUMENT_ROOT'] . "/admin/controllers/" . $_GET['page'] . ".php";
    }*/
}

//$connect = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
//mysqli_query($connect, "SET CHARSET UTF8");

if ($_SERVER['REQUEST_URI'] == '/') {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/home.php";
} elseif (!empty($filename) && file_exists($filename)) {
    require_once $filename;

} else {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/404.php";
}


/*if ($_SERVER['REQUEST_URI'] == '/index.php?route=admin') {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/admin/controllers/a_home.php";

} elseif (!empty($filename) && file_exists($filename)) {
    require_once $filename;

} else {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/404.php";
}*/


