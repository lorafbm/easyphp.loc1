<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>квадраты</title>
</head>
<body style="background-color:#000000; ">

<?php
$q=rand(5,25);
for ($i = 0; $i < $q; $i++) { ?>
    <img src="kvadrat.php" width="<?php echo $w=rand(10,350) ?>" height="<?php echo $w;?>"
          style="margin: <?php echo rand(10,100); ?>px">
<?php }?>

</body>
</html>


