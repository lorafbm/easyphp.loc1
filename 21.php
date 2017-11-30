<?php
class Form1
{
    public $error = array();
    public $mem = array();

    public function type($type){
        return $type;
    }

    public function makeInput($name, $placeholder, $type){
        $text = '';
        for($i = 0; $i < count($type); $i++){
            $text .= '<div class="form-group"><input type="'.$type[$i].'" name="' . $name[$i] . '" placeholder="' . $placeholder[$i] . '" class="form-control"';
            if (!empty($this->mem[$name[$i]])) {
                $text .= ' value="' . $this->mem[$name[$i]] . '"';
            }
            $text .= '></div>';
            if (!empty($this->error[$name[$i]])) {
                $text .= '<p>' . $this->error[$name[$i]] . '</p>';
            }

        }
        return $text;
    }

    public function startForm($method, $name = '', $action = '')
    {
        return '<form action="' . $action . '" method="' . $method . '" name="' . $name . '">
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
            $text .= ' value="' . $this->mem[$name] . '"';
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
            $pass .= ' value="' . $this->mem[$name] . '"';
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
        $name = trim($name);
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

$res = array(48 => 'coffee', 53 => 'tea', 77 => 'juice');// foreach
$opt1 = 'Выберите напиток';
$check = array(12 => 'winter', 13 => 'spring', 14 => 'summer', 15 => 'autumn');
$pol = array('мужчина', 'женщина');

//создаем форму
$a = new Form1;

//валидируем форму
if (isset($_POST['submit'])) {
    $b = new Valid1;
    $a->error = array();
    $a->mem = array();
    if (!$a->error['login'] = $b->val_Field($_POST['login'])) {
        $a->mem['login'] = trim($_POST['login']);
    }
    if (!$a->error['pass'] = $b->val_Field($_POST['pass'])) {
        $a->mem['pass'] = trim($_POST['pass']);
    }
    if (!$a->error['email'] = $b->val_Field($_POST['email'], 1)) {
        $a->mem['email'] = trim($_POST['email']);
    }
    if (!$a->error['textarea'] = $b->val_Field($_POST['textarea'])) {
        $a->mem['textarea'] = trim($_POST['textarea']);
    }
    if (!isset($_POST['check'])) {
        $a->error['check'] = $b->val_Field($_POST['check']);
    } else {
        foreach ($_POST['check'] as $k => $v) {
            $a->mem['check'][$k] = $v;
        }
    }
    if (!isset($_POST['pol'])) {
        $a->error['pol'] = $b->val_Field($_POST['pol']);
    } else {
        $a->mem['pol'] = $_POST['pol'];
    }
    if (!isset($_POST['select'])) {
        $a->error['select'] = $b->val_Field($_POST['select']);
    } else {
        $a->mem['select'] = $_POST['select'];
    }

    if (!$a->error['login1'] = $b->val_Field($_POST['login1'])) {
        $a->mem['login1'] = trim($_POST['login1']);
    }
    if (!$a->error['pass1'] = $b->val_Field($_POST['pass1'])) {
        $a->mem['pass1'] = trim($_POST['pass1']);
    }
    if (!$a->error['email1'] = $b->val_Field($_POST['email1'], 1)) {
        $a->mem['email1'] = trim($_POST['email1']);
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>LESSON 21</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <style>main{padding: 50px 0;}
           form{width: 40%; margin: 0 auto;}
           p{color: red;}
    </style>
</head>
<body>
<main>
    <?php
    echo $a->startForm('post', 'form[]');
    $t = array('text', 'password', 'email');
    $type= $a->type($t);
    $in = array('login1','pass1','email1');
    $p = array('login', 'password', 'e-mail');
    echo $a->makeInput($in, $p, $type);
    echo $a->endForm('submit', 'send');
    ?>
</main>
</body>
</html>