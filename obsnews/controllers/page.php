<?php
$page_id = (int)$_GET['page_id'];
/*выборка информации по нужной странице,
создаем массив допустимых страниц для проверки на существование */
$sql = "SELECT *
        FROM `pages`
          ORDER BY `id` ASC
          ";
$res = mysqli_query($connect, $sql);
$allow_pages = array();
while ($row = mysqli_fetch_assoc($res)) {
    $data['pages'][] = $row;
    $allow_pages[] = $row['id'];//массив допустимых id страниц
    foreach ($data['pages'] as $key) {
        if (!empty($_GET['page_id'])) {
            if ($key['id'] == $page_id) { // если категория текущая
                $data['info'] = $key;
            }
        }
    }
}

/*проверяем есть ли данная страница если нет то 404*/
if (in_array($page_id, $allow_pages)) {
    getView('page', $data);
} else {
    getView('404');
}

//wtf($data, 1);


