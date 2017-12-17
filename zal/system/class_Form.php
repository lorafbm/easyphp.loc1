<?php

/*private $host;
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

private function myconnect()
{
    return mysqli_connect($this->host, $this->user, $this->password, $this->db);
}

public function myquery($sql)
{
    return mysqli_query($this->myconnect(), $sql);
}



// запрос в БД
public function q($query, $key = 0)
{
    $connect = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
    $res = mysqli_query($connect, $query);

    if ($res === false) {
        $info = debug_backtrace();
        $error = "QUERY: " . $query . "<br>\n" .
            "error: " . mysqli_error($connect) . "<br>\n" .
            "the error in file:" . $info[0]['file'] . "<br>\n" .
            "on the line: " . $info[0]['line'] . "<br>\n" .
            "date: " . date("Y-m-d H-i-s") . "<br>\n" .
            "=======================================================";

        echo $error;
        exit();
    } else {
        return $res;
    }
}*/


class Form{
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

}
