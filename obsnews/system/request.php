<?php
function getView($name, $data = '')
{
    return require_once $_SERVER['DOCUMENT_ROOT'] . "/views/" . $name . ".php";
}

function getHeader()
{
    return require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/header.php";
}

function getFooter()
{
    return require_once $_SERVER['DOCUMENT_ROOT'] . "/controllers/footer.php";
}

function getView_a($name, $data = '')
{
    return require_once $_SERVER['DOCUMENT_ROOT'] . "/admin/views/" . $name . ".php";
}

function getHeader_a()
{
    return require_once $_SERVER['DOCUMENT_ROOT'] . "/admin/controllers/a_header.php";
}

function getFooter_a()
{
    return require_once $_SERVER['DOCUMENT_ROOT'] . "/admin/controllers/a_footer.php";
}


function mylink($name, $category_id)
{
    return '/index.php?route=' . $name . '&' . $name . '_id=' . $category_id;

}

function mylink_page($name, $id)
{
    return '/index.php?route=' . $name . '&' . $name . '_id=' . $id;

}


/*function mylink($name, $category_name)
{
    return '/index.php?route=' . $name . '&' . $name . '_name=' . $category_name;

}*/

function mylink_a($id)
{
    return '/index.php?route=admin&page=' . $id;

}


/*загрузка изображений*/
function can_upload($file)
{
    $can_upload = array();

    if ($file['name'] == '') {
        $error = 'Вы не выбрали файл.';
    }
    if ($file['size'] == 0) {// если размер файла 0, значит его не пропустили настройки сервера из-за того, что он слишком большой
        $error = 'Файл слишком большой.';
    }
    // разбиваем имя файла по точке и получаем массив
    $getExt = explode('.', $file['name']);
    // end возвращает значение последнего элемента или FALSE для пустого массива.
    $ext = strtolower(end($getExt));

    $types = array('jpg', 'png', 'gif', 'jpeg'); //массив допустимых расширений файлов длязанрузки

    if (!in_array($ext, $types)) {
        $error = 'Недопустимый тип файла, можно загружать только файлы с расширениями jpg, png, gif, jpeg!';
    }

    if (!isset($error)) { // формируем имя и записывем исходник в папку /uploaded
        $name = date('Ymd-His') . 'img' . rand(10000, 99999) . '.' . $ext;
        $url_name = './uploaded/' . $name;
        move_uploaded_file($file['tmp_name'], $url_name);
        $can_upload['file'] = $url_name;
        return $can_upload;
    } else {
        $can_upload['errors'] = $error;
        return $can_upload;
    }
}

/*ресайз изображения и сохраняем измененный файл в /photo*/
function resize($image, $width, $height)
{
    $infoimg = getimagesize($image);

    $getExt = explode('/', $infoimg['mime']);
    $ext = strtolower(end($getExt));

    $w_i = $infoimg[0];//исх ширина
    $h_i = $infoimg[1];//исх высота
    /*echo $w_i . 'это $w_i ширина<br>' . $h_i . 'это $h_i высота<br>';*/

    $types = array("gif", "jpeg", "png"); // Массив с допустимыми типами изображений
    if (!in_array($ext, $types)) {
        return 'Недопустимый формат файла.';
    } else {
        $func = 'imagecreatefrom' . $ext; // Получаем название функции, соответствующую типу, для создания изображения
        $img_i = $func($image); // Создаём шаблон для работы с исходным изображением
    }

    // Вычисление пропорций

    $ratio = $w_i / $h_i;

    if ($width / $height > $ratio) {
        $w = round($height * $ratio);
        $h = $height;
    } else {
        $h = round($width / $ratio);
        $w = $width;
    }

    $img = imagecreatetruecolor($w, $h); //Создаем полноцветное изображение

    if ($ext == 'png') {
        imagealphablending($img, false);//Отключаем режим сопряжения цветов
        imagesavealpha($img, true);//Включаем сохранение альфа канала
    } elseif ($ext == 'gif') {
        $transparent_source_index = imagecolortransparent($img_i);//Задаем прозрачный цвет
        if ($transparent_source_index !== -1) {//Проверяем наличие прозрачности
            $transparent_color = imagecolorsforindex($img_i, $transparent_source_index);
            //Добавляем цвет в палитру нового изображения, и устанавливаем его как прозрачный
            $transparent_destination_index = imagecolorallocate($img, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
            imagecolortransparent($img, $transparent_destination_index);
            imagefill($img, 0, 0, $transparent_destination_index);//На всякий случай заливаем фон этим цветом
        }
    }
    imagecopyresampled($img, $img_i, 0, 0, 0, 0, $w, $h, $w_i, $h_i); // Переносим изображение из исходного в выходное, масштабируя его Ресайз

    $name = '/photo/' . $w . 'x' . $h . 'img' . rand(10000, 99999) . '.' . $ext;

    if ($infoimg['mime'] == 'image/jpeg') {
        imagejpeg($img, '.' . $name, 100);
    } elseif ($infoimg['mime'] == 'image/png') {
        imagepng($img, '.' . $name);
    } elseif ($infoimg['mime'] == 'image/gif') {
        imagegif($img, '.' . $name);
    }
    imagedestroy($img);
    imagedestroy($img_i);
    return $name;
}


// запрос в БД
function q($query, $key = 0)
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
}

