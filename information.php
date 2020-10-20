<?php

require 'vendor/autoload.php';
use IMDB\movies\actions\DeleteMovie as Delete;
use IMDB\movies\actions\UpdateMovie as Update;
use IMDB\movies\actions\InsertMovie as Insert;
use IMDB\movies\actions\ShowMovie as Show;

header('Content-Type: application/json');
$version = 'v2.3.2';

$delete = $_GET['delete'];
$update = $_GET['update'];
$insert = $_GET['insert'];
$show = $_GET['show'];
$platform = $_GET['platform'];
$genre = $_GET['genre'];

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

// http://information.php?show or http://information.php?show=Movie_Name
if (isset($show)) {
    $view = new Show(); 
    // echo "<pre>";
        strlen($show) == 0 ? $view->showAll() : $view->showFilm($show);
    // echo "</pre>";
}

// http://information.php?platform=Netflix
if (isset($platform)) {
    $view = new Show();
    $view->showAll('platform', $platform);
}

// http://information.php?genre=Drama
if (isset($genre)) {
    $view = new Show();
    $view->showAll('genre', $genre);
}