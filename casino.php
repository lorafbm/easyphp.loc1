<?php
session_start();
error_reporting(-1);

function wtf($array, $stop = false)
{
    echo '<pre>' . htmlspecialchars(print_r($array, 1)) . '</pre>';
    if (!$stop) {
        exit();
    }
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


Class valid_Data
{
    public function valid_Num($num) // валидация загаданного числа
    {
        $num = trim($num);
        if (!empty($num)) {
            if (is_numeric($num)) {
                if ($num < 1) {
                    return 'Число не может быть меньше 1!';
                } elseif ($num > 100) {
                    return 'Число не может быть больше 100!';
                }

            } else {
                return 'Введите число!';
            }

        } else {
            return 'Заполните поле!';
        }
    }

    public function valid_Stavka($stavka) //валидация ставки
    {
        $stavka = trim($stavka);
        if (!empty($stavka)) {

            if (is_numeric($stavka)) {
                if ($stavka < 100) {
                    return 'Ставка не может быть меньше 100!';
                } elseif ($stavka > 1000) {
                    return 'Ставка не может быть больше 1000!';
                }
            } else {
                return 'Введите целое число!';
            }

        } else {
            return 'Заполните поле!';
        }
    }
}

Class Casino
{
   //  public $money_casino;
    //  public $num_casino;
    //   public $stavka_casino;

     /*  function __construct($money_casino)
       {
           $this->money_casino = $money_casino;
       }*/

    public function count_result_casino($result, $num)// принимает текущий счет и результат хода игрока
    {
        $result -= $num;
        return $result;
    }
}


Class igrok
{
    // public $money_igrok;
    //public $num_igrok;
    // public $stavka_igrok;

    /*  function __construct($money_igrok/*, $num_igrok, $stavka_igrok)
      {
          $this->money_igrok = $money_igrok;
          $this->num_igrok = $num_igrok;
          $this->stavka_igrok = $stavka_igrok;
      }*/

    public function count_result($num, $stavka)
    { // принимает загаданное число оппонента
        $delta = abs($num - $stavka);
        if ($delta <= 10) {
            $result = $stavka * 2;
        } elseif ($delta > 10 && $delta <= 20) {
            $result = $stavka;
        } else {
            $result = -$stavka;
        }
        return $result; // возвращает + - рез-т хода
    }

    public function count_result_igrok($result, $num) // принимает тек счет и результат хода игрока
    {
        $result += $num;
        return $result;
    }

    public function stop_game()
    {
        unset($num_casino);
        unset($result_igrok);
        unset($_POST);
    }
}


$a = new Form; // создала форму
if (!isset ($_SESSION['igrok']) && !isset ($_SESSION['casino'])) {
    $_SESSION['igrok'] = 0;
    $_SESSION['casino'] = 0;
}
if (!empty($_POST['submit'])) { //если игра началась
    /*создали объекты*/
    $b = new valid_Data;
    $c = new Casino();
    $d = new igrok();
    /*валидация формы*/
    $a->error = array();
    $a->error['num'] = $b->valid_Num($_POST['num']);
    $a->error['stavka'] = $b->valid_Stavka($_POST['stavka']);
    if (empty($a->error['num']) && empty($a->error['stavka'])) { // если нет ошибок по полям
        $num_casino = rand(1, 100);//казино загадало число
        $result_igrok = $d->count_result($num_casino, $_POST['stavka']); // рез-т хода игрока
        $_SESSION['igrok'] = $d->count_result_igrok($_SESSION['igrok'], $result_igrok);//обновила счет игрока
        if ($_SESSION['igrok'] <= 0) {
            $d->stop_game();
        }
        $_SESSION['casino'] = $c->count_result_casino($_SESSION['casino'], $result_igrok); //обновла счет казино
        if ($_SESSION['casino'] <= 0) {
            $d->stop_game();
        }
    }
} else {
    $_SESSION['casino'] = 10000;
    $_SESSION['igrok'] = 10000;
}
//wtf($_POST, 1);
//wtf($_SESSION, 1);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Игра в казино</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
              integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<!--    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.css">-->
    <style>
        main {
            padding: 50px 100px;
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
<main><?php
    echo '<h5>Счет игрока: ' . $_SESSION['igrok'] . '$</h5>';
    echo '<h5>Счет казино: ' . $_SESSION['casino'] . '$</h5>';
    if (!empty($_POST['submit'])) {
        echo ((isset($_POST['num'])) && !$a->error['num']) ? '<h5>Вы загадали число: ' . $_POST['num'] . '</h5>' : '';
        echo ((isset($_POST['stavka'])) && !$a->error['stavka']) ? '<h5>Ваша ставка: ' . $_POST['stavka'] . '$</h5>' : '';
        echo (isset($num_casino)) ? '<h5>Казино загадало число: ' . $num_casino . '</h5>' : '';
        echo (isset($result_igrok)) ? '<h5>Результат хода игрока: ' . $result_igrok . '$</h5>' : '';
    } else {
        if ($_SESSION['igrok'] > $_SESSION['casino']) {
            echo '<h2>Казино проиграло! Начните новую игру!</h2>';
            echo ' <h2><a href="/casino.php">Новая игра</a></h2>';
        } elseif ($_SESSION['igrok'] < $_SESSION['casino']) {
            echo '<h2>Игрок, вы проиграли! Начните новую игру!</h2>';
            echo ' <h2><a href="/casino.php">Новая игра</a></h2>';
        }
    }
    echo $a->startForm('post');
    echo $a->makeText('num', 'text', 'Введите число от 1 до 100', 'Число');
    echo $a->makeText('stavka', 'text', 'Введите ставку от 100 до 1000', 'Ставка');
    echo $a->endForm('submit', 'Играть!');
    ?>
</main>
</body>
</html>

