<?php
/*выборка категорий для вывода*/
$sql = "SELECT *
         FROM `category`
          WHERE `category_id`=" . (int)$_GET['id'] . "
         ";
$res = mysqli_query($connect, $sql);

while ($row = mysqli_fetch_assoc($res)) {
    $data['category_info'][] = $row;  // формируем массив для передачи

}
//Редактирование
if (isset($_POST['edit_name'],$_POST['edit_catdesc'],$_POST['edit'])) {

    if (!empty($_POST['edit_name']) && !empty($_POST['edit_catdesc'])) {
        q("
            UPDATE `category` SET
            `category_name`        = '" . ($_POST['edit_name']) . "',
            `category_description` = '" . ($_POST['edit_catdesc']) . "',
            `title`                = '" . ($_POST['edit_title']) . "'
              WHERE `category_id`=" . (int)$_GET['id'] . "
        ");

        $_SESSION['info_cat'] = 'Категория успешно отредактирована!';
        header("Location: /index.php?route=admin&page=a_categories");
        exit();
    } else {
        $_SESSION['info_cat'] = 'Заполните обязательные поля!';
    }
    if (isset($_POST['edit_name'],$_POST['edit_catdesc'], $_POST['submit'])) {
        $key['category_name'] = $_POST['edit_name'];
        $key['category_description'] = $_POST['edit_catdesc'];

    }
}

$data['title'] = ' Админ «ОБСновости» | Категории - Редактировать';

getHeader_a($data);
getView_a('edit_category', $data);
getFooter_a();