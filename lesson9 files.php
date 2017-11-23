<?php
session_start();
error_reporting(-1);
echo 'занятие №9. Работа с файлами. COOKIE. <br><br>';

$file = fopen('a.txt','a+t');// создание файла

fwrite($file,"hello\nhello");//запись в файл
fclose($file);//закрыть файл
//var_dump($file);
/*$file = fopen('a.txt','r+t');
while (!feof($file)){ // true пока не конец файла
    echo fread($file,1).'<br>';
}
fseek($file,0);// переставить курсор в нуж позицию
echo fread($file,3).'<br>';//не выведет тк курсор уже в конце  выводит ell
echo fread($file,3); //lo
fclose($file);*/


/*file_put_contents('c.txt',"hello"); // откр-ся в негозапис и сам закр-ся
echo file_get_contents('c.txt'); // выводит файл на экран
echo file_exists('c.txt');// пров сущ-е файла
echo filesize('c.txt'); // выводит размер файла в бфйтах
rename('a.txt','b.txt'); // переименов файл если указатьдр путьтои место расп -е
unlink('a.txt'); // удаляет файл*/


$file1 = fopen('bbb.txt','a+t');
fwrite($file1,"hi how are you\n");
fclose($file1);

/*$file = fopen('bbb.txt','r+t');
while (!feof($file)){ // true пока не конец файла
    echo fread($file,1).'<br>';
}*/





?>


