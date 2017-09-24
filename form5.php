<?php
error_reporting(-1);

var_dump($_POST);
//var_dump($_GET);
?>
    <br><a href="/lesson5.php">К форме</a><br>


<?php
/*$a = $_POST['a'];
$b = $_POST['b'];
$c = $_POST['c'];


$p = ($a+$b+$c)/2;
$e = sqrt($p*($p-$a)*($p-$b)*($p-$c));


echo $e;*/

function treug($a, $b, $c)
{
    if (!empty($a) && is_numeric($a) && !empty($b) && is_numeric($b) && !empty($c) && is_numeric($c)) {
        $p = ($a + $b + $c) / 2;
        $e = sqrt($p * ($p - $a) * ($p - $b) * ($p - $c));
    } else {
        return 'error';
    }
    return $e;
}

echo treug($_POST['a'], $_POST['b'], $_POST['c']);