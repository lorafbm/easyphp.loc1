<?php
$res = q("
        SELECT  `user_id`,`event_id`,`row`,`place`,`data_zakaz`,`category_name`,`name`,`zakaz_id`,`date_start`,
        ( SELECT COUNT(*) FROM `zakaz`) as `cnt`
        FROM `zakaz`
        LEFT JOIN `tickets` ON `tickets`.`id` = `zakaz`.`ticket_id`
        LEFT JOIN `events` ON `events`.`id` = `zakaz`.`event_id`
        LEFT JOIN `tickets_category` ON `tickets_category`.`id` = `tickets`.`category_id`
        WHERE `user_id`  =  " . (int)$_SESSION['user']['user_id'] . "
         ORDER BY `zakaz_id` DESC
        ");

if ($res) {
    while ($row=$res->fetch_assoc()) {
        $data['zakaz'][] = $row;// формируем массив для передачи


    }
}


getView('zakaz',$data);

