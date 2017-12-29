<?php

//$user_api_key = 'AIzaSyD_a_oYDOGFrk6wXQ_zWE8TWanwvPMDbq0'; //GOOGLE API KEY

/*при регистрации получаем адрес который ввел только что зарегистрировавшийся пользователь*/
/*$res = q("SELECT `address` FROM `user`
          WHERE `user_id`=68
         ");
$row=$res->fetch_assoc();
$name=$row['address'];
/*создаем экземмляр класса Geo передаем ключ API GoogleMaps
$g=new Geo('AIzaSyD_a_oYDOGFrk6wXQ_zWE8TWanwvPMDbq0');
/*и вызывпем метод кот определит кординаты данного адреса*/
/*если адрес определен то отформатированный адрес записываем в БД и координаты тоже записываем
if($result = $g->geocode($name)){
    $res = q("UPDATE `user` SET
            `lat`='" . $result['lat_coord'] . "',
            `lng`='" . $result['lng_coord'] . "',
            `address_form`='".$result['loc']."'
              WHERE `user_id`=68
              ");
}*/
//$g=new Geo('AIzaSyD_a_oYDOGFrk6wXQ_zWE8TWanwvPMDbq0');
function parseToXML($htmlStr)
{
    $xmlStr=str_replace('<','&lt;',$htmlStr);
    $xmlStr=str_replace('>','&gt;',$xmlStr);
    $xmlStr=str_replace('"','&quot;',$xmlStr);
    $xmlStr=str_replace("'",'&#39;',$xmlStr);
    $xmlStr=str_replace("&",'&amp;',$xmlStr);
    return $xmlStr;
}

$res = q("SELECT `address_form`,`lat`,`lng`,`user_name` FROM `user` 
        ");
header("Content-type: text/xml");


// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
while ($row = $res->fetch_assoc()){

    // Add to XML document node
    echo '<marker ';
    echo 'name="' . parseToXML($row['user_name']) . '" ';
    echo 'address="' . parseToXML($row['address_form']) . '" ';
    echo 'lat="' .$row['lat'] . '" ';
    echo 'lng="' .$row['lng'] . '" ';
    echo '/>';
}


// End XML file
echo '</markers>';


 /*function parseToXML($htmlStr)
{
    $xmlStr=str_replace('<','&lt;',$htmlStr);
    $xmlStr=str_replace('>','&gt;',$xmlStr);
    $xmlStr=str_replace('"','&quot;',$xmlStr);
    $xmlStr=str_replace("'",'&#39;',$xmlStr);
    $xmlStr=str_replace("&",'&amp;',$xmlStr);
    return $xmlStr;
}

$res = q("SELECT `address_form`,`lat`,`lng`,`user_name` FROM `user` 
        ");
//header("Content-type: text/xml");


// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
while ($row = $res->fetch_assoc()){

    // Add to XML document node
    echo '<marker ';
    echo 'name="' . parseToXML($row['user_name']) . '" ';
    echo 'address="' . parseToXML($row['address_form']) . '" ';
    echo 'lat="' .$row['lat'] . '" ';
    echo 'lng="' .$row['lng'] . '" ';
    echo '/>';
}


// End XML file
echo '</markers>';*/











//wtf($_SESSION,1);
//wtf($data1,1);
getView('home');
