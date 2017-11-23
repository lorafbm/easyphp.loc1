<?php
/*добавление категории*/
$_SESSION['info_cat'] = '';
if (isset($_POST['submit'], $_POST['add_name'], $_POST['add_catdesc'])) {
    if (empty($_POST['add_name']) || empty($_POST['add_catdesc'])) {
        $_SESSION['info_cat'] = 'Заполните  обязательные поля формы!';
    } else {
        foreach ($_POST as $k => $v) {
            $_POST[$k] = trimAll($v);
        }

        // запрос в БД на проверку категории
        $sql3 = "SELECT `category_id`
                 FROM `category`
                   WHERE `category_name`= '" . mysqli_real_escape_string($connect,$_POST['add_name']) . "'
                    LIMIT 1
                 ";
        $query3 = mysqli_query($connect, $sql3);
        if (mysqli_num_rows($query3)) {
            $_SESSION['info_cat'] = 'Такая категория уже существует!';
            header("Location: /index.php?route=admin&page=a_categories");
            exit();
        }
        //вставляем данные в БД
        $sql4 = "INSERT INTO `category` SET
                      `category_name`        = '" . mysqli_real_escape_string($connect,$_POST['add_name']) . "',
                      `category_description` = '" . mysqli_real_escape_string($connect,$_POST['add_catdesc']) . "'
                       " . ((!empty($_POST['add_title'])) ? ",`title` = '" . mysqli_real_escape_string($connect,$_POST['add_title']) . "'" : "") . "
                      ";
        $query4 = mysqli_query($connect, $sql4);

        $_SESSION['info_cat'] = 'Категория успешно добавлена!';
        header("Location: /index.php?route=admin&page=a_categories");
        exit();
    }
    if (isset($_POST['submit'], $_POST['submit'])) {
        $key['category_name'] = $_POST['add_name'];
        $key['category_desc'] = $_POST['add_catdesc'];
    }

}

$data['title'] = ' Админ «ABCновости» | Категории - Добавить';

getHeader_a($data);
getView_a('add_category', $data);
getFooter_a();










$data['title'] =  ' Админ «ОБСновости» | Добавить категорию';

/*wtf($_FILES, 1);
wtf($_POST, 1);
wtf($temp,1);*/

getHeader_a($data);
getView_a('add_category');
getFooter_a();