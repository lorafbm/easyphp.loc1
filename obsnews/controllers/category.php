<?php
/*запрос на количество новостей в категории*/
$category_id = (int)$_GET['category_id'];
$newsq = q("
    SELECT COUNT(*)
    FROM `news`
     WHERE `category_id` = '" . $category_id . "'
");
$tnum = $newsq->fetch_row();
$num = $tnum[0];
$data['num'] = $num;
/*пагинатор*/
$count_show_pages = 3;// задаем сколько сообщений выводить на странице
$count_pages = (int)(($num - 1) / $count_show_pages) + 1;
$data['count_pages'] = $count_pages;

$url = '/index.php?route=category&category_id=' . htmlspecialchars($_GET['category_id']);
$url_page = '/index.php?route=category&category_id=' . htmlspecialchars($_GET['category_id']) . '&key=';
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
        AND `category_id` = '" . (int)$category_id . "'
        ORDER BY `news_id` DESC 
        
     ";
    $res_s = mysqli_query($connect, $sql_s);
    if ($res_s) {
        while ($row_s = mysqli_fetch_assoc($res_s)) {
            $data['news'][] = $row_s;  // формируем массив для передачи
        }
    }
} else {
    /*выборка новостей по нужной категории*/
    if (!empty($_GET['category_id'])) {

        $sql_n = q("SELECT * 
             FROM `news`
             WHERE `category_id` = '" . (int)$category_id . "'
             ORDER BY `news_id` DESC
              LIMIT  " . $limit . "," . $count_show_pages . "
            ");

        while ($res_n = mysqli_fetch_assoc($sql_n)) {
            $data['news'][] = $res_n;
        }
    }
}

/*выборки для хедера категорий*/
$sql_h = "SELECT *
          FROM `category`
           ORDER BY `category_id` ASC
          ";
$res_h = mysqli_query($connect, $sql_h);
$allow_categories = array();
while ($row_h = mysqli_fetch_assoc($res_h)) {
    $data['category_info'][] = $row_h;
    $allow_categories[] = $row_h['category_id'];//массив допустимых названий категорий
}

/*запрос есть ли уникальный title у текущей категориии выводим название категории*/
$sql_t = "SELECT *
          FROM `category`
          WHERE `category_id` = '" . $category_id . "' 
             ORDER BY `category_id` ASC 
          ";
$res_t = mysqli_query($connect, $sql_t);

while ($row_t = mysqli_fetch_assoc($res_t)) {
    $data['category'] = $row_t['category_name']; // получаем имя категрии новости
    //  echo $row_t['title'];
    if (!empty($row_t['title'])) {
        $data['title'] = $row_t['title'];
    } else {
        $data['title'] = $row_t['category_name'];
    }
}
/*проверяем есть ли данная категория если нет то 404*/
if (in_array($category_id, $allow_categories)) {
    //  echo $category_id;  wtf($allow_categories,1);
    getHeader($data);
    // wtf($data, 1);
    getView('category', $data);
    getFooter();
} else {
    getHeader($data);
    getView('404');
    getFooter();
}





