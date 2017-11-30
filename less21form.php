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

//$connect = mysqli_connect('localhost', 'root', '', 'project1');
//$res1 = mysqli_query($connect,"SELECT `category_id`, `category_name` FROM `category`");//while
//$res = array(0 => array('id' => 48, 'name' => 'coffee'), 1 => array('id' => 53, 'name' => 'tea'), 2 => array('id' => 77, 'name' => 'juice'));//while
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
    foreach ($_POST as $key => $value) {
        if ($key == 'email') {
            if (!$a->error[$key] = $b->val_Field($_POST[$key], 1)) {
                $a->mem[$key] = trim($value);
            }
        } else {
            if (!$a->error[$key] = $b->val_Field($_POST[$key])) {
                $a->mem[$key] = trim($value);
            }
        }
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
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>LESSON 21</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
          integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <!--    <link rel="stylesheet" href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css">-->
    <!--    <link rel="stylesheet" href="/less21.css">-->
    <style>main {
            padding: 50px 0;
        }

        form {
            width: 40%;
            margin: 0 auto;
        }

        p {
            color: red;
        }
    </style>
</head>
<body>
<main>
    <?php
    echo $a->startForm('post');
    //например, нужно несколько полей одного типа
    $names = array('name', 'surname', 'address');
    $placeholders = array('Your name', 'Your surname', 'Your address');
    for ($i = 0;
    $i < count($names);
    $i++){
    echo $a->makeText($names[$i], $placeholders[$i]);
    }
    // илитолько одно поле определенного типа
    echo $a->makeText('login', 'login');
    echo $a->makePass('pass', 'password');
    echo $a->makeEmail('email', 'e-mail');
    echo $a->make_textarea('textarea', 'print some text', 7);
    echo $a->makeRadio('pol', $pol);
    echo $a->makeCheckbox('check', $check);
    //echo $a->make_select('select', 3, ['one', 'two', 'three']);
    echo $a->makeSelect('select', $res, $opt1);
    //echo $a->makeSelect('select', $res1, 'Выберите категорию новостей');
    echo $a->endForm('submit', 'send');
    ?>
</main>
</body>
</html>
