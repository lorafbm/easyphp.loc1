<?php
error_reporting(-1);
ini_set('display_errors', 1);
header('Content type: text/html; charset=utf-8');
session_start();


/*$books = array(
    "book1" => array("id" => "1", "title" => "о природе", "category" => "научные", "author" => array("пушкин", "лермонтов", "шевченко")),
    "book2" => array("id" => "2", "title" => "о погоде", "category" => "исторические", "author" => array("пушкин")),
    "book3" => array("id" => "3", "title" => "о жизни", "category" => "фантастика", "author" => array("лермонтов", "шевченко"))
);

$book = array(
    "1" => array("img" => 'картинка',
        "category" => 'научные',
        "title" => 'о природе',
        "author" => array("пушкин",
            "лермонтов",
            "шевченко"),
        "description" => 'описание книги'),
    "2" => array("img" => 'картинка',
        "title" => 'о жизни',
        "author" => array("лермонтов",
            "шевченко"),
        "description" => 'описание книги'),
    "3" => array("img" => 'картинка',
        "category" => 'исторческие',
        "title" => 'о погоде',
        "author" => array("пушкин",
            "лермонтов"),
        "description" => 'описание книги')
);
[01.02.2017 2:14:01] Станислав php: напиши мне 15 примеров кода с нуля, где ты подставляешь ключи из переменных и их изначения, и опиши как и что у тебя подставилось
[01.02.2017 2:15:02] Станислав php: еще 15 примеров для многомнргых массивов , подставляя в нескольких случаях первый ключ, в нескольких второй ключ
[01.02.2017 2:15:41] Станислав php: еще 15 примеров как ты подставляешь ключ лесенкой:
$row[$a[$b[$c[$d]]]]
[01.02.2017 2:16:25] Станислав php: это пример лесенки. 3-4-5 переменных участующих в лесенке, и опиши какая переменная в итоге создаётся с каким значением, чтобы мне было максимально понятно!
[01.02.2017 2:16:31] Станислав php: Итого 45 !!!! примеров.
ВО, и ещё, 15 примеров с разными операциями, допустим вариант 1 конкатенацию делаешь с вариантом 2, или плюсуешь между собой.
Итого получили 60 примеров!


echo 'Это образец.Я создал $books[1] (массив $books с элементом массива, у которого ключ равен 1, а значение -  $row';
$row['id_book'] = 1;
$books[$row['id_book']] = $row;
echo '<pre>' . print_r($books, 1) . '</pre>';*/

echo 'Задание№1<br>';
echo '1.1 Я создала $goods[1] - это массив $goods с элементом ключ= 1  значение =  $row <br>';
$row['name'] = 1;
$goods[$row['name']] = $row;
echo $goods[1]['name'] . '<br>';//1
echo '<pre>' . print_r($goods, 1) . '</pre>';


echo '1.2 Создала массив $cat c элементом ключ=5 значение =пылесосы <br>';
$str['пылесосы'] = 5;
$cat[$str['пылесосы']] = $str;
echo $cat[5]['пылесосы'] . '<br>';//5
echo '<pre>' . print_r($cat, 1) . '</pre>';

echo '1.3 Создала массив $items c элементом ключ=image значение =img <br>';
$res['img'] = 'image';
$items[$res['img']] = $res;
echo $items['image']['img'] . '<br>';//image
echo '<pre>' . print_r($items, 1) . '</pre>';


echo '1.4 Создала массив $book c элементом ключ=4 значение =$row1 <br>';
$row1['item'] = '4';
$book[$row1['item']] = $row1;
echo $book[4]['item'] . '<br>';//4
echo '<pre>' . print_r($book, 1) . '</pre>';

echo '1.5 Создала массив $cats c элементом ключ=2 значение =$row2 <br>';
$row2['cat'] = 2;
$cats[$row2['cat']] = $row2;
echo $cats[2]['cat'] . '<br>';//2
echo '<pre>' . print_r($cats, 1) . '</pre>';


