<?php
$sql = "SELECT * FROM `contacts`
        LIMIT 1
        ";
$res = mysqli_query($connect, $sql);
while ($row = mysqli_fetch_assoc($res)) {
    $data['contacts'] = $row;
}
/*обработчик формы*/
$data['errors']=array();
if (isset($_POST['submit'], $_POST['address'], $_POST['phone'])) {
    $data['errors'] = array();
    if (empty($_POST['address'])) {
        $data['errors']['address'] = 'Заполните адрес!';
    }
    if (empty($_POST['phone'])) {
        $data['errors']['phone'] = 'Вы не заполнили телефон!';
    }
    // валидация мыло на пустоту
    if (empty ($_POST['email'])) {
        $data['errors']['email'] = 'Заполните e-mail!';
    }
    if (!count($data['errors'])) {// если нет ошибок обновляем данные в БД
        foreach ($_POST as $k => $v) {
            $_POST[$k] = trimAll($v);
        }
        $sql1 = "UPDATE `contacts` SET 
                `address`      ='" . $_POST['address'] . "',
                `email`        ='" . $_POST['email'] . "',
                `phone`        ='" . $_POST['phone'] . "'
                ";
        mysqli_query($connect, $sql1);
        $_SESSION['info_a'] = 'Данные успешно изменены!';
        header('Location: /index.php?route=admin');
        exit();
    }
}
if (isset($_POST['address'], $_POST['phone'], $_POST['email'])) {
    $data['contacts']['address'] = $_POST['address'];
    $data['contacts']['phone'] = $_POST['phone'];
    $data['contacts']['email'] = $_POST['email'];
}
getView_a('contacts', $data);
//wtf($_SESSION,1);
wtf($data, 1);
