<?php
error_reporting(-1);
ini_set('display_errors', - 1);
header('Content-type: text/html; charset=utf-8');
session_start();
/*константы,функции,переменные*/

include_once './config.php';
include_once './system/request.php';

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

}


if ($_SERVER['REQUEST_URI'] == '/') {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/home.php";
} elseif (!empty($filename) && file_exists($filename)) {
    require_once $filename;

} else {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/404.php";
}

