<?php

$pages = explode("|", $_SESSION["pages"]);
if(is_array($pages)) {
    array_pop($pages);  //Извлекает последний элемент массива
}

foreach($pages as $page){
    echo '<p>'.$page.'</p>';
}
//var_dump($_SESSION);