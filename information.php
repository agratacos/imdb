<?php

$version = 'v2.1.1';

require 'vendor/autoload.php';
use IMDB\Movies\DeleteMovie as delete;
use IMDB\Movies\UpdateMovie as update;
use IMDB\Movies\InsertMovie as insert;
use IMDB\Movies\ShowMovie as show;

// http://information.php?show=Nom Peli

$delete = $_GET['delete'];
$update = $_GET['update'];
$insert = $_GET['insert'];
$show = $_GET['show'];

if (isset($delete)) {
    $deleteObj = new delete();
    $deleteObj->delete($delete);
}

if (isset($update)) {
    $update = new update();
    $update->update();
}

if (isset($insert)) {
    $insert = new insert();
    $insert->insert();
}

if (isset($show)) {
    $view = new show(); 
    echo "<pre>";
        strlen($show) == 0 ? $view->showAll() : $view->showFilm($show); 
    echo "</pre>";
}