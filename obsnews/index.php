<?php
error_reporting(-1);
ini_set('display_errors', - 1);
header('Content-type: text/html; charset=utf-8');
session_start();

if (!empty($_GET['route'])) {
    $filename = $_SERVER['DOCUMENT_ROOT'] . "/controllers/" . $_GET['route'] . ".php";
    if (($_GET['route']) == 'admin' && !empty($_GET['page'])) {
        $filename = $_SERVER['DOCUMENT_ROOT'] . "/admin/controllers/" . $_GET['page'] . ".php";
    }
}

require_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/system/request.php";

$connect = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
mysqli_query($connect, "SET CHARSET UTF8");

if ($_SERVER['REQUEST_URI'] == '/') {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/home.php";
} elseif (!empty($filename) && file_exists($filename)) {
    require_once $filename;

} else {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/404.php";
}

if ($_SERVER['REQUEST_URI'] == '/index.php?route=admin') {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/admin/controllers/a_home.php";

} elseif (!empty($filename) && file_exists($filename)) {
    require_once $filename;

} else {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/404.php";
}


//echo $_SERVER['REQUEST_URI'];
//echo $_SERVER['DOCUMENT_ROOT'] ;
//wtf($_GET, 1);
//echo $_SERVER['REQUEST_URI'];
//wtf($_SERVER,1);
//$a=1;