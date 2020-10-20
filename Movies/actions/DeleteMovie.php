<?php namespace IMDB\movies\actions;

use PDO;
use IMDB\movies\Connection;

class DeleteMovie extends Connection 
{
    
    public function __construct() 
    {
        parent::__construct();
    }
    
    public function delete($name) 
    {
        try {
            $stmt = $this->connect->prepare('delete from pelicula where nom = :name');
            $stmt->bindParam(':name', $name, PDO::PARAM_STR, 40);
            $stmt->execute();
        } catch (PDOException $ex) { 
            return $ex->getMessage(); 
          }
    }
}