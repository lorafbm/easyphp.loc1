<?php
require_once "data.php";
foreach ($publications as $item){
    echo '<br>'.$item->printItem().'<hr>';
}