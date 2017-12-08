<?php
/*вывод  последних 6  новостей  из всех категорий с наибольшим кол-м просмотров */
$sql = "SELECT * ,DATE_FORMAT( date,  '%d %M %Y %T'  ) as date
        FROM `news`
        ORDER BY `q_view` DESC 
        LIMIT 6
       ";
$row = mysqli_query($connect, $sql);
//  wtf($row);

while ($res = mysqli_fetch_assoc($row)) {
    $data['news'][] = $res;
}
/* вывод всей инфы по категории*/
$sql_h = "SELECT `category_name`,`category_id`
        FROM `category`
        ORDER BY `category_id` ASC 
        ";
$res_h = mysqli_query($connect, $sql_h);
while ($row_h = mysqli_fetch_assoc($res_h)) {
    $data['category_info'][] = $row_h;
}
//wtf($data, 1);
getView('popular', $data);







