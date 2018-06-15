<?php

class User
{
    public function getToken($login, $password)
    {
        $sql = q(" SELECT `hash` FROM `user_zal`
                 WHERE `user_name`= '" . res($login) . "' 
                 AND  `password`  = '" . res(MyHash($password)) . "'
                  LIMIT 1
                ");
        if (mysqli_num_rows($sql)) {
            $data = $sql->fetch_assoc();// извлекаем всю информацию о пользователе
            return $data['hash'];
        } else {

            return false;
        }

    }

    public function getStatusSocial($token)
    {
        $sql = q(" SELECT `f_id` FROM `user_zal`
                    WHERE `hash`= '" . res($token) . "' 
                     LIMIT 1
                ");
        if (mysqli_num_rows($sql)) {
            $data = $sql->fetch_assoc();// извлекаем всю информацию о пользователе
            if (!empty($data['f_id'])) {

                return 'faceebook';
            } else {

                return false;
            }
        }else{

        }
    }
    public function getInfoUser($token)
    {
        $sql = q(" SELECT `f_id`,`user_id` FROM `user_zal`
                    WHERE `hash`= '" . res($token) . "' 
                     LIMIT 1
                ");
        if (mysqli_num_rows($sql)) {
            $data = $sql->fetch_assoc();// извлекаем всю информацию о пользователе

                return $data;

        }
    }

}