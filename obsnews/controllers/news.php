<?php
$_SESSION['info']='';
/*запрос на вывод категорий в ссылках хедера*/
$sql_h = "SELECT *
        FROM `category`
        ORDER BY `category_id` ASC 
        ";
$res_h = mysqli_query($connect, $sql_h);
$allow_categories = array();
while ($row_h = mysqli_fetch_assoc($res_h)) {
    $data['category_info'][] = $row_h;
}

$data['title'] = 'Новости | «ABCновости»| +0 000 000-00-00';


/*обновление к-ва просмотров*/
$sql_q = "SELECT * 
        FROM `news`
        WHERE `news_id` = '" . (int)$_GET['news_id'] . "'
        LIMIT 1
            ";
$row_q = mysqli_query($connect, $sql_q);


if (mysqli_num_rows($row_q)) {

    $res_q = mysqli_fetch_assoc($row_q);

    if ($res_q['q_view'] == 0) { // Если еще не было посещений
        // Заносим в базу дату посещения и устанавливаем кол-во просмотров в значение 1
        $sql_q1 = ("UPDATE `news` SET
			         `q_view`        = 1
			         WHERE `news_id` = " . (int)$_GET['news_id'] . "
		");
        $row_q1 = mysqli_query($connect, $sql_q1);

    } else {
        // Если посещения  уже были добавляем в базу  +1 просмотр
        $sql_q1 = ("UPDATE `news` SET
			                `q_view`=`q_view`+1
			        WHERE `news_id` = " . (int)$_GET['news_id'] . "
		");
        $row_q1 = mysqli_query($connect, $sql_q1);

    }
} else {
    $_SESSION['info'] = 'данной новости не существует!';
    header("Location: /");
    exit();
}

/*вывод конкретной новости*/
$sql = "SELECT * 
        FROM `news`
        WHERE `news_id` = '" . (int)$_GET['news_id'] . "'
            ";
$row = mysqli_query($connect, $sql);

while ($res = mysqli_fetch_assoc($row)) {
    $data['news'][] = $res;

}


getHeader($data);
getView('news', $data);
getFooter();
//wtf($data, 1);

