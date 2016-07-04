<?php

require('../lib/ganool.php');

// Create object
$ganool = new ganool();

// Return Array
if(!empty($_GET['url'])){
    $data = $ganool->grabGanool($_GET['url']);
}else{
    $data = array(
        "status" => "error"
    );
}

// Generate JSON
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
echo json_encode($data,JSON_PRETTY_PRINT);