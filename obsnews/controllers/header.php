<?php
$connect = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
/* вывод всей инфы по категории для формирования ссылок */
$sql_h = "SELECT *
        FROM `category`
        ORDER BY `category_id` ASC 
        ";
$res_h = mysqli_query($connect, $sql_h);

while ($row_h = mysqli_fetch_assoc($res_h)) {
    $data['category_info'][] =$row_h;
}

/* вывод всей инфы по статичным страницам для формирования ссылок */

$sql_p = "SELECT *
        FROM `pages`
         ORDER BY `id` ASC 
        ";
$res_p = mysqli_query($connect, $sql_p);
while ($row_p = mysqli_fetch_assoc($res_p)) {
    $data['page'][] = $row_p;
}
/*выборка контактов для отражения еа всех страницах */
$sql = "SELECT *
        FROM `contacts`
        WHERE `id` = 1
        LIMIT 1
         ";
$res = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($res);
$data['info']=$row;
//$data['title'] = 'Новости | «ABCновости»';




getView('header', $data);


