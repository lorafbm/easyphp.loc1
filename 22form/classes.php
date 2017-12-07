<?php

Class Form
{
   // public $fields = array();//массив полей которые мы собираем в форму
    public $error = array();//массив ошибок
    public $mem = array();

  /*  public function CreateForm($method, $value, $name, $action = '')
    {
        $form = ' <form action="' . $action . '" method="' . $method . '" role="form" name = "' . $name . '">';
        if (!empty($this->fields)) {//выводим поля кот насобирали методами

            foreach ($this->fields as $v) {
                $form .= $v;

            }
            $form .= '<input type="submit" name="' . $name . '" value="' . $value . '" class="btn btn-primary"></form>';
            unset ($this->fields); //удаляем поля чтоб они в сл раз не мешались в новой форме
            return $form;

        }
    }*/


    public function startForm($method, $name = '', $action = '')
    {
        return '<form action="' . $action . '" method="' . $method . '" name ="'.$name.'">';
    }

    public function endForm($name, $value)
    {
        return '<input type="submit" name="' . $name . '" value="' . $value . '" class="btn btn-primary"></form>';
    }


    public
    function makeText($name, $placeholder, $type, $label = '')
    {
        $this->fields[$type] = '<div class="form-group">
<label>' . $label . '
<input type="' . $type . '" name="' . $name . '" placeholder="' . $placeholder . '" class="form-control" style="min-width:250px;"></label>';
        $this->fields[$type] .= '</div>';
        if (!empty($this->mem[$name])) {
            $this->fields[$type] .= ' value="' . htmlspecialchars($this->mem[$name]) . '"';
        }
        if (!empty($this->error[$name])) {
            $this->fields[$type] .= '<p>' . $this->error[$name] . '</p>';
        }
        return $this->fields[$type];
    }

    public
    function MakeTextarea($name, $placeholder = '', $label = '', $rows = 5)
    {
        $this->fields['textarea'] = '<div class="form-group"><label>' . $label . '
<textarea name="' . $name . '" placeholder = "' . $placeholder . '" rows="' . $rows . '" class="form-control">';
        $this->fields['textarea'] .= '</textarea></<label></div>';
        if (!empty($this->mem[$name])) {
            $this->fields['textarea'] .= $this->mem[$name];
        }
        $this->fields['textarea'] .= '</textarea></div>';
        if (!empty($this->error[$name])) {
            $this->fields['textarea'] .= '<p>' . $this->error[$name] . '</p>';
        }
        return $this->fields['textarea'];
    }


    public function makeRadio($name, $text)
    {
        $this->fields['radio'] = '';
        for ($i = 1; $i <= count($text); $i++) {
            $this->fields['radio'] .= '<div class="form-check"><label class="form-check-label"><input type="radio" name="' . $name . '" value="' . $i . '" class="form-check-input"';
            if (!empty($this->mem[$name]) && $this->mem[$name] == $i) {
                $this->fields['radio'] .= ' checked';
            }
            $this->fields['radio'] .= '>' . $text[$i - 1] . '</label></div>';//-1 тк переборначали с 1 а не с 0

        }
        if (!empty($this->error[$name])) {
            $this->fields['radio'] .= '<p>' . $this->error[$name] . '</p>';
        }
        return $this->fields['radio'];

    }


    public function makeCheckbox($name, $value)
    {
        $this->fields['checkbox'] = '';
        for ($i = 0; $i < count($value); $i++) {
            $this->fields['checkbox'] .= '<div class="form-check"><label class="form-check-label"><input type="checkbox" name="' . $name . '[]" value="' . $i . '" class="form-check-input">';
            $this->fields['checkbox'] .= $value[$i] . '</label></div>';
            if (!empty($this->mem[$name])) {
                foreach ($this->mem[$name] as $k => $v) {
                    if ($v == $i) {
                        $this->fields['checkbox'] .= ' checked';
                    }
                }
            }
        }
        if (!empty($this->error[$name])) {
            $this->fields['checkbox'] .= '<p>' . $this->error[$name] . '</p>';
        }
        return $this->fields['checkbox'];
    }


    public function makeSelect($name, $val, $opt1 = '')
    {
        $this->fields['select'] = '<div class="form-group"><select name="' . $name . '"><option disabled selected class="form-control">' . $opt1 . '</option>';
        foreach ($val as $key => $item) {
            $this->fields['select'] .= '<option  value="' . $key . '"';
            if (!empty($this->mem[$name]) && $this->mem[$name] == $key) {
                $this->fields['select'] .= ' selected';
            }
            $this->fields['select'] .= '>' . $item . '</option>';
        }
        $this->fields['select'] .= '</select></div>';
        if (!empty($this->error[$name])) {
            $this->fields['select'] .= '<p>' . $this->error[$name] . '</p>';
        }
        return $this->fields['select'];

    }
}

class Valid
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

class DB
{
    private $host;
    private $user;
    private $password;
    private $db;

    function __construct($host, $user, $password, $db)
    {
        $this->host = $host;
        $this->user = $user;
        $this->password = $password;
        $this->db = $db;

    }

    private function myConnect()
    {//приват, т.к. используется только в этом классе
        return mysqli_connect($this->host, $this->user, $this->password, $this->db);
    }

    public function myQuery($sql)
    {//паблик, т. к. используется вне класса в запросах
        return mysqli_query($this->myConnect(), $sql);
    }

    public function insertId()
    {
        return mysqli_insert_id($this->myConnect());
    }
     public function myRes($str){
         return mysqli_real_escape_string($this->myConnect(), $str);
     }
}

?>


