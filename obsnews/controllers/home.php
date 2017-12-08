<?php
/*вывод  последних 9  новостей на главной из всех категорий */
$sql = "SELECT * ,DATE_FORMAT( date,  '%d %M %Y %T'  ) as date
        FROM `news`
        ORDER BY `news_id` DESC 
        LIMIT 9
       ";
$row = mysqli_query($connect, $sql);
while ($res = mysqli_fetch_assoc($row)) {
    $data['news'][] = $res;
}

/* вывод инфы по категории вывода в новости (можно его убрать и сократим запрос и не выводим категорию на главной)*/
$sql1 = "SELECT `category_id`, `category_name`
             FROM `category`
              ORDER BY `category_id` ASC 
            ";

$res1 = mysqli_query($connect, $sql1);

while ($row1 = mysqli_fetch_assoc($res1)) {
    $data['cat_info'][] = $row1;
}
getView('home', $data);

//wtf($data,1);





