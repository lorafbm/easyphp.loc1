<?php
$sql = "SELECT *
        FROM `aboutus`
       ";
$res = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($res);
$data['info']=$row;



$data['title'] = ' Админ «ОБСновости» | О нас';
getHeader_a($data);
getView_a('a_aboutus',$data);
getFooter_a();