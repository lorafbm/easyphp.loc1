<?php
session_start();
error_reporting(-1);
echo 'занятие №7. Алгоритмы.Сессии(SESSION)<br><br>';


$_SESSION['a'] = 6;
echo $_SESSION['a'];