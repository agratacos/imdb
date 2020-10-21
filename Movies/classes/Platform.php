<?php namespace IMDB\movies\classes;

use PDO;
use IMDB\movies\Connection;

class Platform extends Connection
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getPlatforms(): String
    {
        $stmt = $this->connect->prepare('SELECT nom as name FROM plataforma');
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    }
}