echo '1.6 Создала массив $books1 c элементом ключ=1 значение =$authname<br>';
$authname['id'] = 1;
$books1[$authname['id']] = $authname;
echo $books1[1]['id'] . '<br>';//1
echo '<pre>' . print_r($books1, 1) . '</pre>';

echo '1.7 Создала массив $books2 c элементом ключ=1 значение =$authname1<br>';
$authname1['author'] = 1;
$books2[$authname1['author']] = $authname1;
echo $books2[1]['author'] . '<br>';//1
echo '<pre>' . print_r($books2, 1) . '</pre>';


echo ' 1.8 Я создала  массив $boo  ключ которого равен 1 а значение $r<br>';
$r['id_book'] = 1;
$boo[$r['id_book']] = $r;
echo $boo[1]['id_book'] . '<br>';//1
echo '<pre>' . print_r($boo, 1) . '</pre>';


echo ' 1.9 Я создала  массив $kniga  ключ которого равен \'конь в пальто\' а значение $row4<br>';
$row4['title'] = 'конь в пальто';
$kniga[$row4['title']] = $row4;
echo $kniga['конь в пальто']['title'] . '<br>';//конь в пальто
echo '<pre>' . print_r($kniga, 1) . '</pre>';


echo '1.10 Я создала массив $g с элементом ключ которого = 1, а значение =  $row6 <br>';
$row6['idd'] = 1;
$g[$row6['idd']] = $row6;
echo $g[1]['idd'] . '<br>';//1
echo '<pre>' . print_r($g, 1) . '</pre>';

echo '1.11 Я создала массив $list с элементом ключ которого = \'text\', а значение =  $news <br>';
$news['description'] = 'text';
$list[$news['description']] = $news;
echo $list['text']['description'] . '<br>';//text
echo '<pre>' . print_r($list, 1) . '</pre>';


echo '1.12 Я создала массив $listcom с элементом ключ которого = 1, а значение =  $comments <br>';
$comments['id'] = 1;
$listcom[$comments['id']] = $comments;
echo $listcom[1]['id'] . '<br>';//1
echo '<pre>' . print_r($listcom, 1) . '</pre>';


echo '1.13 Я создала массив $tovar с элементом ключ которого = 15, а значение =  $tov <br>';
$tov['id'] = 15;
$tovar[$tov['id']] = $tov;
echo $tovar[15]['id'] . '<br>';//15
echo '<pre>' . print_r($tovar, 1) . '</pre>';


echo '1.14 Я создала массив $good с элементом ключ которого = \'white\', а значение =  $plitka <br>';
$plitka['color'] = 'white';
$good[$plitka['color']] = $plitka;
echo $good['white']['color'] . '<br>';//white
echo '<pre>' . print_r($good, 1) . '</pre>';


echo '1.15 Я создала массив $vazon с элементом ключ которого = 20, а значение =  $vas <br>';
$vas['size'] = '20';
$vazon[$vas['size']] = $vas;
echo $vazon['20']['size'] . '<br>';//20
echo '<pre>' . print_r($vazon, 1) . '</pre>';

echo '<hr>';


echo 'Задание№2(многомерные массивы)<br>';
echo '2.1 Я создала многомерный массив $b с ключами 1 и 2 и значениями $row и $row1<br>';
$row['id_book'] = 1;
$row1['id_book'] = 2;
$b[$row['id_book']] = $row;
$b[$row1['id_book']] = $row1;
echo $b[$row1['id_book']]['id_book'] . '<br>';//2
echo '<pre>' . print_r($b, 1) . '</pre>';

echo '2.2 Я создала многомерный массив $bo с ключами 1 и 2 и значениями $ro и $ro1<br>';
$ro['id'] = 1;
$ro1['id'] = 2;
$bo[$ro['id']] = $ro;
$bo[$ro1['id']] = $ro1;
echo $bo[$ro['id']]['id'] . '<br>';//1
echo '<pre>' . print_r($bo, 1) . '</pre>';

