<?php


class Valid
{
    public $znak = '';

    //валидация поля формы на пустоту
    public function required($name)
    {
        if (empty($name)) {
            return 'Вы не заполнили поле!';
        }
    }

    //валидация поля формы на минимальную длину
    public function minLength($name)
    {
        if (!empty($name)) {
            if (is_array($name)) {
                foreach ($name as $item) {
                    $name = trim($item);
                }
            } else {
                $name = trim($name);
            }
            if (mb_strlen($name) < 2) {
                return ' Введите не менее 2-х символов!';
            }
        }
    }

    //валидация поля формы на максимальную длину
    public function maxLength($name)
    {
        if (!empty($name)) {
            if (is_array($name)) {
                foreach ($name as $item) {
                    $name = trim($item);
                }
            } else {
                $name = trim($name);
            }
            if (mb_strlen($name) > 120) {
                return ' Введите не более 120 символов!';
            }
        }
    }

    //валидация поля email
    public function checkEmail($name)
    {
        if (!empty($name)) {
            if (!filter_var($name, FILTER_VALIDATE_EMAIL)) {
                return 'Введите правильно email!';
            }
        }
    }

    //проверяем поле, например возраст, на пустоту, диапазон (от 18 до 100 лет, например) и целочисленность
    public function valid_num($str)
    {
        if (!empty($str)) {
            if (is_numeric(trim($str))) {
                if ($str < 1 || $str > 100) {
                    return 'Введите целое число от 1 до 100';
                } else {// проверяем целое ли число
                    for ($i = 0; $i < strlen($str); $i++) {
                        if ($str[$i] == '.') {
                            $this->znak = 'no';
                        }
                    }
                    if (!empty($this->znak)) {
                        return 'Введите  только целое число';
                    }// elseif (!is_numeric(substr($_POST['age'], 0, 1))) {
//                        return 'Перед числом не  должно быть других знаков';
//                    } else {
//                        return true;
//                    }
                }
            } else {
                return 'Введите целое число';
            }
        }
    }

    //проверка имени формы на уникальность
    public function sameForm($str, $obj)
    {
        $str = trim($str);
        $res = $obj->myQuery("
            SELECT `id`
            FROM `forms`
            WHERE `form_name` = '" . $str . "'
            LIMIT 1
        ");
        if (mysqli_num_rows($res)) {
            return 'Ошибка! Такая запись уже существует в БД';
        }
    }

    //валидация поля формы на пустоту и длину
    public function val_Field($name, $length = false, $email = false)
    {
        if (is_array($name)) {
            foreach ($name as $item) {
                $name = trim($item);
            }
        } else {
            $name = trim($name);
        }
        if ($length == 1) {// на длинну
            if (empty($name)) {
                return 'Вы не заполнили поле!';
            } else {
                $length = mb_strlen($name);
                if ($email) {
                    if (!filter_var($name, FILTER_VALIDATE_EMAIL)) {
                        return 'Введите правильно email!';
                    }
                } else {
                    if ($length < 2) {
                        return ' Введите не менее 2-х символов!';
                    } elseif ($length > 120) {
                        return 'Не более 120 символов!';
                    }
                }
            }
        } else {//только на пустоту
            if (empty($name)) {
                return 'Отметьте нужный вариант!';
            }
        }
    }


}
