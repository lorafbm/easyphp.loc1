<?php
session_start();
function wtf($array, $stop = false)
{
    echo '<pre>' . htmlspecialchars(print_r($array, 1)) . '</pre>';
    if (!$stop) {
        exit();
    }
}

define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DATABASE', 'easyphp');
$connect = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
mysqli_query($connect, "SET CHARSET UTF8");
/*вставка в тбл городов*/

/*$list = array(Харьков,
    Киев,
    Луганск,
    Черновцы,
    Мукачево,
    Севастополь,
    Одесса,
    Ужгород,
    Винница,
    Славутич,
    Днепропетровск,
    Симферополь,
    Южный,
    Львов,
    Хмельницкий,
    Тернополь,
    Донецк,
    Ровно,
    Запорожье);

foreach ($list as $key=>$v){
    //вставляем данные в БД
    $sql = "INSERT INTO `city` SET
                      `city`        = '" . $v . "'
           ";
    $query = mysqli_query($connect, $sql);
}*/

Class Valid
{
    /*валидация полученного ответа*/
    public function get_letter($name, $array)
    {
        if (!empty($name)) { // если пришли данные из формы приводим к ниж регистру
            $name = mb_strtolower($name);
            if (in_array($name, $array)) { // если есть такой город

                $dlinna = mb_strlen($name, "utf8");
                $last = mb_substr($name, $dlinna - 1, 1, "utf8"); // получили последнюю букву

                $forbidden_letters = array('ь', 'й', 'ъ', 'ы'); // массив запрещенных окончаний
                if (in_array($last, $forbidden_letters)) { // если посл буква не подходит
                    $pre_last = mb_substr($name, $dlinna - 2, 1, "utf8");
                    return $pre_last; // берем предпоследнюю
                } else {
                    return $last; // иначе берем последнюю
                }
            } else {
                return false;
            }
        }
    }

    public function del_city($name, $array)
    {
        $name = mb_strtolower($name);
        foreach ($array as $k => $v) {
            if ($array[$k] == $name) {
                unset($array[$k]);
                return $array;
            }
        }
    }
}

Class Computer
{
    //на полученную букву ищем слово и удаляем его
    public function step_valid($letter, $array)
    {
        if (count($array)) {
            foreach ($array as $k => $v) {
                if (mb_substr($array[$k], 0, 1, 'UTF-8') == $letter) {
                    return $array[$k];
                    break;
                }
            }
        } else {
            return false;
        }
    }
}


if (!isset($_SESSION['start'])) {
    /*1. записали в сессию все города - начальный этап и привели их к ниж регистру сразу*/
    $sql = "SELECT `city`
        FROM `city`
        ORDER BY `id` ASC
        ";
    $res = mysqli_query($connect, $sql);

    while ($row = mysqli_fetch_assoc($res)) {
        $_SESSION['list'][] = trim(mb_strtolower($row['city']));
    }
}
$_SESSION['start'] = 1; // теперь  начали игру
// 2. Если пришел ПОСТ то идем на валидацию и получаем последнюю букву от которой пляшем и удаляем выбранное
if (isset($_POST['text']) && !empty($_POST['text'])) {
    // 3. Создала экземпляр класса
    $val = new Valid;
    $_SESSION['info'] = 'Вы выбрали: ' . $_POST['text'] . '<br>';
    $_SESSION['result'] = $val->get_letter($_POST['text'], $_SESSION['list']); // получили букву

    if ($_SESSION['result']) {
        $_SESSION['info1'] = 'Нужен вариант на букву: ' . $_SESSION['result'] . '<br>';
        $_SESSION['list'] = $val->del_city($_POST['text'], $_SESSION['list']); //удаляем выбранный вариант

        //4. имитируем ход компа
        $Comp = new Computer;
        $_SESSION['step'] = $Comp->step_valid($_SESSION['result'], $_SESSION['list']);
        if ($_SESSION['step']) {
            $_SESSION['info2'] = 'Компьютер выбрал город: ' . $_SESSION['step'] . '<br>';
            $_SESSION['list'] = $val->del_city($_SESSION['step'], $_SESSION['list']); //удаляем выбранный вариант
        } else {
            echo 'Нет варианов! Компьютер проиграл!';
            session_unset();
        }
    } else {
        echo 'Нет такого города! Вы проиграли!';
        session_unset();
    }
} else {
    $error = 'Выберите и введите город!';
}

//wtf($_SESSION, 1);
//var_dump($_POST);

?>


<link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.min.css">

<div class="clearfix" style="margin: 20px;">
    <?php echo $_SESSION['info'] ? $_SESSION['info'] : '';
    echo $_SESSION['info1'] ? $_SESSION['info1'] : '';
    echo $_SESSION['info2'] ? $_SESSION['info2'] : ''; ?>
    <div style="border: 1px solid cornflowerblue; width: 300px; float: left; padding: 20px;">
        <h4>Варианты для выбора:</h4>
        <?php if (isset ($_SESSION['start'])) {
            sort($_SESSION['list']);
            foreach ($_SESSION['list'] as $k => $v) {
                echo $v . '<br>';
            }
        }
        ?></div>
    <form action="" method="post" style="width: 300px; margin: 20px; float: left">
        <p><?php if (!empty($error)) {
                echo $error;
            } ?></p>
        <div class="form-group">
            <input type=text name="text" value="" placeholder="Введите город!" class="form-control">
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="GO!" class="btn btn-info">
        </div>
    </form>
</div>