echo '2.3 Я создала многомерный массив $news с ключами 1 и 2 и значениями $r и $r1<br>';
$r['id'] = 1;
$r1['id'] = 2;
$r['title'] = 'куку';
$r1['title'] = 'хаха';
$news[$r['id']] = $r;
$news[$r1['id']] = $r1;
echo $news[$r1['id']]['id'] . '<br>';//2
echo '<pre>' . print_r($news, 1) . '</pre>';


echo '2.4 Я создала многомерный массив $item с ключами \'насосы\' и \'краны\' и значениями $row11 и $row111<br>';
$row11['cat'] = 'насосы';
$row111['cat'] = 'краны';
$row11['color'] = 'белый';
$row111['color'] = 'черный';
$item[$row11['cat']] = $row11;
$item[$row111['cat']] = $row111;
echo $item[$row11['cat']]['color'] . '<br>';//белый
echo '<pre>' . print_r($item, 1) . '</pre>';

echo '2.5 Я создала многомерный массив $goods с ключами 1 и 2 и значениями $ro1 и $ro11<br>';
$ro1['id'] = 1;
$ro11['id'] = 2;
$goods[$ro1['id']] = $ro1;
$goods[$ro11['id']] = $ro11;
echo $goods[$ro11['id']]['id'] . '<br>';//2
echo '<pre>' . print_r($goods, 1) . '</pre>';


echo ' 2.6 Я создала  массив (в массиве $boooks  ключ которого равен 2 а значение $rrow) элемент ключ которого = author а значение $rrow[author]<br>';
$rrow['id_book'] = 2;
$boooks[$rrow['id_book']]['author'] = array('вася', 'петя');
echo $boooks[$rrow['id_book']]['author'][0] . '<br>';//вася
echo '<pre>' . print_r($boooks, 1) . '</pre>';


echo ' 2.7 Я создала  массив (в массиве $bookss  ключ которого равен 1 а значение $row3) элемент ключ которого = author а значение 1,2<br>';
$row3['id_book'] = 1;
$bookss[$row3['id_book']]['author'] = array(1, 2);
echo $bookss[$row3['id_book']]['author'][0] . '<br>';//1
echo '<pre>' . print_r($bookss, 1) . '</pre>';


echo ' 2.8 Я создала  массив $kni  ключ которого равен 1 а значение $row5  и в нем массив с ключом data и значением $row5[data]  и в нем элемент с ключом title и значением конь без пальто и элемент id и значение пять <br>';
$row5['id_b'] = 1;
$kni[$row5['id_b']]['data'] = array('title' => 'конь без пальто', 'id' => 'пять');
echo $kni[$row5['id_b']]['data']['id'] . '<br>';//пять
echo '<pre>' . print_r($kni, 1) . '</pre>';

echo ' 2.9 Я создала  массив  $vazon  ключ которого равен 1 а значение $row и в нем массив  ключ которого  = color а значение $row[\'color\'] и в нем 2 элемента с ключами 0 и 1 и значениями черный и белый<br>';
$row['id'] = 1;
$vazon[$row['id']]['color'] = array('белый', 'черный');
echo $vazon[$row['id']]['color'][1] . '<br>';//черный
echo '<pre>' . print_r($vazon, 1) . '</pre>';


echo ' 2.10 Я создала  массив $good с элементами массива  ключи которых равны 1и 2 а значение $row[comment]  <br>';
$row['id'] = 1;
$row1['id'] = 2;
$good[1]['comment'] = 5;
$good[2]['comment'] = 10;
echo $good[$row['id']]['comment'] . '<br>';//5
echo $good[$row1['id']]['comment'] . '<br>';//10
echo '<pre>' . print_r($good, 1) . '</pre>';

