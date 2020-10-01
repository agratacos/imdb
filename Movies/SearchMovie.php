<?php namespace IMDB\Movies;

use IMDB\Movies\ShowMovie as show;

class SearchMovie extends Connection {
        
    private $where;
    private $name;
    private $movies;
    private $directors;
    private $platforms;
    private $actors;
    private $genre;

    public function __construct($name) {
        is_null($name) ? $this->where = false : $this->where = true;
        $this->name = $name;
    }
    
    public function search() 
    {
        // Cridar totes les funcions
    }

    public function searchAll()
    {
        // $this->callAll();
    }
    
    private function _executeQuery($sql) 
    {
        $whereString = ' where pelicula.nom = :name ;';
        if ($this->where) {
            $stmt = $this->connect->prepare($sql . $whereString);
            $stmt->bindParam(':name', $this->$name, PDO::PARAM_STR, 40);
        } else {
            $stmt = $this->connect->prepare($sql . ';');
        }
        $stmt->execute();
        // Intentar fer arribar aquest array en la funció _returnMovie de ShowMovie i que vagi afegint a mida que hi arriba
            // O al final enviar-hi els atributs privats
        return $stmt;
    }

    private function callAll() 
    {
        $this->_queryMovies();
        $this->_queryDirectors();
        $this->_queryPlatforms();
        $this->_queryActors();
        $this->_queryGenre();
    }

    private function _queryMovies() 
    {
        $sql = 'SELECT id_pelicula, nom, descripcio, puntuacio, data_publi, caratula from pelicula'; 
        $this->movies = $this->_executeQuery($sql);
    }

    private function _queryDirectors() 
    {
        $sql = 'SELECT director.nom, director.cognoms from pelicula 
            join pelicula_director on pelicula.id_pelicula = pelicula_director.id_pelicula
            join director on pelicula_director.id_director = director.id_director';
        $this->directors = $this->_executeQuery($sql);
    }

    private function _queryPlatforms() 
    {
        $sql = 'SELECT plataforma.nom from pelicula
            join plataforma_pelicula on pelicula.id_pelicula = plataforma_pelicula.id_pelicula
            join plataforma on plataforma_pelicula.id_plataforma = plataforma.id_plataforma';
        $this->platforms = $this->_executeQuery($sql);
    }

    private function _queryActors() 
    {
        $sql = 'SELECT actor.nom, actor.cognoms from pelicula 
            join pelicula_actor on pelicula.id_pelicula = pelicula_actor.id_pelicula
            join actor on pelicula_actor.id_actor = actor.id_actor';
        $this->actors = $this->_executeQuery($sql);
    }

    private function _queryGenre() 
    {
        $sql = 'SELECT genere.nom from pelicula
            join pelicula_genere on pelicula.id_pelicula = pelicula_genere.id_pelicula
            join genere on genere.id_genere = pelicula_genere.id_genere';
        $this->genre = $this->_executeQuery($sql);
    }
}
