<?php
error_reporting(-1);
//echo 'Hello World';
?>
<?php $name = 12;
$name2 = 10;
$s = $name + $name2;
'<br/>'; ?>
<?php $str = 'Hello'; ?>
<?php
$a = 16;
$b = '5';
//echo $a/$b;
//var_dump((int)$b);
//echo $a;
$str = 'Hello';
$str2 = 'World';
//echo $str.' '.$str2;
$i = 1;
//echo ++$i.'<br/>';

//echo $i++.'<br/>';

/*function checkqdays($month)
{
    $mass_right[1] = 31;
    $mass_right[2] = 28;
    $mass_right[3] = 31;
    $mass_right[4] = 30;
    $mass_right[5] = 31;
    $mass_right[6] = 30;
    $mass_right[7] = 31;
    $mass_right[8] = 31;
    $mass_right[9] = 30;
    $mass_right[10] = 30;
    $mass_right[11] = 30;
    $mass_right[12] = 31;

    foreach ($mass_right as $key => $value) {

        if ($key == $month) {
            return  $mass_right[$key];
        }
    }
}
 echo checkqdays(12);*/


/*замена слов в сообщении*/
function myReplace($needle, $replace, $haystack)
{
    if (is_array($needle)) {
        $mass = explode(' ', $haystack);
        foreach ($mass as $key => $value) {
            foreach ($needle as $k => $v) {
                $l = strlen($needle[$k]); // длина искомого
                $value1 = substr($value, 0, $l);//обрезаем  символы более длины искомого в каждои эл-те массива
                $value2 = substr($value, -$l);//обрезаем все до первого символа искомого в  каждом эл-те массива

                if ($value == $needle[$k]) {
                    $mass[$key] = $replace; // заменяем
                }elseif ($value1 == $needle[$k]) {
                    $mass[$key] = $replace . substr($value, $l); // заменяем и возвращаем символы после искомого
                } elseif ($value2 == $needle[$k]) {
                    $mass[$key] = substr($value, 0, -$l) . $replace; // заменяем и возвращаем символы до искомого
                }
            }
        }
        $newMass = implode(' ', $mass); // новая строка обратно из массива
        return $newMass;

    } else {
        $l = strlen($needle); // длина искомого

        $mass = explode(' ', $haystack); //сформировали массив из строки чтоб перебрать

        foreach ($mass as $key => $value) {                // будем перебирать и сравнивать

            $value1 = substr($value, 0, $l);//обрезаем  символы более длины искомого в каждои эл-те массива
            $value2 = substr($value, -$l);//обрезаем все до первого символа искомого в  каждом эл-те массива

            if ($value == $needle) {  // если равны
                $mass[$key] = $replace; // заменяем
            } elseif ($value1 == $needle) {
                $mass[$key] = $replace . substr($value, $l); // заменяем и возвращаем символы после искомого
            } elseif ($value2 == $needle) {
                $mass[$key] = substr($value, 0, -$l) . $replace; // заменяем и возвращаем символы до искомого
            }
        }
        $newMass = implode(' ', $mass); // новая строка обратно из массива
        return $newMass;
    }
}

//
$needle = array('черный', 'белый', 'красный');
//$needle = 'черный';
$replace = 'я';
$haystack = 'черный, и белый плащи';
//echo myReplace($needle, $replace, $haystack);


/*function translit($str) {
    $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
    $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya');
    return str_replace($rus, $lat, $str);

}
$a='мальчик';
 echo translit($a);*/
/*транслитерация*/
function translit($str) {
    $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
    $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya');
    //return str_replace($rus, $lat, $str);
   return myReplace($rus, $lat, $str);
}
$a='мальчик пппппп';
echo translit($a);
?>