echo ' 2.11 Я создала  массив $g  с ключами  1 и 2 и значениями $row и в нем массивы с ключами [quantity]  и [color] и значениями 1,2 и белый,черный, <br>';
$row['id'] = 1;
$row1['id'] = 2;
$g[1]['quantity'] = 16;
$g[1]['color'] = 'белый';
$g[2]['quantity'] = 86;
$g[2]['color'] = 'черный';
echo $g[$row['id']]['color'] . '<br>';//белый
echo '<pre>' . print_r($g, 1) . '</pre>';

echo ' 2.12 Я создала  массив $g  с ключами  1 и 2 и значениями $row и в нем массивы с ключами [quantity]  и [color] значениями 16,86 и белый, черный.<br>';
$row['id'] = 1;
$row1['id'] = 2;
$g[1]['quantity'] = 16;
$g[1]['color'] = 'белый';
$g[2]['quantity'] = 86;
$g[2]['color'] = 'черный';
echo $g[$row['id']]['color'] . '<br>';//белый
echo '<pre>' . print_r($g, 1) . '</pre>';

echo ' 2.13 Я создала  массив $au с элементами массива  ключи которых равны 1и 2 а значение $rr и $rr1  <br>';
$rr['author'] = 1;
$rr1['author'] = 2;
$au[1] = $rr;
$au[2] = $rr1;
echo $au[$rr['author']]['author'] . '<br>';//1
echo '<pre>' . print_r($au, 1) . '</pre>';

echo ' 2.14 Я создала  массив $com с элементами массива  ключи которых равны 1и 2 а значение $rrr и $rrr1  <br>';
$rrr['comment'] = 1;
$rrr1['comment'] = 2;
$com[1] = $rrr;
$com[2] = $rrr1;
echo $com[$rrr1['comment']]['comment'] . '<br>';//2
echo '<pre>' . print_r($com, 1) . '</pre>';

echo ' 2.15 Я создала  массив $mas с элементами массива  ключи которых равны 1и 2 а значение $str и $str1  <br>';
$str['id'] = 1;
$str1['id'] = 2;
$mas[1] = $str;
$mas[2] = $str1;
echo $mas[$str['id']]['id'] . '<br>';//1
echo '<pre>' . print_r($mas, 1) . '</pre>';
echo '<hr>';

echo 'Задание№3 15 примеров как ты подставляешь ключ лесенкой:$row[$a[$b[$c[$d]]]]<br>';
echo ' 3.1 <br>';
$d = 'вася';//создается переменная $d со значением вася.
$c['вася'] = 'петя';//создается переменная $c['вася'] со значением петя
$b['петя'] = 'вова';//создается переменная $b['петя'] со значением вова
$a['вова'] = 'витя';//создается переменная $а['вова'] со значением витя
$row['витя'] = 1;//создается переменная $row['витя'] со значением 1
echo $row[$a[$b[$c[$d]]]] . '<br>';//1

echo ' 3.2 <br>';
$var1 = 1;//создается переменная $d со значением 1.
$var2[1] = 2;//создается переменная $var2[1] со значением 2
$var3[2] = 3;//создается переменная $var3[2] со значением 3
$var4[3] = 4;//создается переменная $var4[3] со значением 4
$row5[4] = 'скоро дойдем  до конца!';//создается переменная $row5[4] со значением 'скоро дойдем до конца!'
echo $row5[$var4[$var3[$var2[$var1]]]] . '<br>';//скоро дойдем до конца!

echo ' 3.3 <br>';
$var11 = 100;//создается переменная $var11 со значением 100.
$var22[100] = 22;//создается переменная $var22[100] со значением 22
$var33[22] = 31;//создается переменная $var33[22] со значением 31
$var44[31] = 48;//создается переменная $var44[31] со значением 48
$row48[48] = 'ok!';//создается переменная $row48[48] со значением 'ok!'
echo $row48[$var44[$var33[$var22[$var11]]]] . '<br>';//ok!

