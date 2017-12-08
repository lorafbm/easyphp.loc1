<?php
$connect = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
/*выборка контактов для отражения еа всех страницах */
$sql = "SELECT *
        FROM `contacts`
        WHERE `id` = 1
        LIMIT 1
         ";
$res = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($res);
$data['info'] = $row;

getView('footer', $data);