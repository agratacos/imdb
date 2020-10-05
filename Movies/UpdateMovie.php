<?php namespace IMDB\Movies;

use IMDB\Movies\Connection;

class UpdateMovie extends Connection {
    
    public function __construct() {}

    public function update() {
        $sql = "update pelicula set ...";
    }
}