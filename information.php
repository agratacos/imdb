<?php

$version = 'v2.1.1';

require 'vendor/autoload.php';
use IMDB\Movies\DeleteMovie as Delete;
use IMDB\Movies\UpdateMovie as Update;
use IMDB\Movies\InsertMovie as Insert;
use IMDB\Movies\ShowMovie as Show;

// http://information.php?show=Nom Peli

$delete = $_GET['delete'];
$update = $_GET['update'];
$insert = $_GET['insert'];
$show = $_GET['show'];

if (isset($delete)) {
    $deleteObj = new Delete();
    $deleteObj->delete($delete);
}

if (isset($update)) {
    $update = new Update();
    $update->update();
}

if (isset($insert)) {
    $insert = new Insert();
    $insert->insert();
}

if (isset($show)) {
    $view = new Show(); 
    echo "<pre>";
        strlen($show) == 0 ? $view->showAll() : $view->showFilm($show); 
    echo "</pre>";
}