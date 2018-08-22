<?php

function __autoload($class){
    $class = './classes/class_'.$class.'.php';
    if (file_exists($class)){
        include $class;
    }else {
        exit('нет класса с именем' .$class);
    }

}

function res($el,$key=0){
    return DB::_($key)->real_escape_string($el);
}

/**
 * @param $query query DB
 * @param int $key
 * @return mixed
 */
function q($query,$key=0)
{
    $res = DB::_($key)-> query($query);
    if ($res === false) {
        $info = debug_backtrace();
        $error = "QUERY: " . $query ."<br>\n".
            "error: " . DB::_($key)-> error ."<br>\n".
            "the error in file:" . $info[0]['file'] ."<br>\n".
            "on the line: " . $info[0]['line'] ."<br>\n".
            "date: " . date("Y-m-d H-i-s")."<br>\n".
            "=======================================================";


        file_put_contents('./logs/mysql.log', strip_tags($error) . "\n\n", FILE_APPEND);
        echo $error;        exit();
    } else {
        return $res;
    }
}