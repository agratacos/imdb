<?php

require 'vendor/autoload.php';
use Movies\DeleteMovie as delete;
use Movies\InsertMovie as insert;
use Movies\UpdateMovie as update; 
use Movies\ShowMovie as show;


// http://information.php?delete=5

$formats = [
    'delete' => $_GET['delete'],
    'update' => $_GET['update'], 
    'create' => $_GET['create'], // insert
    'show'   => $_GET['show']
];

foreach ($formats as $type => $value) {
    if (!isset($formats[$type])) unset($formats[$type]);
    else {
        $key = $type;
        if (!empty($value)) $number = $value;
    }
}

switch ($key) {
    case 'delete':
        $delete = new delete();
        $delete->delete($number);
        break;
    case 'update':
        $update = new update();
        $update->update();
        break;
    case 'create':
        $insert = new insert();
        $insert->insert();
        break;
    case 'show':
        $show = new show();
        $show->show($number);
        break;
    default:
        # code...
        break;
}