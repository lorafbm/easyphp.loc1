<?php
/*выборка страниц для вывода*/
$sql = "SELECT *
         FROM `pages_zal`
         ORDER BY `id` ASC 
         ";
$res = mysqli_query($connect, $sql);

while ($row = mysqli_fetch_assoc($res)) {
    $data['page_info'][] = $row;  // формируем массив для передачи
}
// удаление группы категорий из БД
if (isset($_POST['delete'])) { // если пришел пост на удаление
    if (isset($_POST['ids'])) {  // если пришел массив чекбоксов
        // wtf($_POST['ids'],1);
        foreach ($_POST['ids'] as $k => $v) { // перебираем
            $_POST['ids'][$k] = (int)$v;
        }
        $ids = implode(',', $_POST['ids']); // разбиваем массив чтобы получить список id страниц которые нужно удалить
        //echo $ids;
        $sql1 = "DELETE FROM `pages_zal`
                  WHERE `id` IN (" . $ids . ")
                ";
        $query1 = mysqli_query($connect, $sql1);
        $_SESSION['info_page'] = 'Страницы были удалены!';
        header("Location: /index.php?route=admin&page=a_pages");
        exit();
    } else {
        $_SESSION['info_page'] = 'Не выбраны страницы для удаления!';
        header("Location: /index.php?route=admin&page=a_pages");
        exit();
    }
}
if (isset ($_GET['action']) && $_GET['action'] == 'delete') { // удаление одной страницы из БД
    $sql2 = "DELETE FROM `pages_zal`
              WHERE `id`=" . (int)$_GET['id'] . "
             ";
    $query2 = mysqli_query($connect, $sql2);
    $_SESSION['info_cat'] = 'Страница была удалена!';
    header("Location: /index.php?route=admin&page=a_pages");
    exit();
}
getView_a('a_pages', $data);
//wtf($data,1);

