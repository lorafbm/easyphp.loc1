<?php
/*пустая инфо переменная кот выводит сообщение если нет новости кот хотят искать при полном просмотресо стр news.php*/
$_SESSION['info'] = '';
/*обновление к-ва просмотров и вывод конкретной новости*/
$sql = "SELECT * 
        FROM `news`
        WHERE `news_id` = '" . (int)$_GET['news_id'] . "'
        LIMIT 1
            ";
$row = mysqli_query($connect, $sql);
while ($res = mysqli_fetch_assoc($row)) {
    $data['news'][] = $res;

}
if (mysqli_num_rows($row)) {
    $res = mysqli_fetch_assoc($row);
    if ($res['q_view'] == 0) { // Если еще не было посещений
        // Заносим в базу дату посещения и устанавливаем кол-во просмотров в значение 1
        $sql_q1 = "UPDATE `news` SET
			         `q_view`        = 1
			         WHERE `news_id` = " . (int)$_GET['news_id'] . "
		";
        $row_q1 = mysqli_query($connect, $sql_q1);
    } else {
        // Если посещения  уже были добавляем в базу  +1 просмотр
        $sql_q1 = "UPDATE `news` SET
			                `q_view`=`q_view`+1
			        WHERE `news_id` = " . (int)$_GET['news_id'] . "
		";
        $row_q1 = mysqli_query($connect, $sql_q1);
    }
} else {
    $_SESSION['info'] = 'Данной новости не существует!';
    header("Location: /");
    exit();
}
getView('news', $data);
//wtf($data, 1);

