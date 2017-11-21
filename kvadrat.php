<?php
//Устанавливаем тип содержимого
    header('content-type: image/png');

//Определяем размеры изображения

    $width = rand(20, 550);
    $height = $width;
    $image = imagecreate($width, $height);

//Выбираем цвет фона
    $red = imagecolorallocate($image, 255, 0, 0);

//Сохраняем файл в формате png и выводим его
    imagepng($image);

//Чистим использованную память
    imagedestroy($image);








