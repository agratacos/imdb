<?php namespace IMDB\Movies;

class InsertMovie extends Connection {
    
    public function insert($data) {
        
        $insertMovie = $this->connect->prepare("INSERT INTO pelicula 
            values ()");
    }
}
