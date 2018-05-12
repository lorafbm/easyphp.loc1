<?php
if ($_GET['country']==1){
    echo json_encode(array('1'=>'Харьков','2'=>'Киев'));
 //   exit();
}elseif ($_GET['country']==2) {
    echo json_encode(array('1' => 'Тбилиси', '2' => 'Батуми'));
//    exit();
}
