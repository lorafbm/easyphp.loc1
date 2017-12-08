<?php
error_reporting(-1);
ini_set('display_errors', - 1);
header('Content-type: text/html; charset=utf-8');
session_start();
/*константы,функции,переменные*/

include_once './config.php';
include_once './libs/default.php';
include_once './libs/classes.php';
/*проверка соединения с БД*/
/*$res=q("SELECT NOW()");
while ($row = $res->fetch_assoc()){
    wtf($row,1);
}
$res->close();
DB::close();
echo 'OK!';
exit();*/

/*ЧПУ*/
if (isset($_GET['route'])) {
    $temp = explode('/', $_GET['route']);
    if ($temp[0] == 'admin') {
        Core::$CONT = Core::$CONT . '/admin';
        Core::$SKIN = 'admin';
        unset ($temp[0]);
    }
    $i = 0;
    foreach ($temp as $k => $v) {
        if ($i == 0) {
            if (!empty($v)) {
                $_GET['controllers'] = $v;
            }
        } elseif ($i == 1) {
            if (!empty($v)) {
                $_GET['page'] = $v;
            }
        } else {
            $_GET['key' . ($k - 1)] = $v;
        }
        ++$i;
    }
    unset($_GET['route']);
}
// статичные страницы берем  из  БД
if (!isset ($_GET['controllers'])) {
    $_GET['controllers'] = 'static';
}else {
    $res = q("
    SELECT *
    FROM `pages`
    WHERE `controller` = '" . res($_GET['controllers']) . "'
    LIMIT 1
    ");

    if (!$res->num_rows) {
        header("Location: /404");
        exit();
    }else{
        $staticpage = $res->fetch_assoc();
        $res->close();
        if ($staticpage['static']==1){
            $_GET['controllers'] = 'staticpage';
            $_GET['page'] = 'main';
        }
    }
}


if (!isset($_GET['page'])) {
    $_GET['page'] = 'main';
}

if (!preg_match('#^[a-z-_]*$#iu',$_GET['page'])){
    header("Location: /404");
    exit();
}
/*роутер*/
ob_start();
//include './'. Core::$CONT .'/allpages.php';
if(!file_exists('./'. Core::$CONT .'/' . $_GET['controllers'] . '/' . $_GET['page'] . '.php') || !file_exists('./view/' . Core::$SKIN .'/'.$_GET['controllers'].'/'.$_GET['page'].'.tpl')){
    header("Location: /404");
    exit();
}
include './'. Core::$CONT .'/' . $_GET['controllers'] . '/' . $_GET['page'] . '.php';

include './view/' . Core::$SKIN .'/'.$_GET['controllers'].'/'.$_GET['page'].'.tpl';

$content = ob_get_contents();
ob_end_clean();



include './view/index.tpl';
wtf($_GET['route']);