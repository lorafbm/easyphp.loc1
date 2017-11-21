<?php

function wtf($array, $stop = false) {
    echo '<pre>'.htmlspecialchars(print_r($array,1)).'</pre>';
    if(!$stop) {
        exit();
    }
}


$filen=fopen("file.txt","r+");
$read=fread($filen,filesize("file.txt"));
//echo $read;

$arr = explode("," , $read);
//wtf($arr,1);
sort($arr, SORT_STRING); // отсортировали

//wtf($arr,1);

$newcontent=implode(" ,", $arr);
//echo $newcontent;
//fwrite($filen, $newcontent . PHP_EOL); // пишем в файл  если надо добавление
fclose($filen); // закрываем файл


