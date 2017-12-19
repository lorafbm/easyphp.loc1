<?php

/*$list = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20);
/*грузим базу
$a=1;

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
    $res = q("SELECT `ticket_id`,`category_id`,`row`,`place`,`ticket_status`,`price`
              FROM `tickets`
              LEFT JOIN `tickets2_events` ON `tickets2_events`.`ticket_id` = `tickets`.`id`
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
} else {/*вывод просто катеорий билетов*/
    $res = q("SELECT *
              FROM `tickets_category`
             ");
    while ($row = $res->fetch_assoc()) {
        $data['tickets_category'][] = $row;// формируем массив для передачи
    }
}
if (isset($_SESSION['user'])) {
    /*обработчик формы*/
    if (isset($_POST['submit'])) {
        if (!isset($_POST['ticket'])) {
            $data['error'] = 'Ничего не выбрано!';
        } else { // если пришел массив чекбоксов
            foreach ($_POST['ticket'] as $k => $v) {
                $_POST['ticket'][$k] = (int)$v;
                $ids = implode(',', $_POST['ticket']); // разбиаем массив по ,
                /*пометили билет(ы) как купленный */
                q("UPDATE `tickets2_events` SET
                 `ticket_status`        = 1
                  WHERE `event_id`  =  " . (int)$_GET['event_id'] . "
                  AND    `ticket_id` IN  (" . $ids . ")
                  ");
            }
            $data=time();
            /*записываем заказ в таблицу заказов*/
            foreach ($_POST['ticket'] as $k => $v) {
                q("INSERT INTO `zakaz` (`user_id`,`ticket_id` ,`event_id`,`data_zakaz`)
                   VALUES (" . $_SESSION['user']['user_id'] . "," . (int)$v . "," . (int)$_GET['event_id'] . ","  .$data.  ")
                  ");
            }
        }
        $_SESSION['info_kassa'] = 'Ваш заказ принят! Для просмотра или удаления пройдите в кабинет!';
        $redirect = $_SERVER['HTTP_REFERER'];
        header("Location: $redirect");
        exit();
    }
} else {
    $data['info_kassa'] = 'Авторизуйтесь чтобы сделать заказ!';
}

//wtf($data, 1);
//wtf($_SESSION, 1);
getView('kassa', $data);