<?php
$connect = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
$sql = "SELECT *
        FROM `aboutus`
         ";
$res = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($res);
$data['info']=$row;

getView('footer',$data);