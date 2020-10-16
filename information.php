<?php

require 'vendor/autoload.php';
use IMDB\Movies\DeleteMovie as Delete;
use IMDB\Movies\UpdateMovie as Update;
use IMDB\Movies\InsertMovie as Insert;
use IMDB\Movies\ShowMovie as Show;
use IMDB\Movies\GenreDB as GENRE;

header('Content-Type: application/json');
$version = 'v2.3.2';

// http://information.php?show=Nom Peli

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

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
    // echo "<pre>";
        strlen($show) == 0 ? $view->showAll() : $view->showFilm($show);
    // echo "</pre>";
}

if(isset($_GET['genres']))
{
    $genres = new GENRE();
    echo $genres->getGenres();
}