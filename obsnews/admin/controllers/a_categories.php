<?php
/*поиск*/
if (!empty($_POST['name'])) {
    foreach ($_POST as $k => $v) {
        $_POST[$k] = trimAll($v);
    }
    $sql_s = "SELECT *
              FROM `category` 
              WHERE `category_name` LIKE '%" . $_POST['name'] . "%' 
              ORDER BY `category_id` ASC 
              ";
    $res_s = mysqli_query($connect, $sql_s);
    while ($row_s = mysqli_fetch_assoc($res_s)) {
        $data['category_info'][] = $row_s;  // формируем массив для передачи
    }
} else {
    /*выборка категорий для вывода*/
    $sql = "SELECT *
            FROM `category`
            ORDER BY `category_id` ASC 
            ";
    $res = mysqli_query($connect, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
        $data['category_info'][] = $row;  // формируем массив для передачи
    }
}
// удаление группы категорий из БД
if (isset($_POST['delete'])) { // если пришел пост на удаление
    if (isset($_POST['ids'])) {  // если пришел массив чекбоксов
        // wtf($_POST['ids'],1);
        foreach ($_POST['ids'] as $k => $v) { // перебираем
            $_POST['ids'][$k] = (int)$v;
        }
        $ids = implode(',', $_POST['ids']); // разбиваем массив чтобы получить список id категорий которые нужно удалить
        //echo $ids;
        $sql1 = "DELETE FROM `category`
                  WHERE `category_id` IN (" . $ids . ")
                ";
        $query1 = mysqli_query($connect, $sql1);
        $_SESSION['info_cat'] = 'Категории были удалены!';
        header("Location: /index.php?route=admin&page=a_categories");
        exit();
    } else {
        $_SESSION['info_cat'] = 'Не выбраны категории для удаления!';
        header("Location: /index.php?route=admin&page=a_categories");
        exit();
    }
}
if (isset ($_GET['action']) && $_GET['action'] == 'delete') { // удаление одной категории из БД
    $sql2 = "DELETE FROM `category`
              WHERE `category_id`=" . (int)$_GET['category_id'] . "
            ";
    $query2 = mysqli_query($connect, $sql2);
    $_SESSION['info_cat'] = 'Категория была удалена!';
    header("Location: /index.php?route=admin&page=a_categories");
    exit();
}

getView_a('a_categories', $data);
//wtf($data,1);
//wtf($_POST,1);
