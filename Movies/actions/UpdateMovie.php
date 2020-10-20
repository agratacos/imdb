<?php namespace IMDB\movies\actions;

use IMDB\movies\Connection;

class UpdateMovie extends Connection 
{
    
    public function __construct() 
    {
        parent::__construct();
    }

    public function update() {
        $sql = "update pelicula set ...";
    }
}