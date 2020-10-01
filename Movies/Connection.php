<?php namespace IMDB\Movies;
/* Tots els objectes que heredin de Connection, i a partir les classes objDB, enviar en les funcions 
    de Connection informació més concreta per fer consultes */
use PDO;

class Connection {
    
    protected $connect;
    
    // Constructor
    public function __construct() 
    {
        try {
            $this->connect = new PDO('mysql:host=localhost;dbname=imdb', 'root', ''); 
            $this->connect -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) { 
            return $ex->get_message(); 
          }
    }
}