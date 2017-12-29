<?php
session_start();
require_once 'classes.php';

$_SESSION['result'] = array();
$_SESSION['error'] = array();

$a = new Form;
if (!empty ($_POST['submit'])) {

    $b = new valid_Data;
    $a->error = array();

    if (!$a->error['login'] = $b->val_field($_POST['login'], 1)) {
        if (!$a->error['login'] = $b->data_uniq('user_name', $_POST['login'])) {
            $flag_l = 1;
        }
    }
    if (!$a->error['password'] = $b->val_field($_POST['password'], 1)) {
        $flag_p = 1;
    }
    if (!$a->error['email'] = $b->val_Field($_POST['email'], 1, 1)) {
        if (!$a->error['email'] = $b->data_uniq('email', $_POST['email'])) {
            $flag_e = 1;
        }
    }
    if (!$a->error['address'] = $b->val_address($_POST['address'])) {
        $b->do_address($_POST['address']);
        $flag_a = 1;
    }
    if (!$a->error['capcha'] = $b->val_field($_POST['capcha'])) {
        if (strtoupper($_POST['capcha']) == strtoupper($_SESSION['captcha'])) {
            $_SESSION['captcha'] = strtoupper($_POST['capcha']);//записываем в сессию
            $flag_c = 1;
        } else {
            $_SESSION['error']['capcha'] = 'Не правильный код с картинки!';

        }
    }
}


if (!empty ($flag_l) && !empty($flag_p) && !empty($flag_e) && !empty($flag_c) && !empty($flag_a)) {

    $sql3 = q("INSERT INTO `user` SET
              `user_name`  ='" . $_POST['login'] . "',
              `password`   ='" . MyHash($_POST['password']) . "',
               `email`      ='" . $_POST['email'] . "',
               `hash`       ='" . MyHash($_POST['login'] . ":" . $_POST['email']) . "' ,
               `address`='" . $_POST['address'] . "'
                ");

// получаем id пользователя который зарегистрировался
    // $id = mysqli_insert_id(DB::_());
    $id = DB::_()->insert_id;

    /*при регистрации получаем адрес который ввел только что зарегистрировавшийся пользователь*/
    $res = q("SELECT `address` FROM `user` 
              WHERE `user_id`='" . $id . "'
         ");
    $row = $res->fetch_assoc();
    $name = $row['address'];
    /*создаем экземмляр класса Geo передаем ключ API GoogleMaps */
    $g = new Geo('AIzaSyAW_pF2dA6UtB-n0Pqb0AEFIPHQbN1ueNY');
    /*и вызывпем метод кот определит кординаты данного адреса*/
    /*если адрес определен то отформатированный адрес записываем в БД и координаты тоже записываем*/
    if ($result = $g->geocode($name)) {
        $res = q("UPDATE `user` SET
                 `lat`='" . $result['lat_coord'] . "',
                  `lng`='" . $result['lng_coord'] . "',
                  `address_form`='" . $result['loc'] . "'
                   WHERE `user_id`='" . $id . "'
                  ");
    }

    $_SESSION['result'] = 'Вы зарегистрированы!';
    header('Location: /map_marks/index.php');
    exit();
}

?>
<!DOCTYPE html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <title>Пример вывод данных из базы на карту Google при регистрации пользователя, используя XML</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
          integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=AIzaSyAW_pF2dA6UtB-n0Pqb0AEFIPHQbN1ueNY"
            type="text/javascript"></script>
    <script type="text/javascript">

        function load() {
            if (GBrowserIsCompatible()) {
                var map = new GMap2(document.getElementById("map"));
                map.addControl(new GSmallMapControl());
                map.addControl(new GMapTypeControl());
                map.setCenter(new GLatLng(49.9935, 36.2304), 11);

                GDownloadUrl("map.php", function (data) {
                    var xml = GXml.parse(data);
                    var markers = xml.documentElement.getElementsByTagName("marker");
                    for (var i = 0; i < markers.length; i++) {
                        var name = markers[i].getAttribute("name");
                        var address = markers[i].getAttribute("address");
                        var point = new GLatLng(parseFloat(markers[i].getAttribute("lat")),
                            parseFloat(markers[i].getAttribute("lng")));
                        var marker = createMarker(point, name, address);
                        map.addOverlay(marker);
                    }
                });
            }
        }

        function createMarker(point, name, address) {
            var marker = new GMarker(point);
            var html = "<b>" + name + "</b> <br/>" + address;
            GEvent.addListener(marker, 'click', function () {
                marker.openInfoWindowHtml(html);
            });
            return marker;
        }

    </script>
</head>
<body onload="load()" onunload="GUnload()">
<div class="container">
    <h4 class="text-center text-primary">Регистрация:</h4>
    <?php
    echo '<p class="text-primary">' . ($_SESSION['result'] ? $_SESSION['result'] : '') . '</p>';
    echo $a->startForm('post');
    echo $a->makeText('login', 'text', 'Имя от 2 до 15 символов', 'Логин');
    echo $a->makeText('password', 'password', 'Пароль от 5 до 10 символов', 'Пароль');
    echo $a->makeText('email', 'email', 'Email', 'Еmail');
    echo $a->makeText('address', 'text', 'Адрес: город улица дом номер без , и знаков препинания (от 7 до 30 символов)', 'Адрес');
    echo $a->makeText('capcha', 'text', 'введите код с картинки', 'Капча');
    if (!empty($_SESSION['error']['capcha']) && !empty($_POST['submit'])) {
        echo '<p class="text-danger">' . $_SESSION['error']['capcha'] . '</p>';
    } ?>
    <img src="/capcha.php" id="capcha" alt="capcha"><br>
    <?php echo '<input type="button" onclick="document.getElementById(\'capcha\').src=\'/capcha.php?id=\'+
            Math.round(Math.random()*9999)" value="Другой код" class=" btn btn-primary" style="margin-top: 10px; margin-bottom: 10px;"><br>';
    echo $a->endForm('submit', 'Отправить!');
    ?>
    <div id="map" style="width:100%; height: 600px; margin-top: 10px;"></div>
</div>
</body>
</html>