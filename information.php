<?php

require 'vendor/autoload.php';
use IMDB\Movies\DeleteMovie as delete;
use IMDB\Movies\InsertMovie as insert;
use IMDB\Movies\UpdateMovie as update; 
use IMDB\Movies\ShowMovie as show;

use IMDB\Movies\SearchMovie as search;



// http://information.php?show=Peli Nom

$formats = [
    'delete' => $_GET['delete'],
    'update' => $_GET['update'], 
    'create' => $_GET['create'], // insert
    'show'   => $_GET['show']
];

arsort($formats);
$key = key($formats);
$name = current($formats);

switch ($key) {
    case 'delete':
        $delete = new delete();
        $delete->delete($name);
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
        /* En aquí, que redirigeixi a buscar una peli o totes, en funció del que digui la url, 
            o posa el nom de la pelicula o 'all' */
        $show = new show(); 
        echo "<pre>";
            is_null($name) ? $show->showAll() : $show->showFilm($name); 
        echo "</pre>";
        break;
    default:
        # code...
        break;
}