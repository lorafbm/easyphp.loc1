<?php
if (isset($_SESSION['user'])) {
    $res = q("
        SELECT  `user_id`,`event_id`,`row`,`place`,`category_name`,`name`, DATE_FORMAT( date_start,  '%d %M %Y %T'  ) as date_start,`zakaz_id` ,DATE_FORMAT( data_zakaz,  '%d %M %Y '  ) as data_zakaz,`price`,
        ( SELECT COUNT(*) FROM `zakaz`) as `cnt`
        FROM `zakaz`
        LEFT JOIN `tickets` ON `tickets`.`tick_id` = `zakaz`.`ticket_id`
        LEFT JOIN `events` ON `events`.`id` = `zakaz`.`event_id`
        LEFT JOIN `tickets_category` ON `tickets_category`.`id` = `tickets`.`category_id`
        WHERE `user_id`  =  " . (int)$_SESSION['user']['user_id'] . "
         ORDER BY `zakaz_id` DESC
        ");

    if ($res) {
        while ($row = $res->fetch_assoc()) {
            $data['zakaz'][] = $row;// формируем массив для передачи
            $data['cost'][] = $row['price'];
        }
    }
    /*удаление*/
    if (isset ($_GET['action']) && $_GET['action'] == 'delete') { // удаление одной категории из БД

        /*выбока из тбл заказов id билета для */
        $res2 = q("SELECT `ticket_id`
                   FROM `zakaz`
                   WHERE `zakaz_id`=" . (int)$_GET['id'] . "
                   ");
        $row = $res2->fetch_assoc();
        //echo $row['ticket_id'];
        //пометили билет как свободный
        q("UPDATE `tickets2_events` SET
          `ticket_status`        = 0
          WHERE `ticket_id`= " . $row['ticket_id'] . "
         ");

        /*удаляем заказ*/
        $sql = q("DELETE FROM `zakaz`
                  WHERE `zakaz_id`=" . (int)$_GET['id'] . "
                ");
        $_SESSION['info_zakaz'] = 'Заказ был удален!';
        header("Location: /index.php?route=zakaz");
        exit();
    }

}

//wtf($data['zakaz'],1);
    if(!empty($data)) {
        $d = new myDate;
        $data1 = $d;
        getView('zakaz', $data, $data1);
    }else{
        getView('zakaz');
    }

