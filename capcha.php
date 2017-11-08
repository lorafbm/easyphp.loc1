<?php
session_start();
//$_SESSION['captcha']='';

$capletters = 'ABCDEFGKJKLMNPQRSTUVWXYZ123456789';

// Длина капчи 7 знаков
$captlen = rand(2,6);

// Устанавливаем размеры изображения
$capwidth = 200; $capheight = 44;

// Размер нашего текста
$capfontsize = 30;

// Переопределяем HTTP заголовок, чтобы контент нашего
// скрипта представлял собой не текст, а изображение
header('Content-type: image/png');

// Формируется изображение с указанными ранее размерами
$capim = imagecreatetruecolor($capwidth, $capheight);

// Устанавливаем необходимость применения альфа канала (прозрачности)
imagesavealpha($capim, true);

// Устанавливаем цвет фона, в нашем случае - прозрачный
$capbg = imagecolorallocatealpha($capim, 255, 255, 255, 127);

// Устанавливаем цвет фона изображения
imagefill($capim, 0, 0, $capbg);

// Задаем начальное значение капчи
$capcha = '';

for ($i = 0; $i < $captlen; $i++){
    // Из нашего списка берем «рендомный» символ и добавляем в капчу
    $capcha .= $capletters[rand(0, strlen($capletters)-1) ];
    // Вычисление положения символа по X оси
    $x = ($capwidth - 20) / $captlen * $i + 10;
    // Добавим «рендомности» в это положение.
    $x = rand($x, $x+5);
    // Находим положение по Y оси
    $y = $capheight - ( ($capheight - $capfontsize) / 2 );
    // Укажем случайный цвет для символа.
    $capcolor = imagecolorallocate($capim, rand(0, 100), rand(0, 100), rand(0, 100) );
    // Наклон для символа
    $capangle = rand(-25, 25);
    // Рисуем созданный символ, применяя все описанные параметры
    imagettftext($capim, $capfontsize, $capangle, $x, $y, $capcolor, './fonts/arial-webfont.ttf', $capcha[$i]);

}

// Создаем переменную, куда будет сохранена капча,
// с ней будет сравниваться введенный пользователем текст

if(isset($_GET['key'])) {
    $_SESSION['captcha'.$_GET['key'].(isset($_GET['b']) ? 'b' : 'a')] = $capcha;
} else {
    $_SESSION['captcha'] = $capcha;
}

imagejpeg($capim); // Выводим картинку.
imagedestroy($capim); // Очищаем память.
exit;
