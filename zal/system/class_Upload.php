<?php
class Upload{
    /*загрузка изображений*/
  public  function can_upload($file)
    {
        $can_upload = array();

        if ($file['name'] == '') {
            $error = 'Вы не выбрали файл.';
        }
        if ($file['size'] == 0) {// если размер файла 0, значит его не пропустили настройки сервера из-за того, что он слишком большой
            $error = 'Файл слишком большой.';
        }
        // разбиваем имя файла по точке и получаем массив
        $getExt = explode('.', $file['name']);
        // end возвращает значение последнего элемента или FALSE для пустого массива.
        $ext = strtolower(end($getExt));

        $types = array('jpg', 'png', 'gif', 'jpeg'); //массив допустимых расширений файлов длязанрузки

        if (!in_array($ext, $types)) {
            $error = 'Недопустимый тип файла, можно загружать только файлы с расширениями jpg, png, gif, jpeg!';
        }

        if (!isset($error)) { // формируем имя и записывем исходник в папку /uploaded
            $name = date('Ymd-His') . 'img' . rand(10000, 99999) . '.' . $ext;
            $url_name = './uploaded/' . $name;
            move_uploaded_file($file['tmp_name'], $url_name);
            $can_upload['file'] = $url_name;
            return $can_upload;
        } else {
            $can_upload['errors'] = $error;
            return $can_upload;
        }
    }

    /*ресайз изображения и сохраняем измененный файл в /photo*/
  public  function resize($image, $width, $height)
    {
        $infoimg = getimagesize($image);

        $getExt = explode('/', $infoimg['mime']);
        $ext = strtolower(end($getExt));

        $w_i = $infoimg[0];//исх ширина
        $h_i = $infoimg[1];//исх высота
        /*echo $w_i . 'это $w_i ширина<br>' . $h_i . 'это $h_i высота<br>';*/

        $types = array("gif", "jpeg", "png"); // Массив с допустимыми типами изображений
        if (!in_array($ext, $types)) {
            return 'Недопустимый формат файла.';
        } else {
            $func = 'imagecreatefrom' . $ext; // Получаем название функции, соответствующую типу, для создания изображения
            $img_i = $func($image); // Создаём шаблон для работы с исходным изображением
        }

        // Вычисление пропорций

        $ratio = $w_i / $h_i;

        if ($width / $height > $ratio) {
            $w = round($height * $ratio);
            $h = $height;
        } else {
            $h = round($width / $ratio);
            $w = $width;
        }

        $img = imagecreatetruecolor($w, $h); //Создаем полноцветное изображение

        if ($ext == 'png') {
            imagealphablending($img, false);//Отключаем режим сопряжения цветов
            imagesavealpha($img, true);//Включаем сохранение альфа канала
        } elseif ($ext == 'gif') {
            $transparent_source_index = imagecolortransparent($img_i);//Задаем прозрачный цвет
            if ($transparent_source_index !== -1) {//Проверяем наличие прозрачности
                $transparent_color = imagecolorsforindex($img_i, $transparent_source_index);
                //Добавляем цвет в палитру нового изображения, и устанавливаем его как прозрачный
                $transparent_destination_index = imagecolorallocate($img, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
                imagecolortransparent($img, $transparent_destination_index);
                imagefill($img, 0, 0, $transparent_destination_index);//На всякий случай заливаем фон этим цветом
            }
        }
        imagecopyresampled($img, $img_i, 0, 0, 0, 0, $w, $h, $w_i, $h_i); // Переносим изображение из исходного в выходное, масштабируя его Ресайз

        $name = '/photo/' . $w . 'x' . $h . 'img' . rand(10000, 99999) . '.' . $ext;

        if ($infoimg['mime'] == 'image/jpeg') {
            imagejpeg($img, '.' . $name, 100);
        } elseif ($infoimg['mime'] == 'image/png') {
            imagepng($img, '.' . $name);
        } elseif ($infoimg['mime'] == 'image/gif') {
            imagegif($img, '.' . $name);
        }
        imagedestroy($img);
        imagedestroy($img_i);
        return $name;
    }

}