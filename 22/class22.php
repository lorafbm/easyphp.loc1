<?php
class Form2
{
    public $error = array();
    public $mem = array();

    public function startForm($method, $name = '', $action = '')
    {
        return '<form action="' . $action . '" method="' . $method . '" name ="'.$name.'">';
    }

    public function endForm($name, $value)
    {
        return '<input type="submit" name="' . $name . '" value="' . $value . '" class="btn btn-primary"></form>';
    }

    public function makeText($name, $type, $placeholder='', $label='')
    {
        $id = rand(0, 99);
        $text = '<div class="form-group">
<label for="'.$id.'">'.$label.'</label><input type="'.$type.'" name="' . $name . '" placeholder="' . $placeholder . '" class="form-control" id="'.$id.'"';

        $text .= '></div>';
        if (!empty($this->mem[$name])) {
        $text .= ' value="' . htmlspecialchars($this->mem[$name]) . '"';
    }

        if (!empty($this->error[$name])) {
            $text .= '<p>' . $this->error[$name] . '</p>';
        }
        return $text;
    }

//    public function makePass($name, $placeholder)
//    {
//        $pass = '<div class="form-group"><input type="password" name="' . $name . '" placeholder="' . $placeholder . '" class="form-control"';
//        if (!empty($this->mem[$name])) {
//            $pass .= ' value="' . htmlspecialchars($this->mem[$name]) . '"';
//        }
//        $pass .= '></div>';
//        if (!empty($this->error[$name])) {
//            $pass .= '<p>' . $this->error[$name] . '</p>';
//        }
//        return $pass;
//    }
//
//    public function makeEmail($name, $placeholder)
//    {
//        $email = '<div class="form-group"><input type="email" name="' . $name . '" placeholder="' . $placeholder . '" class="form-control"';
//        if (!empty($this->mem[$name])) {
//            $email .= ' value="' . $this->mem[$name] . '"';
//        }
//        $email .= '></div>';
//        if (!empty($this->error[$name])) {
//            $email .= '<p>' . $this->error[$name] . '</p>';
//        }
//        return $email;
//    }

    public function make_textarea($name, $placeholder='', $label ='', $rows = '')
    {
        $id = rand(0, 99);
        $textarea = '<div class="form-group"><label for="'.$id.'">'.$label.'</label>
<textarea name="' . $name . '" placeholder = "' . $placeholder . '" rows="' . $rows . '" class="form-control" id ="'.$id.'">';
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
            $radio .= '>' . $text[$i - 1] . '</label></div>';//-1 тк переборначали с 1 а не с 0
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
//    public function makeSelect($name, $val, $opt1 = '')
//    {
//        $select = '<select name="' . $name . '"><option>' . $opt1 . '</option>';
//        while ($res = mysqli_fetch_assoc($val)) {
//            $select .= '<option  value="' . $res['category_id'] . '">' . $res['category_name'] . '</option>';
//        }
//        $select .= '</select><br>';
//        return $select;
//
//    }

//    public function make_select($select_name, $q_option, $option_name)
//    {
//        $field = '<select name ="' . $select_name . '">';
//
//        for ($i = 0; $i < $q_option; $i++) {
//
//            $field .= '<option value="' . $i . '">';
//
//            $field .= $option_name[$i];
//
//            $field .= '</option>';
//        }
//
//        $field .= '</select>';
//        return $field;
//    }

}

class Valid2
{
    //валидация поля формы на пустоту и длину
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
                return 'Вы не заполнили поле!';
            } else {
                $length = mb_strlen($name);
                if ($email) {
                    if (!filter_var($name, FILTER_VALIDATE_EMAIL)) {
                        return 'Введите правильно email!';
                    }
                } else {
                    if ($length < 2) {
                        return ' Введите не менее 2-х символов!';

                    } elseif ($length > 120) {
                        return 'Не более 120 символов!';
                    }
                }
            }
        } else {//только на пустоту
            if (empty($name)) {
                return 'Отметьте нужный вариант!';
            }
        }
    }
    //проверка имени формы на уникальность
    public function sameForm($str, $obj){
        $str = trim($str);
        $res = $obj->myQuery("
            SELECT `id`
            FROM `forms`
            WHERE `form_name` = '".$str."'
            LIMIT 1
        ");
        if(mysqli_num_rows($res)){
            return 'Ошибка! Такая запись уже существует в БД';
        }

    }
}
class DB{
    private $host;
    private $user;
    private $password;
    private $db;
    function __construct($host, $user,$password, $db)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->db = $db;

    }
    private function myConnect(){//приват, т.к. используется только в этом классе
        return mysqli_connect($this->host, $this->user, $this->password, $this->db);
    }
    public function myQuery($sql){//паблик, т. к. используется вне класса в запросах
        return mysqli_query($this->myConnect(), $sql);
    }
   /* public function insertId(){
        return mysqli_insert_id($this->myConnect());
    }
    public function myRes($str){
        return mysqli_real_escape_string($this->myConnect(), $str);
    }*/
}