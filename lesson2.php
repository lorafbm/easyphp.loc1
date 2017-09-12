<?php
error_reporting(-1);
function wtf($array, $stop = false)
{ // вывод массива
    echo '<pre>' . print_r($array, 1) . '</pre>';
    if (!$stop) {
        exit();
    }
}

$mass = array('black', 'white', 'red', 'blue');
//var_dump($mass);

//echo '<br>'.$mass[0];
$lesson = array();
$leson[] = 'asus';
$leson[] = 'lenono';
$leson[] = 'accer';
$leson[1] = 'apple';
$leson[] = 'hp';
//var_dump ($leson);
//wtf($mass);

$best = array('girl' => 'Vlada', 'boy' => 'Victor', 'man' => 'Peter');
//echo $best['boy'];
//var_dump($best);

$house = array();
$house['kv1'];
$house['kv2'];
$house['kv3'];

$house['kv1'][] = 'boy';
$house['kv1'][] = 'father';
$house['kv1'][] = 'mother';
//$house['kv1']=array('boy','mother','father');

$house['kv2'][] = 'girl';
$house['kv1'][] = 'grandfather';

$house['kv3']['room1'][] = 'girl';
$house['kv3']['room1'][] = 'boy';
$house['kv3']['room2'][] = 'cat';
$house['kv3']['room2'][] = 'dog';
//wtf($house);
//echo $house['kv1'][1];
//echo $house['kv2'][0].'<br>';
//echo $house['kv3']['room1'][1].'<br>';
//echo $house['kv3']['room2'][1].'<br>';

/*

  = присвоение
== равно
=== логическое равенство
> >= больше больше равно
< <= меньше меньше равно
&& и
|| или
!= не равно
!== логическое не равно



  */
$a = 45;
$b = 45;
/*if ($a >= $b) {
    echo 'a>=b';
} else {
    echo 'a<b';
}*/

/*if ($a > $b) {
    echo 'a>b';
} elseif ($a == $b) {
    echo 'a==b';
} else {
    echo 'a<b';
}*/

$a=5;
$b=4;
$c=88;
if($a>$b || $a<$c){
    echo 'yes';
}

