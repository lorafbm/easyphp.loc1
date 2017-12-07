<?php
function wtf($array, $stop = false)
{
    echo '<pre>' . htmlspecialchars(print_r($array, 1)) . '</pre>';
    if (!$stop) {
        exit();
    }
}


Class myDate
{

    public $holidays = array('25-12-2017', '02-12-2017', '01-01-2018');//массив праздников из дат
    private $months_name = array(1 => 'Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря'); // Массив с названиями месяцев

    protected function if_time($data) // может исп в дочерних классах
    {
        $mydate = strtotime($data);
        $date_time_array = getdate($mydate);
        // wtf($date_time_array,1);
        if ($date_time_array['hours'] >= 20) {
            $date_zakaz = $mydate + 172800;// то +2 дня

        } else {  // время меньше 20,00
            $date_zakaz = $mydate + 86400;// то +1 день
        }
        $date_zakaz = date('d-n-Y', $date_zakaz); // привели к дате чтоб отсечь время
        // echo $date_zakaz.'<br>';
        $date_zakaz = strtotime($date_zakaz);// привели к числу
        return $date_zakaz;

    }


    protected function check_day($data)
    {
        $date_time_array = getdate($data);
        //    wtf($date_time_array,1);
        if ($date_time_array['wday'] == 6) {// если суббота 6
            $date_zakaz = $data + 172800;// то +2 дня
            return $date_zakaz;
        } elseif ($date_time_array['wday'] == 0) {// если воскресенье
            $date_zakaz = $data + 86400;// то +1 день
            return $date_zakaz;
        } elseif ($date_time_array['wday'] == 1) {// если понедельник
            $date_zakaz = self::if_holiday($data); //проверяем нет ли переноса праздника  с выходных
            return $date_zakaz;
        } else {
            return $data;
        }

    }

    protected function if_holiday($data)
    {
        foreach ($this->holidays as $k => $v) {
            $holidays[$k] = strtotime($v);
        }
        //  wtf($holidays, 1);
        // echo $data.'<br>';
        if (in_array($data, $holidays)) {// если праздник
            $date_time_array = getdate($data); // получили день недели праздника
            if ($date_time_array['wday'] == 5 || $date_time_array['wday'] == 6) {// если пятница 5 или суббота
                $date_zakaz = $data + 259200;// то +3 дня до понедельника или вторника
                $date_zakaz = self::if_holiday($date_zakaz); // снова проверяем вдруг праздник
                return $date_zakaz;
            } elseif ($date_time_array['wday'] == 0) {// если воскресенье 0
                $date_zakaz = $data + 172800;// то +2 дня до вторника
                $date_zakaz = self::if_holiday($date_zakaz);// снова проверяем вдруг праздник
                return $date_zakaz;
            } else {
                $date_zakaz = $data + 86400;// то +1 - след день
                $date_zakaz = self::if_holiday($date_zakaz);// снова проверяем вдруг праздник
                return $date_zakaz;
            }
        } else { // если не праздник то возвращаем исходную дату
            return $data;
        }
    }

    protected function printData($data) // вывод даты в формате 12декабря 2017
    {
        $date_zakaz = date('d ' . $this->months_name[date('n')] . ' Y', $data);
        return $date_zakaz;
    }

    public function zakaz($data)// формирование сообщения о доставке заказа
    {
        $date_zakaz1 = self::if_time($data); // проверяем сначала по времени
        $date_zakaz2 = self::check_day($date_zakaz1); // затем день
        $date_zakaz3 = self::if_holiday($date_zakaz2); // проверяем на праздник
        $date_zakaz = self::printData($date_zakaz3); // форматируем дату
        return 'Заявка поступила: ' . $data . ' доставка будет: ' . $date_zakaz;
    }


}

$d = new myDate;
$data = '29-11-2017 12:38:33'; // получили дату
$d->holidays[] = '30-11-2017'; //дописали праздник
$d->holidays[] = '01-12-2017';// еще дописали праздник
echo $d->zakaz($data);