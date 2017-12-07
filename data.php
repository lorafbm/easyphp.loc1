<?php
require_once "classes.php";

$publications = array();
$con= mysqli_connect('localhost','root','','easyphp');
//var_dump($con);
$result = mysqli_query($con,"SELECT * FROM `publications`");
//$result = mysqli_query($con,"SELECT * FROM `films`");
//var_dump($result);
while ($row = mysqli_fetch_array($result)){
    $publications[]=new $row['type']($row);
}