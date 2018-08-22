<?php
error_reporting(-1);
ini_set('display_errors', 1);
header('Content-type: text/html; charset=utf-8');
session_start();


include_once $_SERVER['DOCUMENT_ROOT']. '/config.php';
include_once $_SERVER['DOCUMENT_ROOT']. '/classes/functions.php';

if (!isset($_GET['route'])) {
    $_GET['route'] = 'home';
}

/*роутер*/
ob_start();
if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/controllers/'  . $_GET['route'] . '.php') || !file_exists($_SERVER['DOCUMENT_ROOT'].'/views/'  . $_GET['route'] .'.tpl')){
    header("Location: /index.php?route=404");
    exit();

}
include  $_SERVER['DOCUMENT_ROOT'] . '/controllers/' . $_GET['route'] . '.php';
include $_SERVER['DOCUMENT_ROOT'] .'/views/'. $_GET['route'] . '.tpl';

$content = ob_get_contents();
//redirect
if(!empty($_GET['key'])) {
    $list = q("SELECT *
               FROM `urls`
               WHERE `kee` = '" . $_GET['key'] . "'
               LIMIT 1
              ");

    if(mysqli_num_rows($list)){
        $row=mysqli_fetch_assoc($list);
        header("HTTP/1.1 301 Moved Permanently");
        header('Location: ' . $row['url']);
        exit();
    } else {
        header('HTTP/1.0 404 Not Found');
        echo 'Unknown link.';
    }
}
ob_end_clean();

include $_SERVER['DOCUMENT_ROOT'].'/views/index.tpl';


