<?php

class Form1
{
    public $error = array();
    public $mem = array();

    public function startForm($method, $action = '')
    {
        return '<form action="' . $action . '" method="' . $method . '">
                <div class="alert alert-danger" role="alert">Все поля являются обязательными для заполнения!</div>';
    }

    public function endForm($name, $value)
    {
        return '<input type="submit" name="' . $name . '" value="' . $value . '" class="btn btn-primary"></form>';
    }

    public function makeText($name, $placeholder)
    {
        $text = '<div class="form-group"><input type="text" name="' . $name . '" placeholder="' . $placeholder . '" class="form-control"';
        if (!empty($this->mem[$name])) {
            $text .= ' value="' . htmlspecialchars($this->mem[$name]) . '"';
        }
        $text .= '></div>';
        if (!empty($this->error[$name])) {
            $text .= '<p>' . $this->error[$name] . '</p>';
        }
        return $text;
    }

    public function makePass($name, $placeholder)
    {
        $pass = '<div class="form-group"><input type="password" name="' . $name . '" placeholder="' . $placeholder . '" class="form-control"';
        if (!empty($this->mem[$name])) {
            $pass .= ' value="' . htmlspecialchars($this->mem[$name]) . '"';
        }
        $pass .= '></div>';
        if (!empty($this->error[$name])) {
            $pass .= '<p>' . $this->error[$name] . '</p>';
        }
        return $pass;
    }

    public function makeEmail($name, $placeholder)
    {
        $email = '<div class="form-group"><input type="email" name="' . $name . '" placeholder="' . $placeholder . '" class="form-control"';
        if (!empty($this->mem[$name])) {
            $email .= ' value="' . $this->mem[$name] . '"';
        }
        $email .= '></div>';
        if (!empty($this->error[$name])) {
            $email .= '<p>' . $this->error[$name] . '</p>';
        }
        return $email;
    }

    public function make_textarea($name, $placeholder, $rows = '')
    {
        $textarea = '<div class="form-group"><textarea name="' . $name . '" placeholder = "' . $placeholder . '" rows="' . $rows . '" class="form-control">';
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
            $radio .= '>' . $text[$i - 1] . '</label></div>';
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

class Valid1
{
    public function val_Field($name, $email = false)
    {
        if (is_array($name)) {
            foreach ($name as $item) {
                $name = trim($item);
            }
        } else {
            $name = trim($name);
        }
        if (empty($name)) {
            return 'Вы не заполнили поле  или не отметили нужный вариант!';
        } else {
            $length = mb_strlen($name);
            if ($email) {
                if (!filter_var($name, FILTER_VALIDATE_EMAIL)) {
                    return 'Введите правильно email!';
                }
            } else {
                if ($length < 2) {
                    return ' Введите не менее 2-х символов!';

                } elseif ($length > 16) {
                    return 'Не более 16 символов!';
                }
            }
        }
    }
}