echo ' 3.4 <br>';
$va = 547;//создается переменная $va со значением 547.
$va1[547] = 258;//создается переменная $va1[547] со значением 258
$va2[258] = 784;//создается переменная $va2[258] со значением 784
$va3[784] = 589;//создается переменная $va[784] со значением 589
$row589[589] = 'ok все ок!';//создается переменная $row589[589] со значением 'ok все ок!'
echo $row589[$va3[$va2[$va1[$va]]]] . '<br>';//ok все ок!


echo ' 3.5 <br>';
$v = 223;//создается переменная $v со значением 223.
$v1[223] = 325;//создается переменная $v1[223] со значением 325
$v2[325] = 787;//создается переменная $v2[325] со значением 787
$v3[787] = 745;//создается переменная $v3[787] со значением 745
$row569[745] = 'это 5 пример!';//создается переменная $row569[745] со значением 'это 5 пример!'
echo $row569[$v3[$v2[$v1[$v]]]] . '<br>';//это 5 пример!


echo ' 3.6 <br>';
$u = 273;//создается переменная $u со значением 273.
$u1[273] = 384;//создается переменная $u1[273] со значением 384
$ru[384] = 'это 6 пример!';//создается переменная $ru384[384] со значением 'это 6 пример!'
echo $ru[$u1[$u]] . '<br>';//это 6 пример!

echo ' 3.7 <br>';
$ul = 278;//создается переменная $ul со значением 278.
$ul1[278] = 784;//создается переменная $ul1[278] со значением 784
$r[784] = 'это 7 пример!';//создается переменная $r384[784] со значением 'это 7 пример!'
echo $r[$ul1[$ul]] . '<br>';//это 7 пример!

echo ' 3.8 <br>';
$y = 987;//создается переменная $y со значением 987.
$x[987] = 555;//создается переменная $x[987] со значением 555
$z[555] = 'это 8 пример!';//создается переменная $z[555] со значением 'это 8 пример!'
echo $z[$x[$y]] . '<br>';//это 8 пример!

echo ' 3.9 <br>';
$x1 = 'валя';//создается переменная $x со значением валя.
$y1['валя'] = 548;//создается переменная $y['валя'] со значением 548.
$z1[548] = 'это 9 пример!';//создается переменная $z1[548] со значением 'это 9 пример!'
echo $z1[$y1[$x1]] . '<br>';//это 9 пример!

echo ' 3.10 <br>';
$uu = 'оля';//создается переменная $uu со значением оля.
$uu1['оля'] = 'коля';//создается переменная $uu1['оля'] со значением коля
$uu2['коля'] = 'маша';//создается переменная $uu2['коля'] со значением маша
$uu3['маша'] = 'денис';//создается переменная $uu3['маша'] со значением денис
$uu4['денис'] = 'это 10 пример!фух!';//создается переменная $uu4['денис'] со значением 'это 10 пример! фух!'
echo $uu4[$uu3[$uu2[$uu1[$uu]]]] . '<br>';//это 10 пример! фух!

echo ' 3.11 <br>';
$zz = 45;//создается переменная $zz со значением 45.
$zz1[45] = 87;//создается переменная $zz1[45] со значением 87
$zz2[87] = 658;//создается переменная $zz2[87] со значением 658
$zz3[658] = 963;//создается переменная $zz3[658] со значением 963
$zz4[963] = 1028;//создается переменная $zz4[963] со значением 1028
$zz5[1028] = 'это 11 пример!';//создается переменная $zz5[1028] со значением 'это 11 пример!'
echo $zz5[$zz4[$zz3[$zz2[$zz1[$zz]]]]] . '<br>';//это 11 пример!


echo ' 3.12 <br>';
$tt = 78;//создается переменная $tt со значением 78.
$tt1[78] = 77;//создается переменная $tt1[78] со значением 77
$tt2[77] = 68;//создается переменная $tt2[77] со значением 68
$tt3[68] = 1023;//создается переменная $tt3[68] со значением 1023
$tt4[1023] = 458;//создается переменная $tt4[1023] со значением 458
$tt5[458] = 7896;//создается переменная $tt5[458] со значением 7896
$tt6[7896] = 'это 12 пример!';//создается переменная $tt6[7896] со значением 'это 12 пример!'
echo $tt6[$tt5[$tt4[$tt3[$tt2[$tt1[$tt]]]]]] . '<br>';//это 12 пример!

