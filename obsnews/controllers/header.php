<?php
$connect = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
/* вывод всей инфы по категории для формирования ссылок потом инклудим во все типы страниц*/
/*$sql_h = "SELECT *
        FROM `category`
        ORDER BY `category_id` ASC 
        ";
$res_h = mysqli_query($connect, $sql_h);

while ($row_h = mysqli_fetch_assoc($res_h)) {
    $data['category_info'][] =$row_h;

}*/

$sql = "SELECT *
        FROM `aboutus`
         ";
$res = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($res);
$data['info']=$row;

getView('header', $data);


