<?php
session_start();
// Подключаем код для сохранения информации о странице в сессии
include('./savepage.php');
?>
<!DOCTYPE html>

<html>
<head>
    <title>Страница 1</title>
</head>
<body>

<h1>Страница 1</h1>

<?php

include('./nav.php');


?>

</body>
</html>