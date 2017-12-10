<?php
session_start();
define('HOST','localhost');
define('USER','root');
define('PASSWORD','');
define('DATABASE','easyphp');
$connect = mysqli_connect(HOST,USER,PASSWORD,DATABASE);

$sql = "SELECT * FROM gotovo";//в двойных кавычках SELECT-достать *-всё FROM-из
$query = mysqli_query($connect, $sql);//отправляет строку $sql в БД, БД сам знает что сней сделать
//
while ($res[] = mysqli_fetch_assoc($query)){//в массив $res[] добавляется строки из БД пока они есть(true) 
	$users = $res;// чтоб небыло строки false
}

$kol_vo = mysqli_num_rows($query);//
?>

<form action = "<?php echo $_SERVER['PHP_SELF'];?>" method="get">
<?php
foreach ($users as $user) {
	$w=$user['gotovo_name'];
	echo $user['gotovo_name'].='='.$_GET[$w].' '.' <br/>';

}	
foreach ($users as $key=>$user) {
	echo $user['gotovo_chtoto'];

}
?>

<!--- выводит на экран
<input type="password" name="password" placeholder="password" value=""/><br>
<input type="text" name="name" placeholder="name" value=""/><br>
<textarea rows="10" cols="45" name="textarea" placeholder="textarea" value=""></textarea><br>
-->

<form action = "<?php echo $_SERVER['PHP_SELF'];?>" method="get">
	<input type="checkbox" name="mail" value="1"/>отправить на почту<br/>
	<input type="checkbox" name="save" value="2"/>записать<br/>
	<input type="checkbox" name="display" value="3"/>вывести на экран<br/>
<input type="submit" value="отправить" /><br>
</form>
<?php
foreach ($users as $user) {
		$w=$user[gotovo_name];
		$as.= $user[gotovo_name].': '.$_GET[$w].' ';
	}

if(!empty($_GET[mail])){
	echo 'Записно на почту'.' <br/>';
	$message = $as;
	$to = 'as@sa.ia';//$_GET[adress];
	$subject = 'тема сообщения';
	mail($to,$subject,$message);
}
if(!empty($_GET[save])){
	echo 'Записно в БД'.' <br/>'; 
	$sql2 = "INSERT INTO save SET save_text = '".$as."'";//добавить
	mysqli_query($connect,$sql2);
}
if(!empty($_GET[display])){
	echo 'display'.' <br/>';
	echo $as;
}
?>





