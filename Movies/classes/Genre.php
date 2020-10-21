<?php namespace IMDB\movies\classes;

use PDO;
use IMDB\movies\Connection;

class Genre extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getGenres(): String
    {
        $stmt = $this->connect->prepare('SELECT nom as name FROM genere');
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    }
}