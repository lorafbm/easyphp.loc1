<?php

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

    static $DB_NAME = 'zal';
    static $DB_LOGIN = 'root';
    static $DB_PASS = '';
    static $DB_LOCAL = 'localhost';
    static $DOMAIN = 'http://localhost';
    /*  static $DB_NAME   = 'id4082200_zal';
      static $DB_LOGIN  = 'id4082200_root1';
      static $DB_PASS   = 'root1';
      static $DB_LOCAL  = 'localhost';*/

}


Class Form
{

    public $error = array();//массив ошибок
    public $mem = array();

    public function startForm($method, $name = '', $action = '')
    {
        return '<form action="' . $action . '" method="' . $method . '" name ="' . $name . '">';
    }

    public function endForm($name, $value)
    {
        return '<input type="submit" name="' . $name . '" value="' . $value . '" class="btn btn-primary"></form>';
    }


    public function makeText($name, $type, $placeholder = '', $label = '')
    {
        $id = rand(0, 99);
        $text = '<div class="form-group"><label for="' . $id . '">' . $label . '</label><input type="' . $type . '" name="' . $name . '" placeholder="' . $placeholder . '" class="form-control" id="' . $id . '"';
        if (!empty($this->mem[$name])) {
            $text .= ' value="' . htmlspecialchars($this->mem[$name]) . '"';
        }
        $text .= '></div>';


        if (!empty($this->error[$name])) {
            $text .= '<p>' . $this->error[$name] . '</p>';
        }
        return $text;
    }


    public function make_textarea($name, $placeholder = '', $label = '', $rows = '')
    {
        $id = rand(0, 99);
        $textarea = '<div class="form-group"><label for="' . $id . '">' . $label . '</label>
<textarea name="' . $name . '" placeholder = "' . $placeholder . '" rows="' . $rows . '" class="form-control" id ="' . $id . '">';
        if (!empty($this->mem[$name])) {
            $textarea .= $this->mem[$name];
        }
        $textarea .= '</textarea></div>';
        if (!empty($this->error[$name])) {
            $textarea .= '<p>' . $this->error[$name] . '</p>';
        }
        return $textarea;
    }

    public function makeRadio($name, $text)
    {
        $radio = '';
        for ($i = 1; $i <= count($text); $i++) {
            $radio .= '<div class="form-check"><label class="form-check-label"><input type="radio" name="' . $name . '" value="' . $i . '" class="form-check-input"';
            if (!empty($this->mem[$name]) && $this->mem[$name] == $i) {
                $radio .= ' checked';
            }
            $radio .= '>' . $text[$i - 1] . '</label></div>';//-1 тк перебор начали с 1 а не с 0
        }
        if (!empty($this->error[$name])) {
            $radio .= '<p>' . $this->error[$name] . '</p>';
        }
        return $radio;
    }

    public function makeCheckbox($name, $value)
    {
        $checkbox = '';
        foreach ($value as $key => $val) {
            $checkbox .= '<div class="form-check"><label class="form-check-label"><input type="checkbox" name="' . $name . '[]" value="' . $key . '" class="form-check-input"';
            if (!empty($this->mem[$name])) {
                foreach ($this->mem[$name] as $k => $v) {
                    if ($v == $key) {
                        $checkbox .= ' checked';
                    }
                }
            }
            $checkbox .= '>' . $val . '</label></div>';
        }
        if (!empty($this->error[$name])) {
            $checkbox .= '<p>' . $this->error[$name] . '</p>';
        }
        return $checkbox;
    }


    public function makeSelect($name, $val, $opt1 = '')
    {
        $select = '<div class="form-group"><select name="' . $name . '"><option disabled selected class="form-control">' . $opt1 . '</option>';
        foreach ($val as $key => $item) {
            $select .= '<option  value="' . $key . '"';
            if (!empty($this->mem[$name]) && $this->mem[$name] == $key) {
                $select .= ' selected';
            }
            $select .= '>' . $item . '</option>';
        }
        $select .= '</select></div>';
        if (!empty($this->error[$name])) {
            $select .= '<p>' . $this->error[$name] . '</p>';
        }
        return $select;

    }

}


