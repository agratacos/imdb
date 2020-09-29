<?php namespace IMDB\Movies;

use Movies\Connection;

class DeleteMovie extends Connection {
    
    public function delete($id) {
        try {
            $stmt = $this->connect->prepare("delete from pelicula where id = $id");
            $stmt->execute();
        } catch (PDOException $ex) { echo $ex->getMessage(); }
    }
}