<?php
/*echo 'Занятие 25.Работа с базами.';
date_default_timezone_set('UTC'+2');*/
function wtf($array, $stop = false)
{
    echo '<pre>' . htmlspecialchars(print_r($array, 1)) . '</pre>';
    if (!$stop) {
        exit();
    }
}

Class MyDate
{

    public $today;
    public $weekday;
    public $month;

    function __construct($today, $weekday, $month)
    {
        $this->today = $today;
        $this->weekday = $this->week($weekday);
        $this->month = $this->month($month);
    }

    public function week($weekday) // день недели по русски
    {
        $weekdays = array('Воскресенье', 'Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота');

        foreach ($weekdays as $k => $v) {
            if ($k == $weekday) {
                $result = $v;
                return $result;
            }
        }
    }

    public function month($month) // месяц по русски
    {
        $months_name = array(1 => 'Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря');

        foreach ($months_name as $k => $v) {
            if ($k == $month) {
                $result = $v;
                return $result;
            }
        }
    }



    public function date_from_second($data)//сколько времени прошло в виде даты (принимает секунды)
    {
        if (!is_int($data)) {
            $data = strtotime($data);// привели к секундам если не секунды пришли
        }
        $y = floor($data / (12 * 30.436 * 24 * 60 * 60));//полных лет30,436
        $secInLastYear = $data - ($y * 12 * 30.436 * 24 * 60 * 60); //секунд в последнем году
        $m = floor($secInLastYear / (30.361 * 24 * 60 * 60)); //полных месяцев в последнем году
        $secInLastMonth = $secInLastYear - ($m * 30.361 * 24 * 60 * 60); //секунд в последнем месяце 30.361  30.436 везде
        $day = floor($secInLastMonth / (24 * 60 * 60));// полных дней в последнем месяце
        $secInLastDay = $secInLastMonth - ($day * 24 * 3600); //секунд в последнем дне
        $hours = floor($secInLastDay / 3600); // полных часов
        $secInLastHour = $secInLastDay - $hours * 3600; //секунд в последнем часе
        $min = floor($secInLastHour / 60); //полных минут
        $sec = floor($secInLastHour - $min * 60); //секунд
        $intervals['лет'] = $y;
        $intervals['месяцев'] = $m;
        $intervals['дней'] = $day;
        $intervals['часов'] = $hours;
        $intervals['минут'] = $min;
        $intervals['секунд'] = $sec;
        return $intervals;
    }


    public function date_dif($date1, $date2) // метод разница между датами
    {
        if (!is_int($date1)) {
            $date1 = strtotime($date1);// привели к секундам если не секунды пришли
        } elseif (!is_int($date2)) {
            $date2 = strtotime($date2);// привели к секундам если не секунды пришли
        }
        if ($date1 > $date2) {
            $result = $date1 - $date2;

        } else {
            $result = $date2 - $date1;
        }
        $result = $this->date_from_second($result);

        return $result;

    }

    public function printData($data) // вывод даты в формате 12декабря 2017 00 часов 00 минут 00 секунд -принимает формат 2017-12-31 00:00:00(или без времени) из бд
    {
        $array = explode('-', $data);
        $m = $array[1];
        $month = $this->month($m);
        $d = $array[2];
        $arr = explode(' ', $d);
        $d = $arr[0];// отсекли время от даты
        if (isset ($arr[1])) {
            $t = explode(':', $arr[1]);
            $h = $t[0];
            $m = $t[1];
            $s = $t[2];
        }
        $y = $array[0];

        return isset($arr[1]) ? $d . ' ' . $month . ' ' . $y . ' ' . $h . ' часов ' . $m . ' минут ' . $s . ' секунд' : $d . ' ' . $month . ' ' . $y;
    }

    /*мой вкус*/
    public function time_remains($data_in)//получилось - сколько времени до определенной даты  принимает дату в формате timestamp  '2017-12-10 00:00:00'
    {
        $data_end = strtotime($data_in);// привели к секундам

        $data = $data_end - time(); // дата из остатка времени
        $y = (floor($data / (12 * 30.436 * 24 * 60 * 60)));//полных лет
        $secInLastYear = $data - ($y * 12 * 30.436 * 24 * 60 * 60); //секунд в последнем году
        $m = (floor($secInLastYear / (30.361 * 24 * 60 * 60))); //полных месяцев в последнем году
        $secInLastMonth = $secInLastYear - ($m * 30.361 * 24 * 60 * 60); //секунд в последнем месяце 30.361  30.436 везде
        $day = (floor($secInLastMonth / (24 * 60 * 60)));// полных дней в последнем месяце
        $secInLastDay = $secInLastMonth - $day * 24 * 3600; //секунд в последнем дне
        $hours = (floor($secInLastDay / 3600)); // полных часов
        $secInLastHour = $secInLastDay - $hours * 3600; //секунд в последнем часе
        $min = (floor($secInLastHour / 60)); //полных минут
        $sec = floor($secInLastHour - $min * 60); //секунд
        $intervals['год'] = $y;
        $intervals['месяцев'] = $m;
        $intervals['дней'] = $day;
        $intervals['часов'] = $hours;
        $intervals['минут'] = $min;
        $intervals['секунд'] = $sec;

        foreach ($intervals as $k => $v) {             // не выводить пустые значения

            if ($v == 0 || $v < 0) { // не выводить если нет значения
                unset($intervals[$k]);
            } else {
                $result[] = $v . ' ' . $k;
            }

        }
        return implode(', ', $result);
    }

    function dateDiff($date1, $date2) // разница между датами работает без погрешности
    {

        $date1 = (!is_int($date1)) ? strtotime($date1) : $date1;
        $date2 = (!is_int($date2)) ? strtotime($date2) : $date2;


        if ($date1 > $date2) {
            return 'Дата 1 должна быть меньше даты 2';
        }

        $intervals = array('year', 'month', 'day', 'hour', 'minute', 'second');
        $result = array();


        foreach ($intervals as $interval) {
            //  ttime из date1 и interval
            $ttime = strtotime('+1 ' . $interval, $date1);
            //  echo '<br>'.$ttime.$interval.'<br>';

            $add = 1;
            $looped = 0;

            while ($date2 >= $ttime) {
                // новое temp time из data1  и interval
                $add++;
                $ttime = strtotime("+" . $add . " " . $interval, $date1);
                $looped++;
            }

            $date1 = strtotime("+" . $looped . " " . $interval, $date1);

            $result[$interval] = $looped;
            if ($result[$interval] == 0) { // не выводить если нет значения
                unset($result[$interval]);
            }
        }

        foreach ($result as $k => $v) { // заменили значения ключей на русские

            if (array_key_exists('year', $result)) {
                $result['лет'] = $result['year'];
                unset($result['year']);

            } elseif (array_key_exists('month', $result)) {
                $result['месяцев'] = $result['month'];
                unset($result['month']);

            } elseif (array_key_exists('day', $result)) {
                $result['дней'] = $result['day'];
                unset($result['day']);

            } elseif (array_key_exists('hour', $result)) {
                $result['часов'] = $result['hour'];
                unset($result['hour']);

            } elseif (array_key_exists('minute', $result)) {
                $result['минут'] = $result['minute'];
                unset($result['minute']);

            } elseif (array_key_exists('second', $result)) {
                $result['секунд'] = $result['second'];
                unset($result['second']);

            }
        }
        return $result;
    }






}
//date_default_timezone_set('Europe/Kiev');
/*проба пера*/
$d = new MyDate(9, 6, 12);

echo $d->today;
echo $d->month;
echo $d->weekday;
echo '<br>' . $d->printData('2017-06-11');


$dd = '01-12-1971';
$dd1 = strtotime('01-12-2027');


wtf($d->date_dif($dd, $dd1), 1);//погрешность(при 56 годах интервала) +1 день 9 часов 36мин 2сек

wtf($d->date_from_second(time()), 1);//нет погрешности



wtf($d->dateDiff($dd, $dd1), 1);// нет погрешности на любом интервале!


echo 'До получения вашего заказа осталось ' . $d->time_remains('31-01-2019');



