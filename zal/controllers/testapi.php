<?php
/*получаем токен для работы с аккаунтом*/
if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['getToken'])) {
    $user = new User;
    $restful = new Restful;
    $login = trim($_POST['login']);
    $password = trim($_POST['password']);
    $res = $user->gettoken($login, $password);

    if ($res) { // если получили токен
        $msg['status'] = 'ok';
        $msg['response'] = $res;
        $msg['error'] = 0;
        $_SESSION['response'] = $res;
        $id = $user->getInfoUser($res);
        if ($id) {
            $msg['id'] = $id['user_id'];
            $_SESSION['id'] = $id['user_id'];
        }

        $restful->returnRestful($msg);
    }
}
/*получаем список соцсетей*/
if (!empty($_POST['token']) && !empty($_POST['getList'])) {
    $user = new User;
    $restful = new Restful;
    $token = trim($_POST['token']);
    $res = $user->getStatusSocial($token);

    if (!empty($_POST['format']) && $_POST['format'] == 'xml') {
        $format = trim(htmlspecialchars($_POST['format']));
        if (!$res) {
            $res = 'Нет сетей!';
        }

        $msg['response'] = $restful->myXmlgenaration($res);
        $restful->returnRestful($res, $format);

    } else {
        if ($res) { // если получили true
            $msg['status'] = 'ok';
            $msg['response'] = $res;
            $msg['error'] = 0;

        } else {
            $msg['status'] = 'ok';
            $msg['response'] = 'Нет прикрепленных сетей!';
            $msg['error'] = 0;

        }

        $restful->returnRestful($msg);
    }
}

/*запрос на отвязку аккаунта */

if (!empty($_POST['action']) && !empty($_POST['id'])) {

    $sql = q("SELECT * FROM `user_zal`
               WHERE `user_id`= " . (int)$_POST['id'] . "
                LIMIT 1
             ");

    if (mysqli_num_rows($sql)) {

        $restful = new Restful;
        $data = $sql->fetch_assoc();

        q("UPDATE `user_zal` SET
          `f_id` = ''
            WHERE `user_id`= " . (int)$data['user_id'] . "
          ");

        $msg['status'] = 'ok';
        $msg['text'] = 'Ваш аккаунт отвязан от facebook';
        $msg['error'] = 0;
        $restful->returnRestful($msg);
    }
    return false;
}

getView('testapi');