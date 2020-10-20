<?php namespace IMDB\movies\classes;

use PDO;
use IMDB\movies\Connection;

class Genre extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getGenres()
    {
        $stmt = $this->connect->prepare('SELECT * FROM genere');
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($result);
    }
}