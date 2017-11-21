<?php
/*получаем количество новостей*/
$newsq = q("
    SELECT COUNT(*)
    FROM `news`
");

$tnum = mysqli_fetch_row($newsq);
$num = $tnum[0];
$data['num'] = $num;


/*пагинатор*/
$count_show_pages = 4;// задаем сколько сообщений выводить на странице
$count_pages = (int)(($num - 1) / $count_show_pages) + 1;
$data['count_pages'] = $count_pages;

$url = '/index.php?route=admin&page=a_news';
$url_page = '/index.php?route=admin&page=a_news&key=';
$data['url'] = $url;
$data['url_page'] = $url_page;

if (isset ($_GET['key']) && (int)$_GET['key'] && $_GET['key'] > 0) {
    $limit = (int)$_GET['key'] * $count_show_pages - $count_show_pages;
} else {
    $_GET['key'] = 1;
    $limit = 0;
}
/*поиск*/
if (!empty($_POST['name'])) {
    foreach ($_POST as $k => $v) {
        $_POST[$k] = trimAll($v);
    }
    $sql_s = " 
        SELECT *
        FROM `news` 
        WHERE `news_name` LIKE '%" . mysqli_real_escape_string($connect, $_POST['name']) . "%' 
        ORDER BY `news_id` DESC 
        
     ";
    $res_s = mysqli_query($connect, $sql_s);

   if($res_s) {
       while ($row_s = mysqli_fetch_assoc($res_s)) {
           $data['news'][] = $row_s;  // формируем массив для передачи
       }
       $sql_cat = "SELECT *
            FROM `category`
            ORDER BY `category_id` DESC 
         ";
       $res_cat = mysqli_query($connect, $sql_cat);

       while ($row_cat = mysqli_fetch_assoc($res_cat)) {
           $data['category_info'][] = $row_cat;  // формируем массив для передачи
       }
   }
} else {
    /*выборка новостей для вывода начиная с последних*/
    $sql1 = "SELECT *
         FROM `news`
         ORDER BY `news_id` DESC 
          LIMIT  " . $limit . "," . $count_show_pages . "
         ";
    $res1 = mysqli_query($connect, $sql1);

    while ($row1 = mysqli_fetch_assoc($res1)) {
        $data['news'][] = $row1;  // формируем массив для передачи

    }
    $sql_cat = "SELECT *
            FROM `category`
            ORDER BY `category_id` DESC 
         ";
    $res_cat = mysqli_query($connect, $sql_cat);

    while ($row_cat = mysqli_fetch_assoc($res_cat)) {
        $data['category_info'][] = $row_cat;  // формируем массив для передачи
    }

}

/*удаление*/
// удаление группы категорий из БД
if (isset($_POST['delete'])) {
    $_SESSION['info_news'] = '';// если пришел пост на удаление
    if (isset($_POST['ids'])) {  // если пришел массив чекбоксов
        // wtf($_POST['ids'],1);
        foreach ($_POST['ids'] as $k => $v) { // перебираем
            $_POST['ids'][$k] = (int)$v;
        }
        $ids = implode(',', $_POST['ids']); // разбиваем массив чтобы получить список id категорий которые нужно удалить

        $sql1 = "DELETE FROM `news`
                  WHERE `news_id` IN (" . $ids . ")
                ";
        $query1 = mysqli_query($connect, $sql1);


        $_SESSION['info_news'] = 'Новости были удалены!';
        header("Location: /index.php?route=admin&page=a_news");
        exit();
    } else {
        $_SESSION['info_news'] = 'Не выбраны новости для удаления!';
        header("Location: /index.php?route=admin&page=a_news");
        exit();
    }
}
if (isset ($_GET['action']) && $_GET['action'] == 'delete') { // удаление одной новости из БД
    $_SESSION['info_news'] = '';
    $sql2 = "DELETE FROM `news`
              WHERE `news_id`=" . (int)$_GET['news_id'] . "
            ";
    $query2 = mysqli_query($connect, $sql2);

    $_SESSION['info_news'] = 'Новость была удалена!';
    header("Location: /index.php?route=admin&page=a_news");
    exit();
}


$data['title'] = ' Админ «ОБСновости» | Новости';

/*if (isset ($_SESSION['info_news'])) {
    unset ($_SESSION['info_news']);
}*/
//wtf($data,1);
getHeader_a($data);
getView_a('a_news', $data);
getFooter_a();