<?php
$_SESSION['info_news'] = '';
$data['title'] = ' Админ «ABCновости» | Категории - Редактировать';

/*выборка категорий для вывода*/
$sql_c = "SELECT *
         FROM `category`
         ORDER BY `category_id` ASC 
         ";
$res_c = mysqli_query($connect, $sql_c);

while ($row_c = mysqli_fetch_assoc($res_c)) {
    $data['category_info'][] = $row_c;  // формируем массив для передачи
}

/*вывод из базы новости*/
$sql = "SELECT *
        FROM `news`
        WHERE `news_id`=" . (int)$_GET['id'] . "
          LIMIT 1
         ";
$res = mysqli_query($connect, $sql);

while ($row = mysqli_fetch_assoc($res)) {
    $data['news'][] = $row;  // формируем массив для передачи в вывод

}


/*редактирование*/
if (isset($_POST['edit_news'], $_POST['edit_news_name'], $_POST['edit_short_description'],
    $_POST['edit_description'], $_POST['edit_author'], $_POST['category'])) {

    $data['errors'] = array();
    if (empty($_POST['edit_news_name'])) {
        $data['errors']['edit_news_name'] = 'Заполните заголовок новости!';
    }
    if (empty($_POST['edit_short_description'])) {
        $data['errors']['edit_short_description'] = 'Заполните краткое описание новости!';
    }
    if (empty($_POST['edit_description'])) {
        $data['errors']['edit_description'] = 'Заполните описание новости!';
    }
    if (empty($_POST['edit_author'])) {
        $data['errors']['edit_author'] = 'Заполните автора новости!';
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

    if (!count($data['errors'])) {// если нет ошибок вставляем данные в БД"
        $sql2 = "UPDATE `news` SET
          `category_id`        = '" .(int)($_POST['category']) . "',
          `news_name`          = '" . mysqli_real_escape_string($connect,$_POST['edit_news_name']) . "',
          `short_description`  = '" . mysqli_real_escape_string($connect,$_POST['edit_short_description']) . "',
          `description`        = '" . mysqli_real_escape_string($connect,$_POST['edit_description']) . "',
          `author`             = '" . mysqli_real_escape_string($connect,$_POST['edit_author']) . "',
           " . ((isset($img)) ? "`news_img` = '" . $img . "'," : "") . "
          `date`         = NOW()
              WHERE `news_id`=" . (int)$_GET['id'] . "
        ";
        $res2 = mysqli_query($connect, $sql2);

        $_SESSION['info_news'] = 'Новость успешно отредактирована!';
        header("Location: /index.php?route=admin&page=a_news");
        exit();
    }
}

if (isset($_POST['edit_news'], $_POST['edit_news_name'], $_POST['edit_short_description'],
    $_POST['edit_description'], $_POST['edit_author']/*, $_POST['category']*/)) {

    // $key['category_name'] = $_POST['category'];
    $key['news_name'] = $_POST['edit_news_name'];
    $key['short_description'] = $_POST['edit_short_description'];
    $key['description'] = $_POST['edit_description'];
    $key['author'] = $_POST['edit_author'];
}


getHeader_a($data);
getView_a('edit_news', $data);
//wtf($data, 1);
//wtf($_POST,1);
getFooter_a();