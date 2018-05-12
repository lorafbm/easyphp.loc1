<?php
function __autoload($class){
    $class = './system/class_'.$class.'.php';
    if (file_exists($class)){
        include $class;
    }else {
        exit('нет класса с именем' .$class);
    }

}
function wtf($array, $stop = false)
{ // вывод массива
    echo '<pre>' . print_r($array, 1) . '</pre>';
    if (!$stop) {
        exit();
    }
}
function getView($name, $data = '',$data1='',$data2='')
{
    return require_once $_SERVER['DOCUMENT_ROOT'] . "/views/" . $name . ".php";
}

function getHeader()
{
    return require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/header.php";
}

function getFooter()
{
    return require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/footer.php";
}

// запрос в БД
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


function trimAll($el)
{ // обработка на удаление пробелов
    if (!is_array($el)) {
        $el = trim($el);
    } else {
        $el = array_map('trimAll', $el);
    }
    return $el;
}



function MyHash($var)
{
    $salt = 'ABC';
    $salt2 = 'CBA';
    $var = crypt(md5($var . $salt), $salt2);
    return $var;
}

function res($el,$key=0){
    return DB::_($key)->real_escape_string($el);
}


/*авторизация f*/

function get_token($code)
{
    $ku = curl_init();

   // $query = "client_id=" . CLIENT_ID . "&redirect_uri=" . urlencode(REDIRECT) . "&client_secret=" . SECRET . "&fields=email,birthday&code=" . $code;
    $query = "client_id=" . CLIENT_ID . "&redirect_uri=" . urlencode(REDIRECT) . "&client_secret=" . SECRET . "&code=" . $code;
    curl_setopt($ku, CURLOPT_URL, TOKEN . "?" . $query);
    curl_setopt($ku, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ku, CURLOPT_HEADER, false);


    $result = curl_exec($ku);
    if (!$result) {
        exit(curl_error($ku));
    }

    $i = json_decode($result, true);
    if (!empty($i['access_token'])) {

        return $i['access_token'];
    }
}

function get_data($token)
{

    $ku = curl_init();

    //$query = "fields=email,name,birthday&access_token=" . $token;
    $query = "&access_token=".$token;
    curl_setopt($ku, CURLOPT_URL, GET_DATA . "?" . $query);
    curl_setopt($ku, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ku, CURLOPT_HEADER, false);

    $result = curl_exec($ku);

    if (!$result) {
        exit(curl_error($ku));
    }

    return json_decode($result);

}

