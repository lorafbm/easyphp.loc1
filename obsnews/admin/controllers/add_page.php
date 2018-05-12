<?php
$_SESSION['info_page'] = '';
$data['errors'] = array();
/*валидация на пустоту всех полей кроме изображения*/
if (isset($_POST['name'], $_POST['title'], $_POST['text'])) {

    if (empty($_POST['name'])) {
        $data['errors']['name'] = 'Заполните название страницы!';
    }
    if (empty($_POST['text'])) {
        $data['errors']['text'] = 'Заполните текст!';
    }
    if (empty($_POST['title'])) {
        $data['errors']['title'] = 'Заполните заголовок!';
    }
    /*загружаем фото*/

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
    if (!count($data['errors'])) {// если нет ошибок вставляем данные в БД
        foreach ($_POST as $k => $v) {
            $_POST[$k] = trimAll($v);
        }

        $sql = "INSERT INTO `pages_zal` SET
                `name`  = '" . $_POST['name'] . "',
                `title` = '" . $_POST['title'] . "',
                `text`  = '" . $_POST['text'] . "'
                 " . ((isset($img1)) ? ",`img1` = '" . $img1 . "'" : "") . "
                 " . ((isset($img2)) ? ",`img2` = '" . $img2 . "'" : "") . "
                 " . ((isset($img3)) ? ",`img3` = '" . $img3 . "'" : "") . "
                 ";
        $res = mysqli_query($connect, $sql);
        $_SESSION['info_news'] = 'Страница успешно добавлена!';;
        header("Location: /index.php?route=admin&page=a_pages");
        exit();
    }
}
getView_a('add_page', $data);
//wtf($_POST, 1);
//wtf($data, 1);
//wtf($_SESSION,1);getFooter_a();