<?php

require_once 'classes.php';

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





