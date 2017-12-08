<?php
/*запрос на количество новостей в категории*/
$category_id = (int)$_GET['category_id'];
$newsq = "SELECT COUNT(*)
           FROM `news`
           WHERE `category_id` = '" . $category_id . "'
           ";
$res_q = mysqli_query($connect, $newsq);
$tnum = mysqli_fetch_row($res_q);
$num = $tnum[0];
$data['num'] = $num;

/*пагинатор*/
$count_show_pages = 3;// задаем сколько сообщений выводить на странице
$count_pages = (int)(($num - 1) / $count_show_pages) + 1;
$data['count_pages'] = $count_pages;
$url = '/index.php?route=category&category_id=' . (int)($_GET['category_id']);
$url_page = '/index.php?route=category&category_id=' . (int)($_GET['category_id']) . '&key=';
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
        SELECT * FROM `news` 
        WHERE `news_name` LIKE '%" . $_POST['name'] . "%' 
        AND   `category_id`   = '" . $category_id . "'
        ORDER BY `news_id` DESC 
        LIMIT  " . $limit . "," . $count_show_pages . "
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
        $sql_n = "SELECT * 
                  FROM `news`
                  WHERE `category_id` = '" . $category_id . "'
                    ORDER BY `news_id` DESC
                 ";
        $res_n = mysqli_query($connect, $sql_n);
        while ($row_n = mysqli_fetch_assoc($res_n)) {
            $data['news'][] = $row_n;
        }
    }
}

/*создаем массив допустимых категорий для проверки на существование категории*/
$sql_h = "SELECT `category_name`, `category_id`,`title`
          FROM `category`
           ORDER BY `category_id` ASC
          ";
$res_h = mysqli_query($connect, $sql_h);
$allow_categories = array();
while ($row_h = mysqli_fetch_assoc($res_h)) {
    $data['cat_info'][] = $row_h;
    $allow_categories[] = $row_h['category_id'];//массив допустимых id категорий
    foreach ($data['cat_info'] as $key) {
        if ($key['category_id'] == $category_id) { // если категория текущая
            $data['category'] = $key['category_name']; // получаеи имя по id
        }
    }
}

/*проверяем есть ли данная категория если нет то подключаем 404*/
if (in_array($category_id, $allow_categories)) {
    getView('category', $data);
} else {
    getView('404');
}

//wtf($data, 1);