<?php
/*вывод*/
$sql = "SELECT *
        FROM `aboutus`
       ";
$res = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($res);
$data['info'] = $row;

/*редактирование*/
if (isset($_POST['title'], $_POST['text'], $_POST['address'],
    $_POST['phone'], $_POST['email'])) {

    $data['errors'] = array();
    if (empty($_POST['title'])) {
        $data['errors']['title'] = 'Заполните заголовок!';
    }
    if (empty($_POST['text'])) {
        $data['errors']['text'] = 'Заполните текст!';
    }
    if (empty($_POST['address'])) {
        $data['errors']['address'] = 'Заполните адрес!';
    }
    if (empty($_POST['phone'])) {
        $data['errors']['phone'] = 'Заполните телефон!';
    }
    if (empty($_POST['email'])) {
        $data['errors']['email'] = 'Заполните email!';
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $data['errors']['email'] = 'Неправильно введен email!';
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
    foreach ($_POST as $k => $v) {
        $_POST[$k] = trimAll($v);
    }

    if (!count($data['errors'])) {// если нет ошибок вставляем данные в БД"
        $sql = "UPDATE `aboutus` SET
          `title`         = '" . mysqli_real_escape_string($connect,$_POST['title']) . "',
          `text`          = '" . mysqli_real_escape_string($connect, $_POST['text']) . "',
          `address`       = '" . mysqli_real_escape_string($connect, $_POST['address']) . "',
          `phone`         = '" . mysqli_real_escape_string($connect, $_POST['phone']) . "',
          `email`         = '" . mysqli_real_escape_string($connect, $_POST['email']) . "'
           " . ((isset($img1)) ? ",`img1` = '" . $img1 . "'" : "") . "
           " . ((isset($img2)) ? ",`img2` = '" . $img2 . "'" : "") . "
           " . ((isset($img3)) ? ",`img3` = '" . $img3 . "'" : "") . "
           ";
         $res = mysqli_query($connect, $sql);

        $_SESSION['info_aboutus'] = 'Отредактировано!';
        header("Location: /index.php?route=admin&page=a_aboutus");
        exit();
    }
}

if (isset($_POST['title'], $_POST['text'], $_POST['address'], $_POST['phone'], $_POST['email'])) {
    $data['info']['title'] = $_POST['title'];
    $data['info']['text'] = $_POST['text'];
    $data['info']['address'] = $_POST['address'];
    $data['info']['phone'] = $_POST['phone'];
    $data['info']['email'] = $_POST['email'];
}


$data['title'] = ' Админ «ОБСновости» | О нас - Редактировать';
getHeader_a($data);
//wtf($_POST,1);
//wtf($_FILES,1);
//wtf($data,1);
getView_a('edit_aboutus', $data);
getFooter_a();