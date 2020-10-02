<?php namespace IMDB\Movies;

use PDO;
use Movies\Connection;

class DeleteMovie extends Connection {
    
    public function __construct() {}
    
    public function delete($id) 
    {
        try {
            $stmt = $this->connect->prepare('delete from pelicula where id = :id');
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $ex) { 
            return $ex->getMessage(); 
          }
    }
}