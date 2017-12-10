<?php
//session_start();
error_reporting(-1);
echo 'Занятие №23.Многие ко многим. <br><br>';


/*define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DATABASE', 'easyphp');*/
define('HOST', 'localhost');
define('USER', 'root');
define('PASSWORD', '');
define('DATABASE', 'main');

$connect = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
//var_dump($connect);
//$sq = "SELECT u.user_name, ui.phone FROM users u LEFT JOIN user_info ui ON (u.user_id=ui.id) ";
//$sq="SELECT * FROM users";
/*$sq="SELECT * FROM `films_actors` t1 LEFT JOIN `films2actors` t2
ON (t1.id=t2.id)
*/
/*выбратьфильмы где >2 актеров*/
$sq="SELECT `books`.*,GROUP_CONCAT(`books_auth`.`name`) as `authors`
FROM `books`
LEFT JOIN `books2books_auth` ON `books2books_auth`.`book_id` = `books`.`id`
LEFT JOIN `books_auth` ON `books_auth`.`id` = `books2books_auth`.`auth_id`
GROUP BY `books`.`id`
HAVING COUNT(*) > 2";
$qu = mysqli_query($connect, $sq);
while ($re[]=mysqli_fetch_assoc($qu)){
    $us=$re;
}
foreach ($us as $u){
    echo 'Книга: '.$u['title'].'- Авторы:'.$u['authors'].'<br>';
}

/*$sq="SELECT * FROM `films_actors` t1 LEFT JOIN `films2films_actors` t2
ON (t1.id=t2.id)*/
/*выборка фильмов где более 2 актеров*/

$sq="SELECT t1.`title`,GROUP_CONCAT(t3.`name`) as `actors`
      FROM `films`as t1
       LEFT JOIN `films2films_actors` as t2 ON t2.`film_id` = t1.`id`
        LEFT JOIN `films_actors` as t3 ON t3.`id` = t2.`actor_id` 
        GROUP BY t1.`id` 
        HAVING COUNT(*) > 2";
/*выборка актеров более чем в 2 фильмах*/

$sq1="SELECT t1.`name`,GROUP_CONCAT(t3.`title`) as `actors`
 FROM `films_actors` t1
  LEFT JOIN `films2films_actors` as t2 ON t2.`actor_id` = `t1`.`id` 
  LEFT JOIN `films` as t3 ON t3.`id` = t2.`film_id` 
  GROUP BY t1.`name` HAVING COUNT(*) > 2";


/*один ко многим все категории из новостей уникальные  * не работает*/
"SELECT `category` FROM `news` a
JOIN `news_cat` b ON b.`id` = a.`cat_id`
GROUP BY a.`category`";