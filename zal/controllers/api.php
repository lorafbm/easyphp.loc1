<?php
$status = 'OK';
$response = null;
$error = 0;
/*получаем токен для работы с аккаунтом*/
if(empty($_GET['login']) || empty($_GET['password'])){ // если не получили хоть 1 из параметров
    $status = 'ERROR';
    $error = 1;
}else{
    $user= new User;
    $login = trim($_GET['login']);
    $password = trim($_GET['password']);
    $result = $user->gettoken($login,$password);
    if($result){ // если получили токен
        $response = $result;
        if(empty($_GET['token'])){
            $result = $user->getStatusSocial($response);
    if($result){ // если получили ответ ок
        $response = $result;
    }else{
        $response = false;
    }
        }
    }else{
        $response = false;
    }
}
/*получаем какие соц.сети прикреплены к данному аккаунту на вашем сайте*/
//if(empty($_GET['token'])){ // если не получили
//    $status = 'ERROR';
//    $error = 1;
//}else{
//    $user= new User;
//    $token = trim($_GET['token']);
//    $result = $user->getStatusSocial($result);
//    if($result){ // если получили токен
//        $response = $result;
//    }else{
//        $response = false;
//    }
//
//}
//







// массив для ответа
$result = array(
    'status' => $status,
    'response' => $response,
    'error' => $error,
);
echo json_encode($result); // ответ в формате json








getView('api');