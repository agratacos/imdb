<?php

require 'vendor/autoload.php';
use IMDB\Movies\DeleteMovie as delete;
use IMDB\Movies\InsertMovie as insert;
use IMDB\Movies\UpdateMovie as update; 
use IMDB\Movies\ShowMovie as show;


// http://information.php?delete=5

$formats = [
    'delete' => $_GET['delete'],
    'update' => $_GET['update'], 
    'create' => $_GET['create'], // insert
    'show'   => $_GET['show']
];

arsort($formats);
$key = key($formats);
$number = current($formats);

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
        echo "<pre>"; // Treure-ho
            $show->show($number);
        echo "</pre>"; // Treure-ho
        break;
    default:
        # code...
        break;
}