<?php

/*$list = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20);

$a=6;

foreach ($list as $key=>$v){
    //вставляем данные в БД
    $sql = q("INSERT INTO `tickets2_events` SET
                      `ticket_id`        = '" . $v . "',
                      `event_id`= '".$a."'
           ");

}*/


$res = q("SELECT `ticket_id`,`category_id`,`row`,`place`,`status`
        FROM `tickets`
        LEFT JOIN `tickets2_events` ON `tickets2_events`.`ticket_id` = `tickets`.`id`
        LEFT JOIN `events` ON `events`.`id` = `tickets2_events`.`event_id`
        ");
if ($res) {

    while ($row=$res->fetch_assoc()) {
        $data['tickets'][] = $row;// формируем массив для передачи


    }
}


getView('kassa',$data);