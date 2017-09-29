<?php
session_start();
error_reporting(-1);

?>
    <br><a href="/lesson7.php">К форме</a><br>


<?php
function wtf($array, $stop = false)
{ // вывод массива
    echo '<pre>' . print_r($array, 1) . '</pre>';
    if (!$stop) {
        exit();
    }
}
echo $_SESSION['a'];