<?php
/*получаем токен для работы с аккаунтом*/
if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['getToken'])) {
    $user = new User;
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);
    $res = $user->gettoken($login, $password);

    if ($res) { // если получили токен
        $msg['status'] = 'ok';
        $msg['response'] = $res;
        $msg['error'] = 0;
        $_SESSION['response'] = $res;
        $id=$user->getInfoUser($res);

        if($id) {
            $msg['id'] = $id['user_id'];
            $_SESSION['id'] = $id['user_id'];
        }
        echo json_encode($msg); // ответ в формате json
        exit();
    }
}
/*получаем список соцсетей*/
if (!empty($_POST['token']) && !empty($_POST['getList']) ) {
    $user = new User;
    $token = trim($_POST['token']);
    $res = $user->getStatusSocial($token);
    if ($res) { // если получили true
        $msg['status'] = 'ok';
        $msg['response'] = $res;
        $msg['error'] = 0;
        echo json_encode($msg); // ответ в формате json
        exit();
    }else{
        $msg['status'] = 'ok';
        $msg['response'] = 'Нет прикрепленных сетей!';
        $msg['error'] = 0;
        echo json_encode($msg,JSON_UNESCAPED_UNICODE); // ответ в формате json
        exit();
    }
}

/*запрос на отвязку аккаунта */

if (!empty($_POST['action']) && !empty($_POST['id'])){

    $sql = q(" SELECT * FROM `user_zal`
                WHERE `user_id`= " .(int) $_POST['id'] . "
                  LIMIT 1
               ");
    if (mysqli_num_rows($sql)) {
        $data = $sql->fetch_assoc();// извлекаем всю информацию о пользователе
        q("UPDATE `user_zal` SET
                  `f_id` = ''
                  WHERE `user_id`= " . (int)$data['user_id'] . "
                ");

        $msg['status'] = 'ok';
        $msg['text'] = 'Ваш аккаунт отвязан от facebook';
        $msg['error'] = 0;

        echo json_encode($msg,JSON_UNESCAPED_UNICODE);
        exit();
    }
    return false;
}

getView('testapi');