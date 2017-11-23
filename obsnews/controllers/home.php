<?php
/*вывод  последних 10  новостей на главной из все категорий */
$sql = "SELECT * ,DATE_FORMAT( date,  '%d %M %Y %T'  ) as date
        FROM `news`
        ORDER BY `news_id` DESC 
        LIMIT 9
       ";
$row = mysqli_query($connect, $sql);


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

$data['title'] = 'Новости | «ABCновости»| +0 000 000-00-00';

getHeader($data);
getView('home',$data);
getFooter();
//wtf($data,1);