Class valid_Data
{

    /**валидация поля формы на пустоту и длину
     * @param $name имя поля из формы
     * @param bool $length если 1-проверяем длину 0- только пустоту
     * @param bool $email - если 1-проверка по параметрам email
     * @return string ошибки
     */
    public function val_Field($name, $length = false, $email = false)
    {
        if (is_array($name)) {
            foreach ($name as $item) {
                $name = trim($item);
            }
        } else {
            $name = trim($name);
        }
        if ($length == 1) {// на длинну
            if (empty($name)) {
                return '<p class="text-danger">Вы не заполнили поле!</p>';
            } else {
                $length = mb_strlen($name);
                if ($email) {
                    if (!filter_var($name, FILTER_VALIDATE_EMAIL)) {
                        return '<p class="text-danger">Введите правильно email!</p>';
                    }
                } else {
                    if ($length < 2) {
                        return '<p class="text-danger"> Введите не менее 2-х символов!</p>';

                    } elseif ($length > 15) {
                        return '<p class="text-danger">Не более 15 символов!</p>';
                    }
                }
            }
        } else {//только на пустоту
            if (empty($name)) {
                return '<p class="text-danger">Вы не заполнили поле!</p>';
            }
        }
    }

    /**
     * @param $name  адрес пользователя
     * @return string ошибка если <7 или >30 символов
     */
    public function val_address($name)
    {
        $name = trim($name);
        if (empty($name)) {
            return '<p class="text-danger">Вы не заполнили поле!</p>';
        } else {
            $length = mb_strlen($name);

            if ($length < 7) {
                return '<p class="text-danger"> Введите не менее 7 символов!</p>';

            } elseif ($length > 30) {
                return ' <p class="text-danger">Не более 30 символов!</p>';
            }

        }

    }

    /**
     * @param $name пароль
     * @return string ошибка
     */
    public function val_pass($name)
    {
        $name = trim($name);
        if (empty($name)) {
            return '<p class="text-danger">Вы не заполнили поле!</p>';
        } else {
            $length = mb_strlen($name);

            if ($length < 5) {
                return '<p class="text-danger"> Введите не менее 5 символов!</p>';

            } elseif ($length > 10) {
                return ' <p class="text-danger">Не более 10 символов!</p>';
            }

        }

    }

    /** проверка на уникальность логин и почты
     * @param $data имя поля в бд
     * @param $name поле в посте
     * @return string ошибку если есть в бд
     */

    public function data_uniq($data, $name)
    {
        $name = trim($name);

        $res = q("SELECT `user_id` FROM `user`
                  WHERE $data = '" . $name . "'
                  LIMIT 1
                ");
        if ($res->num_rows) {
            return '<p class="text-danger">Такое значение уже существует!</p>';
        }
    }

    /**
     * @param $name  адрес пользователя который он ввел как попало
     * @return mixed адрес без знаков препинания-заменили их на пробелы
     */
    public function do_address($name)
    {
        $array = array('.', ',', ':', ';');
        $name = str_replace($array, ' ', $name);
        return $name;
    }
}

class Geo
{
    /**
     * @var GOOGLE API KEY
     */
    public $user_api_key;

    function __construct($user_api_key)
    {
        $this->user_api_key = $user_api_key;
    }

    /**
     * @param $city - адрес в формате пр победы 12 харьков
     * @return array 1-широта 2- долгота 3- формат адрес
     */

    public function geocode($city)
    {
        $cityclean = str_replace(" ", "+", $city);
        $details_url = "https://maps.googleapis.com/maps/api/geocode/json?language=ru&address=" . $cityclean . "&sensor=false&key=" . $this->user_api_key;
        //echo $details_url;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $details_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $geoloc = json_decode(curl_exec($ch));

        $res = array();
        $res['lat_coord'] = $geoloc->results[0]->geometry->location->lat;
        $res['lng_coord'] = $geoloc->results[0]->geometry->location->lng;
        $res['loc'] = $geoloc->results[0]->formatted_address;

        return $res;
    }

// Перекодировка в UTF-8
    public function cp1251_to_utf8_recursive(/*mixed*/
        $map)
    {
        if (is_array($map)) {
            $d = array();
            foreach ($d as $k => &$v) {
                $d[cp1251_to_utf8_recursive($k)] = cp1251_to_utf8_recursive($v);
            }
            return $d;
        }
        if (is_string($map)) return iconv('cp1251', 'utf-8//IGNORE//TRANSLIT', $map);
        if (is_scalar($map) or is_null($map)) return $map;
        #throw warning, if the $map is resource or object:
        trigger_error('An array, scalar or null type expected, ' . gettype($map) . ' given!', E_USER_WARNING);
        return $map;
    }


}

// запрос в БД
function q($query, $key = 0)
{
    $res = DB::_($key)->query($query);
    if ($res === false) {
        $info = debug_backtrace();
        $error = "QUERY: " . $query . "<br>\n" .
            "error: " . DB::_($key)->error . "<br>\n" .
            "the error in file:" . $info[0]['file'] . "<br>\n" .
            "on the line: " . $info[0]['line'] . "<br>\n" .
            "date: " . date("Y-m-d H-i-s") . "<br>\n" .
            "=======================================================";
        file_put_contents('./logs/mysql.log', strip_tags($error) . "\n\n", FILE_APPEND);
        echo $error;
        exit();
    } else {
        return $res;
    }
}

function MyHash($var)
{
    $salt = 'ABC';
    $salt2 = 'CBA';
    $var = crypt(md5($var . $salt), $salt2);
    return $var;
}

function parseToXML($htmlStr)
{
    $xmlStr = str_replace('<', '&lt;', $htmlStr);
    $xmlStr = str_replace('>', '&gt;', $xmlStr);
    $xmlStr = str_replace('"', '&quot;', $xmlStr);
    $xmlStr = str_replace("'", '&#39;', $xmlStr);
    $xmlStr = str_replace("&", '&amp;', $xmlStr);
    return $xmlStr;
}

