<?php
session_start();
//error_reporting(-1);
//echo 'занятие №10.GET. COOKIE. <br><br>';

//$a =123;
//setcookie('name',$a,time()+10);
//echo $_COOKIE['name'].'<br>';
if(empty($_GET['page'])){
    echo 'Home page';
}elseif (($_GET['page']) == 'contact'){
    echo 'Contact page';
}elseif ($_GET['page'] == 'help'){
    echo 'help page';
}




