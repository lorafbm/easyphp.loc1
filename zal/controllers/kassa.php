<?php

/*$list = array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35);
//грузим базу связи событие-билеты
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
    $res = q("SELECT `ticket_id`,`category_id`,`category_name`,`row`,`place`,`ticket_status`,`price`,`limit_ticket`
              FROM `tickets`
              LEFT JOIN `tickets2_events` ON `tickets2_events`.`ticket_id` = `tickets`.`tick_id`
              LEFT JOIN `events` ON `events`.`id` = `tickets2_events`.`event_id`
              LEFT JOIN `tickets_category` ON `tickets_category`.`id` = `tickets`.`category_id`
              WHERE `event_id`='" . $_GET['event_id'] . "'
              ");
    if ($res->num_rows) {
        while ($cats = mysqli_fetch_assoc($res)) {
            $data['tickets'][$cats['category_id']]['row'][$cats['row']][] = $cats;
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
            /*группируем выбранные билеты в вид:id категории билета,limit,номера билетов*/
            $res1 = q("SELECT `id`,`limit_ticket`,`category_name`,`category_id`,GROUP_CONCAT(`tickets`.`tick_id`)as tick_numbers
                       FROM `tickets_category`
                       JOIN `tickets` ON `tickets`.`category_id` = `tickets_category`.`id`
                       WHERE `tick_id` IN (" . $ids . ")
                       GROUP BY `tickets_category`.`id`
                       ");
            while ($row1 = $res1->fetch_assoc()) {
                $array_info[] = $row1; // выводим выборку в массив
                foreach ($array_info as $k => $v) {   // перебираем
                    $arr = explode(',', $v['tick_numbers']); // преобразовываем в массив список выбранных id билетов
                    $q = count($arr); // получили их количество
                    $array_info[$k]['q'] = $q; // дописали массив ключом количества выбранных билетов в данной каегории

                    if ($v['limit_ticket'] < $q) { // если заданный лимит по категории  меньше выбранного числа билетов
                        $data['error'] = 'Превышен лимит  по категории!';// формируем ошибку
                    }
                }
            }
            $res2 = q("SELECT COUNT(`zakaz`.`ticket_id`) as q ,`tickets`.`category_id`
                        FROM `zakaz`
                        LEFT JOIN `tickets` ON `tickets`.`tick_id` = `zakaz`.`ticket_id`
                        WHERE `zakaz`.`user_id`=" . $_SESSION['user']['user_id'] . "
                        AND `zakaz`.`event_id`=" . (int)$_GET['event_id'] . " 
                        GROUP BY `tickets`.`category_id`
                        ");
            while ($row2 = $res2->fetch_assoc()) {
                $array_info1[] = $row2;
                foreach ($array_info as $k => $v) {   // перебираем
                    foreach ($array_info1 as $kk => $vv) {   // перебираем
                        //   echo $k['category_id'].'<br>';
                        //  echo $kk['category_id'];
                        if ($v['category_id'] == $vv['category_id']) {// если категории равны
                            $t_q = $v['q'] + $vv['q'];// суммируем билеты уже заказанные поэтой категории и выбранные
                            // echo '<br>'.$t_q.'<br>';
                            if ($v['limit_ticket'] < $t_q) { // если заданный лимит по категории  меньше выбранного числа билетов
                                $data['error'] = 'Превышен лимит  по онлайн закупке по категории!';// формируем ошибку
                            }
                        }

                    }

                }
            }

            //   }
            if (!isset($data['error'])) {// если нет ошибок то формируем заказ


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

} else {
    $data['info_kassa'] = 'Авторизуйтесь чтобы сделать заказ!';
}
//wtf($data['tickets'], 1);
//wtf($_POST, 1);
//wtf($_SESSION, 1);
//wtf($array_info, 1);
//wtf($array_info1, 1);
//wtf($arr1,1);
getView('kassa', $data);