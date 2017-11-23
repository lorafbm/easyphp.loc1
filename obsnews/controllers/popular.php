<?php
/*вывод  последних 10  новостей на главной из все категорий */
$sql = "SELECT * ,DATE_FORMAT( date,  '%d %M %Y %T'  ) as date
        FROM `news`
        ORDER BY `q_view` DESC 
        LIMIT 6
       ";
$row = mysqli_query($connect, $sql);
//  wtf($row);

while ($res = mysqli_fetch_assoc($row)) {
    $data['news'][] =$res;
    $sql_cat = "SELECT `category_name`
         FROM `category`
          WHERE `category_id`=" . (int)$res['category_id'] . "
         
         ";
    $res_cat = mysqli_query($connect, $sql_cat);

    $row_cat= mysqli_fetch_assoc($res_cat);
    $data['category']=$row_cat['category_name'];
}

/* вывод всей инфы по категории для формирования ссылок потом инклудим во все типы страниц*/
$sql_h = "SELECT *
        FROM `category`
        ORDER BY `category_id` ASC 
        ";
$res_h = mysqli_query($connect, $sql_h);

while ($row_h = mysqli_fetch_assoc($res_h)) {
    $data['category_info'][] =$row_h;
}

$data['title'] = 'Новости | «ABCновости»| Популярное';

getHeader($data);
getView('popular',$data);
getFooter();






