<?php
/*выборки header*/
$sql_h = "SELECT *
        FROM `category`
        ORDER BY `category_id` ASC 
        ";
$res_h = mysqli_query($connect, $sql_h);
$allow_categories = array();
while ($row_h = mysqli_fetch_assoc($res_h)) {
    $data['category_info'][] =$row_h;
}
$sql = "SELECT *
        FROM `aboutus`
         ";
$res = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($res);
$data['info']=$row;



$data['title'] = 'Новости | «ABCновости»| +0 000 000-00-00';

getHeader($data);
getView('aboutus',$data);
getFooter();
//wtf($data,1);