echo ' 3.13 <br>';
$e = 52;//создается переменная $e со значением 52.
$e1[52] = 74;//создается переменная $e1[52] со значением 74
$e2[74] = 78;//создается переменная $e2[74] со значением 78
$e3[78] = 523;//создается переменная $e3[78] со значением 523
$e4[523] = 753;//создается переменная $e4[523] со значением 753
$e5[753] = 4563;//создается переменная $e5[753] со значением 4563
$e6[4563] = 754;//создается переменная $e6[4563] со значением 754
$e7[754] = 'это 13 пример!';//создается переменная $e7[754] со значением 'это 13 пример!'
echo $e7[$e6[$e5[$e4[$e3[$e2[$e1[$e]]]]]]] . '<br>';//это 13 пример!


echo ' 3.14 <br>';
$w = 753;//создается переменная $w со значением 753.
$w1[753] = 453;//создается переменная $w1[753] со значением 453
$w2[453] = 787;//создается переменная $w2[453] со значением 787
$w3[787] = 741;//создается переменная $w3[787] со значением 741
$w4[741] = 563;//создается переменная $w4[741] со значением 563
$w5[563] = 7456;//создается переменная $w5[563] со значением 7456
$w6[7456] = 4587;//создается переменная $w6[7456] со значением 4587
$w7[4587] = 7964;//создается переменная $w7[4587] со значением 7964
$w8[7964] = 'это 14 пример!';//создается переменная $w8[7964] со значением 'это 14 пример!'
echo $w8[$w7[$w6[$w5[$w4[$w3[$w2[$w1[$w]]]]]]]] . '<br>';//это 14 пример!


echo ' 3.15 <br>';
$q = 412;//создается переменная $q со значением 412.
$q1[412] = 365;//создается переменная $q1[412] со значением 365
$q2[365] = 398;//создается переменная $q2[365] со значением 398
$q3[398] = 541;//создается переменная $q3[398] со значением 541
$q4[541] = 325;//создается переменная $q4[541] со значением 325
$q5[325] = 587;//создается переменная $q5[325] со значением 587
$q6[587] = 589;//создается переменная $q6[587] со значением 589
$q7[589] = 693;//создается переменная $q7[589] со значением 693
$q8[693] = 7542;//создается переменная $q8[693] со значением 7542
$q9[7542] = 'это 15 пример!';//создается переменная $q9[7542] со значением 'это 15 пример!'
echo $q9[$q8[$q7[$q6[$q5[$q4[$q3[$q2[$q1[$q]]]]]]]]] . '<br>';//это 15 пример!


echo '<hr>';
echo 'Задание№4 15 примеров с разными операциями, допустим вариант 1 конкатенацию делаешь с вариантом 2, или плюсуешь между собой.<br>';

echo '4.1<br>';
$str['пылесосы'] = 5;
$cat[$str['пылесосы']] = $str;// создан массив $cat c элементом массива  ключ=5 значение =$str
$row['id_book'] = 1;
$b[$row['id_book']] = $row;// создан массив $b c элементом массива  ключ=1 значение =$row
echo $cat[$str['пылесосы']]['пылесосы'] . '+' . $b[$row['id_book']]['id_book'] . '<br>';//5+1

echo '4.2<br>';
$row['name'] = 1;
$goods[$row['name']] = $row;
$res['img'] = 'image';
$items[$res['img']] = $res;
echo $goods[$row['name']]['name'] . '+' . $items[$res['img']]['img'] . '<br>';//1+image

echo '4.3<br>';
$row1['item'] = '4';
$book[$row1['item']] = $row1;
$row2['cat'] = 2;
$cats[$row2['cat']] = $row2;
echo $book[$row1['item']]['item'] . '+' . $cats[$row2['cat']]['cat'] . '<br>';//4+2

