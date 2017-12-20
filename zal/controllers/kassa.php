<?php

/*$list = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20);
//грузим базу связи событие-билеты
$a=6;

foreach ($list as $key=>$v){
    //вставляем данные в БД
    $sql = q("INSERT INTO `tickets2_events` SET
                      `ticket_id`        = '" . $v . "',
                      `event_id`= '".$a."',
                      `ticket_status`=0
           ");

}*/
/*вывод мест если пришли с событием*/
if (!empty($_GET['event_id'])) {
    $res = q("SELECT `ticket_id`,`category_id`,`row`,`place`,`ticket_status`,`price`,`limit_ticket`
              FROM `tickets`
              LEFT JOIN `tickets2_events` ON `tickets2_events`.`ticket_id` = `tickets`.`tick_id`
              LEFT JOIN `events` ON `events`.`id` = `tickets2_events`.`event_id`
              LEFT JOIN `tickets_category` ON `tickets_category`.`id` = `tickets`.`category_id`
              WHERE `event_id`='" . $_GET['event_id'] . "'
              ");
    if ($res) {
        $ids = array();
        while ($row = $res->fetch_assoc()) {
            $data['tickets'][] = $row;// формируем массив для передачи
            $ids[] = $row['ticket_id'];
            $data['ids'] = $ids;
        }
    }
} else {/*вывод просто категорий билетов*/
    $res = q("SELECT *
              FROM `tickets_category`
             ");
    while ($row = $res->fetch_assoc()) {
        $data['tickets_category'][] = $row;// формируем массив для передачи
    }
}

/*лимит*/
if (isset($_SESSION['user'])) {
    /*обработчик формы*/
    if (isset($_POST['submit'])) {
        if (!isset($_POST['ticket'])) {
            $data['error'] = 'Ничего не выбрано!';
        } else { // если пришел массив чекбоксов
            foreach ($_POST['ticket'] as $k => $v) {
                $_POST['ticket'][$k] = (int)$v;
                $ids = implode(',', $_POST['ticket']); // разбиаем массив пришедших чекбоксов  по ,
            }

            /*запрос на лимит по id билета в тбл категорий*/
            /*          $res1 = q("
              SELECT `tick_id`,`category_id`,`limit_ticket`
              FROM `tickets`
              LEFT JOIN `tickets_category` ON `tickets`.`category_id` = `tickets_category`.`id`
              WHERE `tick_id` IN (" . $ids . ")
              ");
                      while ($row1 = $res1->fetch_assoc()) {
                          $data['limits'][] = $row1;// формируем массив для передачи
                      }*/

            /*группируем выбранные билеты в вид:id категории билета,limit,номера билетов*/
            $res1 = q("SELECT `id`,`limit_ticket`,`category_name`,GROUP_CONCAT(`tickets`.`tick_id`)as tick_numbers
                       FROM `tickets_category`
                       JOIN `tickets` ON `tickets`.`category_id` = `tickets_category`.`id`
                       WHERE `tick_id` IN (" . $ids . ")
                       GROUP BY `tickets_category`.`id`
                       ");
            while ($row1 = $res1->fetch_assoc()) {
                $array_info[] = $row1; // выводим выборку в массив
                foreach ($array_info as $k => $v) {   // перебираем
                    $arr = explode(',', $v['tick_numbers']);   // преобразовываем в массив список выбранных id билетов
                    $q = count($arr); // получили их количество
                    //echo $q.'<br>';
                   // echo $v['limit_ticket'].'<br>';
                    if ($v['limit_ticket'] < $q) { // если лимит меньше выбранного числа билетов
                        $data['error'] = 'Превышен лимит  по категории '.$v['category_name'].'!';// формируем ошибку
                    } else {
                        //пометили билет(ы) как купленный
                        q("UPDATE `tickets2_events` SET
                            `ticket_status`        = 1
                             WHERE `event_id`  =  " . (int)$_GET['event_id'] . "
                             AND    `ticket_id` IN  (" . $ids . ")
                            ");
                        //записываем заказ в таблицу заказов
                        foreach ($_POST['ticket'] as $k => $v) {
                            q("INSERT INTO `zakaz` (`user_id`,`ticket_id` ,`event_id`,`data_zakaz`)
                               VALUES (" . $_SESSION['user']['user_id'] . "," . (int)$v . "," . (int)$_GET['event_id'] . ",  NOW()  )
                              ");
                        }
                        $_SESSION['info_kassa'] = 'Ваш заказ принят! Для просмотра или удаления пройдите в кабинет!';
                        $redirect = $_SERVER['HTTP_REFERER'];
                        header("Location: $redirect");
                        exit();
                    }
                }

            }
        }
    }
} else {
    $data['info_kassa'] = 'Авторизуйтесь чтобы сделать заказ!';
}
//wtf($data['limits'], 1);
//wtf($data, 1);
//wtf($_SESSION, 1);
wtf($array_info, 1);
getView('kassa', $data);