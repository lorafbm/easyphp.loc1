<?php
$_SESSION['pages'][] = $_SERVER['PHP_SELF'];
if(isset($_SESSION['pages'])) {
    echo '<h5>Список посещенных страниц:</h5>';

    foreach ($_SESSION['pages'] as $page) {
        echo '<p>'. $page. '</p>';
    }

}


var_dump($_SESSION);