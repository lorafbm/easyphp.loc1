<?php
/*выборка инфы о странице для вывода*/
$sql = "SELECT *
        FROM `pages`
          WHERE `id`=" . (int)$_GET['id'] . "
         ";
$res = mysqli_query($connect, $sql);

while ($row = mysqli_fetch_assoc($res)) {
    $data['info'] = $row;  // формируем массив для передачи
}
/*редактирование*/
if (isset($_POST['title'], $_POST['text'], $_POST['name'])) {

    $data['errors'] = array();
    if (empty($_POST['title'])) {
        $data['errors']['title'] = 'Заполните заголовок!';
    }
    if (empty($_POST['text'])) {
        $data['errors']['text'] = 'Заполните текст!';
    }
    if (empty($_POST['name'])) {
        $data['errors']['name'] = 'Заполните название страницы!';
    }

    /*загружаем 1 фото*/
    if (isset($_FILES['file1'])) {

        if (!empty($_FILES['file1']['tmp_name'])) {
            // проверяем, можно ли загружать изображение
            $info1 = can_upload($_FILES['file1']);

            if (!empty($info1['file'])) { // если не вернулось $info['errors'] то ресайз
                $img1 = resize($info1['file'], 900, 700);

            } else { // если вернулось $info['errors'] то передаем ошибку на вывод в вид
                $data['errors']['file'] = $info1['errors'];
            }

        } /*else { // нельзя загрузить новость без фото
               $data['errors']['file'] = 'Загрузите фото!';
           }*/
    }
    /*загружаем 2 фото*/
    if (isset($_FILES['file2'])) {

        if (!empty($_FILES['file2']['tmp_name'])) {
            // проверяем, можно ли загружать изображение
            $info2 = can_upload($_FILES['file2']);

            if (!empty($info2['file'])) { // если не вернулось $info['errors'] то ресайз
                $img2 = resize($info2['file'], 900, 700);


            } else { // если вернулось $info['errors'] то передаем ошибку на вывод в вид
                $data['errors']['file'] = $info2['errors'];
            }

        } /*else { // нельзя загрузить новость без фото
               $data['errors']['file'] = 'Загрузите фото!';
           }*/
    }
    /*загружаем 3 фото*/
    if (isset($_FILES['file3'])) {

        if (!empty($_FILES['file3']['tmp_name'])) {
            // проверяем, можно ли загружать изображение
            $info3 = can_upload($_FILES['file3']);

            if (!empty($info3['file'])) { // если не вернулось $info['errors'] то ресайз
                $img3 = resize($info3['file'], 900, 700);
            } else { // если вернулось $info['errors'] то передаем ошибку на вывод в вид
                $data['errors']['file '] = $info3['errors'];
            }

        } /*else { // нельзя загрузить новость без фото
               $data['errors']['file'] = 'Загрузите фото!';
           }*/
    }

    if (!count($data['errors'])) {// если нет ошибок вставляем данные в БД"
        foreach ($_POST as $k => $v) {

            $_POST[$k] = trim($v);
        }
        $sql1 = "UPDATE `pages` SET
                 `name`  = '" . $_POST['name'] . "',
                 `title` = '" . $_POST['title'] . "',
                 `text`  = '" . $_POST['text'] . "'
                  " . ((isset($img1)) ? ",`img1` = '" . $img1 . "'" : "") . "
                  " . ((isset($img2)) ? ",`img2` = '" . $img2 . "'" : "") . "
                  " . ((isset($img3)) ? ",`img3` = '" . $img3 . "'" : "") . "
                    WHERE `id`  =  " . (int)$_GET['id'] . "
                  ";
        $res = mysqli_query($connect, $sql1);
        $_SESSION['info_page'] = 'Отредактировано!';
        header("Location: /index.php?route=admin&page=a_pages");
        exit();
    }
}
if (isset($_POST['title'], $_POST['text'], $_POST['name'])) {
    $data['info']['title'] = $_POST['title'];
    $data['info']['text'] = $_POST['text'];
    $data['info']['name'] = $_POST['name'];
}
//wtf($_POST,1);
//wtf($_FILES,1);
//wtf($data,1);
getView_a('edit_page', $data);
