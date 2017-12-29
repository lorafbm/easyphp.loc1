<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<html lang="ru">
<head>
    <meta http-equiv="content-type" content="text/html,text/xml; charset=utf-8"/>

    <!--<link rel="dns-prefetch" href="https://.loc">-->
    <title>Метки</title>

    <meta name="author" content="Larisa Kirko">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--    <script src="../vendor/public/jquery/dist/jquery.js"></script>-->
    <!--    <script src="/vendor/public/fancybox/dist/jquery.fancybox.js"></script>-->
    <!--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">-->
    <link rel="stylesheet" href="/node_modules/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="/views/styles/styles.css">

<!--    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAhfJ3JM1-KqSLfxit7kPhWmoAtQJmb4Ro"></script>-->
    <script src="http://maps.google.com/maps?file=api&amp;v=2&amp;key=AIzaSyAW_pF2dA6UtB-n0Pqb0AEFIPHQbN1ueNY"
            type="text/javascript"></script>
    <script type="text/javascript">
        //<![CDATA[

       function load() {
            if (GBrowserIsCompatible()) {
                var map = new GMap2(document.getElementById("map"));
                map.addControl(new GSmallMapControl());
                map.addControl(new GMapTypeControl());
                map.setCenter(new GLatLng(49.9286585, 36.2555004), 11);

                GDownloadUrl("/index.php", function(data) {
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
            GEvent.addListener(marker, 'click', function() {
                marker.openInfoWindowHtml(html);
            });
            return marker;
        }
        //]]>
    </script>


</head>

<body onload="load()" onunload="GUnload()">
<main>
    <header>
        <div class="container">
            <nav class="breadcrumb">
                <a class="breadcrumb-item" href="/">Главная</a>
                <?php if (!isset($_SESSION['user'])) { ?>
                    <a class="breadcrumb-item" href="/index.php?route=auth">Войти</a>
                <?php } else { ?>
                    <a class="breadcrumb-item" href="/index.php?route=exit">Выход</a>
                <?php } ?>
            </nav>
        </div>
    </header>

