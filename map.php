<?php
error_reporting(-1);
class DB
{
    static public $mysqli = array();
    static public $connect = array();

    static public function _($key = 0)
    {
        if (!isset(self::$mysqli[$key])) {

            if (!isset(self::$connect['server']))
                self::$connect['server'] = Core::$DB_LOCAL;
            if (!isset(self::$connect['user']))
                self::$connect['user'] = Core::$DB_LOGIN;
            if (!isset(self::$connect['pass']))
                self::$connect['pass'] = Core::$DB_PASS;
            if (!isset(self::$connect['db']))
                self::$connect['db'] = Core::$DB_NAME;


            self::$mysqli[$key] = @new mysqli (self::$connect['server'], self::$connect['user'], self::$connect['pass'], self::$connect['db']);

            if (mysqli_connect_errno()) {
                echo 'Не удалось подключиться к базе данных!';
                exit();
            }
            if (!self::$mysqli[$key]->set_charset("utf8")) {
                echo 'Ошибка при загрузке набора символов utf-8:' . self::$mysqli[$key]->error;
                exit();

            }
        }
        return self::$mysqli[$key];
    }

    static public function close($key = 0)
    {
        self::$mysqli[$key]->close();
        unset(self::$mysqli[$key]);
    }
}

class Core
{

    static $DB_NAME   = 'zal';
    static $DB_LOGIN  = 'root';
    static $DB_PASS   = '';
    static $DB_LOCAL  = 'localhost';
    static $DOMAIN    = 'http://localhost';
    /*  static $DB_NAME   = 'id4082200_zal';
      static $DB_LOGIN  = 'id4082200_root1';
      static $DB_PASS   = 'root1';
      static $DB_LOCAL  = 'localhost';*/

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


function parseToXML($htmlStr)
{
    $xmlStr=str_replace('<','&lt;',$htmlStr);
    $xmlStr=str_replace('>','&gt;',$xmlStr);
    $xmlStr=str_replace('"','&quot;',$xmlStr);
    $xmlStr=str_replace("'",'&#39;',$xmlStr);
    $xmlStr=str_replace("&",'&amp;',$xmlStr);
    return $xmlStr;
}


$res = q("SELECT `address_form`,`lat`,`lng`,`user_name`
          FROM `user` 
        ");
header("Content-type: text/xml");


// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
while ($row = $res->fetch_assoc()){

    // Add to XML document node
    echo '<marker ';
    echo 'name="' . parseToXML($row['user_name']) . '" ';
    echo 'address="' . parseToXML($row['address_form']) . '" ';
    echo 'lat="' .$row['lat'] . '" ';
    echo 'lng="' .$row['lng'] . '" ';
    echo '/>';
}


// End XML file
echo '</markers>';





