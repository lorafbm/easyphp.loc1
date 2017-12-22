<?php
$q = q("SELECT COUNT(*)
           FROM `events`
           ");
$tnum = mysqli_fetch_row($q);
$num = $tnum[0];
$data1['num']=$num;
if (!isset ($_GET['key'])) {
    $_GET['key'] = 1;
}

$p=new Pagination(3, $_GET['key'] ,$num,'home');
$data=$p;

$res = q("
        SELECT * FROM `events` 
        ORDER BY `id` DESC 
        LIMIT  " . $p->count_limit($_GET['key']) . "," . $p->count_show_pages . "
        ");

if ($res->num_rows) {
    while ($row=$res->fetch_assoc()) {
        $data1['events'][] = $row;// формируем массив для передачи


    }
}
$d = new myDate;
$data2 = $d;
//wtf($_SESSION,1);
//wtf($data1,1);
getView('home',$data,$data1,$data2);