function wtf($array, $stop = false)
{
    echo '<pre>' . htmlspecialchars(print_r($array, 1)) . '</pre>';
    if (!$stop) {
        exit();
    }
}

function trimAll($el)
{ // обработка на удаление пробелов
    if (!is_array($el)) {
        $el = trim($el);
    } else {
        $el = array_map('trimAll', $el);
    }
    return $el;
}


function paginator($page, $count_pages, $url, $url_page)
{


    if ($page != 1) {
        $p1 = '<a class="pag" href = "' . htmlspecialchars($url) . '" title = "Первая страница" >&lt;&lt;&lt;</a>';

        if ($page == 2) {
            $p2 = '<a class="pag" href = "' . htmlspecialchars($url) . '"title = "Предыдущая страница" >&lt;</a>';
        } else {
            $p2 = '<a class="pag" href = "' . htmlspecialchars($url_page) . (int)($page - 1) . '"title = "Предыдущая страница">&lt;</a>';
        }

    } else {
        $p1 = "";
        $p2 = "";
    }

    if ($page - 2 > 0) {
        $page2left = ' <a class ="pag" href=' . htmlspecialchars($url_page) . (int)($page - 2) . '>' . ($page - 2) . '</a>  ';

    } else {
        $page2left = "";
    }
    if ($page - 1 > 0) {
        $page1left = '<a class="pag" href=' . htmlspecialchars($url_page) . (int)($page - 1) . '>' . ($page - 1) . '</a> ';

    } else {
        $page1left = "";
    }
    if ($page + 2 <= $count_pages) {
        $page2right = '  <a class="pag" href=' . htmlspecialchars($url_page) . (int)($page + 2) . '>' . ($page + 2) . '</a>';
    } else {
        $page2right = "";
    }
    if ($page + 1 <= $count_pages) {
        $page1right = '  <a class="pag" href=' . htmlspecialchars($url_page) . (int)($page + 1) . '>' . ($page + 1) . '</a>';
    } else {
        $page1right = "";
    }
    if ($page != $count_pages) {
        $p3 = '<a class="pag" href="' . htmlspecialchars($url_page) . (int)($page + 1) . '" title="Следующая страница">&gt;</a>
                    <a class="pag" href="' . htmlspecialchars($url_page) . (int)$count_pages . '" title="Последняя страница">&gt;&gt;&gt;</a>';
    } else {
        $p3 = "";
    }

    $paginator = '<div class="paginator">' . $p1 . $p2 . $page2left . $page1left . '<a class="pagact" href=' . $url_page . $page . '>' . $page . '</a>' . $page1right . $page2right . $p3 . '</div><div class="clear"></div>';

    return $paginator;
}


function MyHash($var)
{
    $salt = 'ABC';
    $salt2 = 'CBA';
    $var = crypt(md5($var . $salt), $salt2);
    return $var;

}