<?php
error_reporting(-1);
echo 'занятие №4 Функции<br>';
$name = 'abc';
function hello($name)
{
    return 'Hello, ' . $name;
}

$name = 'Lora';
//echo hello($name);

function num($a, $b, $c = 23, $d = 0)
{
    if ($a > $b) {
        return 'a > b ' . $c;
    } elseif ($a == $b) {
        return 'a = b ' . $c;
    } else {
        return 'a < b ' . $c;
    }
}

//необ пар-ры передаются в конце!!!
//echo num(12,15,1188,11);
// return прерывает работу функции а echo нет !!
function umn($a, $b)
{
    return $a * $b;

}

function num2($int)
{
    if (is_int($int)) {
        if ($int == 0) {
            return '0';
        } elseif ($int % 2 == 0) {
            return 'Четное';
        }
        return 'Нечетное';
    } else{
        return false;
    }
}

echo num2(umn(1,2.5));

/*function table ($a,$b)
{
    $mass = array();

    for ($i = 1; $i < $a; $i++) {
        for ($j = 1; $j <= $b; $j++) {
            $mass[$i][$j] = $i * $j;
        }
    }

    echo '<p style="text-align: center; color: #265a88;">Домашнее задание к уроку №3. Таблица умножения.</p>';
    echo '<table border="2" bgcolor="#add8e6"  cellpadding="5px" align="center" style="border-collapse: collapse; border-color: #2b669a;">';
    foreach ($mass as $key1 => $value1) {
        echo '<tr>';
        foreach ($value1 as $key2 => $value2) {
            echo '<td>' . $key2 . ' * ' . $key1 . ' = ' . $value2 . '</td>';
        }
        echo '</tr>';
    }
    return '</table>';
}*/
//table (10,9);


//php.net   php.su

$a = 12.5;
if (is_int($a)) {
//    echo 'int';
}

if(is_numeric($a)){
  //  echo 'numeric';
}

//str = 'hello';
$str = ' мир привет мир';
$str2 = 'hello world';
$code = 'utf-8';
//echo strlen($str);
//echo mb_strlen($str2 , $code);
//echo substr($str,2,-1);

//echo mb_substr($str,3,mb_strlen($str,$code) -3,$code);

//echo str_replace('мир','world',$str);

// пример собств str repl
$stroka = 'hello abcde';
$mass = explode(' ', $stroka);
    foreach ($mass as $key =>$value){
        if ($value == 'abcde'){
        $mass[$key] = 'zzz';
        }
    }
    $stroka = implode(' ',$mass);
//echo $stroka;

$stroka = 'hello abcde';
$str = 'мир мир мир';
//echo $str[0].$str[1];

for ($i = 0; $i < strlen ($stroka); $i++) {
   // if (in_array($stroka[$i] . $stroka[$i + 1], $alfavit))
     //   echo $stroka[$i] . '<br>';


}
$mass = explode (' ',$stroka);





/*$aa = '';
$stroka = 'hello abcde qwerty, abcde';
$mass = explode(' ', $stroka);
var_dump($mass);
foreach ($mass as $key =>$value){
    if ($value == 'abcde'){
        $aa = $aa.' zzz';
    }else{
        $aa = $aa. ' '. $value;

    }
}

echo $aa;*/


// $value1 = substr($value, 0, -1);//обрезаем последний символ каждого эл-та массива
//$value2 = substr($value, 1);//обрезаем первый символ каждого эл-та массива
//echo substr($a, 0, -1) . '11<br>';//обрезаем посл символ
//echo substr($a, 1) . '22<br>';//обр первый символ
$a='*h*';

echo substr($a, 0,3) . '22<br>';//обр первый символ

/*$bb = '';
$needle = 'abcde';
$replace = 'zzz';
$stroka = 'hello abcde, abcde qwerty, ,abcde';
$mass = explode(' ', $stroka);
var_dump($mass);
foreach ($mass as $key =>$value){
    $l=strlen($needle); // длина искомого
    $value1=substr($value,0,$l);//обрезаем  символы более длины искомого в каждои эл-те массива

    $value2 = substr($value,-$l);//обрезаем все до первого символа искомого в  каждом эл-те массива

    if ($value == 'abcde' || $value == $value1 || $value == $value2){
        $bb = $bb.$replace;
    }else{
        $bb = $bb. ' '. $value;

    }
}
echo 'Было: '.$stroka.'<br>';
echo 'Стало: '.$bb;*/