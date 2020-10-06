<?php namespace IMDB\Movies;

//  All classes extends to Connection

use PDO;

class Connection {
    
    protected $connect;
    
    public function __construct() 
    {
        try {
            $this->connect = new PDO('mysql:host=localhost;dbname=imdb', 'root', ''); 
            $this->connect -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) { 
            return "ERROR {$ex->get_message()}"; 
          }
    }
}