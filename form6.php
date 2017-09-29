<?php
error_reporting(-1);
//var_dump($_GET);
//var_dump($_POST);
//echo $_GET['w1']['q1'];

?>
    <br><a href="/lesson6.php">К форме</a><br>


<?php
function wtf($array, $stop = false)
{ // вывод массива
    echo '<pre>' . print_r($array, 1) . '</pre>';
    if (!$stop) {
        exit();
    }
}
wtf($_GET,1);
/*$mass = array();
$mass['q1'] = 2;
$mass['q2'] = 1;
$mass['q3'] = 3;
wtf($_POST,1);
wtf($mass,1);

$res = '';
$count = 0; // к во прав отв
$str = 'Вы правильно ответили на вопрос № ';
$str2 = 'Вы неправильно ответили на вопрос № ';*/
/*1способ*/
/*if (!empty($_POST['q1']) && $mass['q1'] == $_POST['q1']) {
    $count++;
    $res.= $str.'1<br>';
}else{
    $res.=$str2.'1<br>';
}
if (!empty($_POST['q2']) && $mass['q2'] == $_POST['q2']) {
    $count++;
    $res.= $str.'2<br>';
}else{
    $res.=$str2.'2<br>';
}
if (!empty($_POST['q3']) && $mass['q3'] == $_POST['q3']) {
    $count++;
    $res.= $str.'3<br>';
}else{
    $res.=$str2.'3<br>';
}

echo $res;*/
/*2способ*/
/*for($i=1; $i <= count($mass); $i++) {
    $q='q'.$i;
    if(!empty($_POST[$q])&& $mass[$q] == $_POST[$q]){
        $count++;
        $res.=$str.$i.'<br>';
    }else{
        $res.=$str2.$i.'<br>';
    }
}
echo $res .= 'Из '.count($mass).' вопросов вы правильно ответили на '.$count;*/

/*3способ*/
/*$count_q = 1; // номер вопроса начиная с 1
foreach ($mass as $key=>$value){
    if(!empty($_POST[$key]) && $_POST[$key] == $value){
        $count++;
        $res.=$str.$count_q.'<br>';
    }else{
        $res.=$str2.$count_q.'<br>';
    }
    $count_q++;
}



 echo $res .= 'Из '.count($mass).' вопросов вы правильно ответили на '.$count;*/