echo '4.4<br>';
$authname['id'] = 1;
$books1[$authname['id']] = $authname;
$authname1['author'] = 1;
$books2[$authname1['author']] = $authname1;
echo $books1[$authname['id']]['id'] . 'и' . $books2[$authname1['author']]['author'] . '<br>';//1и1

echo '4.5<br>';
$r['id_book'] = 1;
$boo[$r['id_book']] = $r;
$row4['title'] = 'конь в пальто';
$kniga[$row4['title']] = $row4;
echo $boo[$r['id_book']]['id_book'] . ' и ' . $kniga[$row4['title']]['title'] . '<br>';//1и конь в пальто

echo '4.6<br>';
$row6['idd'] = 1;
$g[$row6['idd']] = $row6;
$news['description'] = 'text';
$list[$news['description']] = $news;
echo $g[$row6['idd']]['idd'] . ' и ' . $list[$news['description']]['description'] . '<br>';//1 и текст

echo '4.7<br>';
$comments['id'] = 1;
$listcom[$comments['id']] = $comments;
$tov['id'] = 15;
$tovar[$tov['id']] = $tov;
echo $listcom[$comments['id']]['id'] . ' и ' . $tovar[$tov['id']]['id'] . '<br>';//1 и 15

echo '4.8<br>';
$plitka['color'] = 'white';
$good[$plitka['color']] = $plitka;
$vas['size'] = '20';
$vazon[$vas['size']] = $vas;
echo $good[$plitka['color']]['color'] . ' + ' . $vazon[$vas['size']]['size'] . '<br>';//white + 20

echo '4.9<br>';
$row['id_book'] = 1;
$b[$row['id_book']] = $row;
$ro['id'] = 1;
$bo[$ro['id']] = $ro;
echo $b[$row['id_book']]['id_book'] . ' + ' . $bo[$ro['id']]['id'] . '<br>';//1 + 1

echo '4.10<br>';
$r['id'] = 1;
$news[$r['id']] = $r;
$row11['cat'] = 'насосы';
$item[$row11['cat']] = $row11;
echo $news[$r['id']]['id'] . ' + ' . $item[$row11['cat']]['cat'] . '<br>';//1 + насосы

echo '4.11<br>';
$ro1['id'] = 1;
$goods[$ro1['id']] = $ro1;
$rrow['id_book'] = 2;
$boooks[$rrow['id_book']]['author'] = array('вася', 'петя');
echo $goods[$ro1['id']]['id'] . '+' . $boooks[$rrow['id_book']]['author'][0] . '<br>';//1+вася

echo '4.12<br>';
$row3['id_book'] = 1;
$bookss[$row3['id_book']]['author'] = array(1, 2);
$row5['id_b'] = 1;
$kni[$row5['id_b']]['data'] = array('title' => 'конь без пальто', 'id' => 'пять');
echo $bookss[$row3['id_book']]['author'][0] . '+' . $kni[$row5['id_b']]['data']['id'] . '<br>';//1+пять


echo '4.13<br>';
$row['id'] = 1;
$vazon[$row['id']]['color'] = array('белый', 'черный');
$row1['id'] = 1;
$good[$row1['id']]['comment'] = 5;
echo $vazon[$row['id']]['color'][1] . '+' . $good[$row1['id']]['comment'] . '<br>';//черный+5

echo '4.14<br>';
$row['id'] = 1;
$g[$row['id']]['color'] = 'белый';
$row1['id'] = 2;
$g[$row1['id']]['color'] = 'черный';
echo $g[$row['id']]['color'] . '+' . $g[$row1['id']]['color'] . '<br>';//белый+черный


echo '4.15<br>';
$rr['author'] = 1;
$au[$rr['author']] = $rr;
$rrr1['comment'] = 2;
$com[$rrr1['comment']] = $rrr1;
echo $au[$rr['author']]['author'] . '+' . $com[$rrr1['comment']]['comment'] . '<br>';//1+2






