<?php

$_SESSION['info_news'] = '';

$data['title'] = ' Админ «ОБСновости» | Категории - Добавить';

/*выборка категорий для вывода списка категорий*/
$sql_c = "SELECT *
           FROM `category`
          ORDER BY `category_id` ASC 
          ";
$res_c = mysqli_query($connect, $sql_c);

while ($row_c = mysqli_fetch_assoc($res_c)) {
    $data['category_info'][] = $row_c;  // формируем массив для передачи

}


/*валидация на пустоту всех полей кроме изображения*/
if (isset($_POST['add_news'], $_POST['add_news_name'], $_POST['add_short_description'],
    $_POST['add_description'], $_POST['add_author'], $_POST['category'])) {

    $data['errors'] = array();
    if (empty($_POST['add_news_name'])) {
        $data['errors']['add_news_name'] = 'Заполните заголовок новости!';
    }
    if (empty($_POST['add_short_description'])) {
        $data['errors']['add_short_description'] = 'Заполните краткое описание новости!';
    }
    if (empty($_POST['add_description'])) {
        $data['errors']['add_description'] = 'Заполните описание новости!';
    }
    if (empty($_POST['add_author'])) {
        $data['errors']['add_author'] = 'Заполните автора новости!';
    }
    /*загружаем фото*/

    if (isset($_FILES['file'])) {

        if (!empty($_FILES['file']['tmp_name'])) {
            // проверяем, можно ли загружать изображение
            $info = can_upload($_FILES['file']);

            if (isset($info['file'])) { // если не вернулось $info['errors'] то ресайз
                $img = resize($info['file'], 200, 300);

            } else { // если вернулось $info['errors'] то передаем ошибку на вывод в вид
                $data['errors']['file'] = $info['errors'];
            }

        } /*else { // нельзя загрузить новость без фото
               $data['errors']['file'] = 'Загрузите фото!';
           }*/
    }
    foreach ($_POST as $k => $v) {
        $_POST[$k] = trimAll($v);
    }
    if (!count($data['errors'])) {// если нет ошибок вставляем данные в БД

        $sql = q("
          INSERT INTO `news` SET
          `category_id`        = '" .(int) $_POST['category'] . "',
          `news_name`          = '" . mysqli_real_escape_string($connect,$_POST['add_news_name']) . "',
          `short_description`  = '" . mysqli_real_escape_string($connect,$_POST['add_short_description']) . "',
          `description`        = '" . mysqli_real_escape_string($connect,$_POST['add_description']) . "',
          `author`             = '" . mysqli_real_escape_string($connect,$_POST['add_author']) . "',
           " . ((isset($img)) ? "`news_img` = '" . $img . "'," : "") . "
          `date`         = NOW()
         ");
        // $res = mysqli_query($connect, $sql);
        $_SESSION['info_news'] = 'Новость успешно добавлена!';;
        header("Location: /index.php?route=admin&page=a_news");
        exit();

    }
}

getHeader_a($data);
getView_a('add_news', $data);
getFooter_a();
wtf($_POST, 1);
wtf($data, 1);
//wtf($_SESSION,1);
