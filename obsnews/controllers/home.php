<?php
/*вывод  последних 9  новостей на главной из всех категорий */
$sql = "SELECT * ,DATE_FORMAT( date,  '%d %M %Y %T'  ) as date
        FROM `news`
        ORDER BY `news_id` DESC 
        LIMIT 9
       ";
$row = mysqli_query($connect, $sql);


while ($res = mysqli_fetch_assoc($row)) {
    $data['news'][] =$res;

}

/* вывод инфы по категории вывода в новости (можноего убрать и сократим запрос и невыводит категорию на главной)*/
$sql_сat = "SELECT `category_id`, `category_name`
        FROM `category`
        ORDER BY `category_id` ASC 
        ";
$res_сat = mysqli_query($connect, $sql_сat);

while ($row_сat = mysqli_fetch_assoc($res_сat)) {
    $data['cat_info'][] =$row_сat;
}

//$data['title'] = 'Новости | «ABCновости»';

//getHeader($data);
getView('home',$data);
//getFooter();
//wtf($data,1);





