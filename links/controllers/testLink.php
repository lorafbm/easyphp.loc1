<?php
//show links from DB
$list = q("SELECT *
           FROM `urls`
           ORDER BY `id` DESC 
          ");


