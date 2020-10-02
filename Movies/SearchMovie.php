<?php namespace IMDB\Movies;

use PDO;
use IMDB\Movies\Connection;

class SearchMovie extends Connection {
        
    private $where;
    private $name;
    protected $movies;
    protected $directors;
    protected $platforms;
    protected $actors;
    protected $genre;

    public function __construct($name) {
        is_null($name) ? $this->where = false : $this->where = true;
        $this->name = $name;
    }
    
    public function search() 
    {
        $this->_callAll();
        // I ara enviar tota aquesta informació a la classe show
        $this->_assignAll();
    }

    private function _callAll() 
    {
        $this->_queryMovies();
        $this->_queryDirectors();
        $this->_queryPlatforms();
        $this->_queryActors();
        $this->_queryGenre();
    }
    
    private function _executeQuery($sql) 
    {
        $whereString = ' where pelicula.nom = :name ;';
        if ($this->where) {
            $stmt = $this->connect->prepare($sql . $whereString);
            $stmt->bindParam(':name', $this->name, PDO::PARAM_STR, 40);
        } else {
            $stmt = $this->connect->prepare($sql . ';');
        }
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        // Intentar fer arribar aquest array en la funció _returnMovie de ShowMovie i que vagi afegint a mida que hi arriba
            // O al final enviar-hi els atributs privats
        return $result;
    }

    private function _queryMovies() 
    {
        $sql = 'SELECT id_pelicula as id_movie, nom as movie_name, descripcio as movie_description, puntuacio as score,
             data_publi as publication_date, caratula as movie_image from pelicula'; 
        $this->movies = $this->_executeQuery($sql);
    }

    private function _queryDirectors() 
    {
        $sql = 'SELECT director.nom as director_name, director.cognoms as director_lastname from pelicula 
            join pelicula_director on pelicula.id_pelicula = pelicula_director.id_pelicula
            join director on pelicula_director.id_director = director.id_director';
        $this->directors = $this->_executeQuery($sql);
    }

    private function _queryPlatforms() 
    {
        $sql = 'SELECT plataforma.nom as platform_name from pelicula
            join plataforma_pelicula on pelicula.id_pelicula = plataforma_pelicula.id_pelicula
            join plataforma on plataforma_pelicula.id_plataforma = plataforma.id_plataforma';
        $this->platforms = $this->_executeQuery($sql);
    }

    private function _queryActors() 
    {
        $sql = 'SELECT actor.nom as actor_name, actor.cognoms as actor_lastname from pelicula 
            join pelicula_actor on pelicula.id_pelicula = pelicula_actor.id_pelicula
            join actor on pelicula_actor.id_actor = actor.id_actor';
        $this->actors = $this->_executeQuery($sql);
    }

    private function _queryGenre() 
    {
        $sql = 'SELECT genere.nom as genre_name from pelicula
            join pelicula_genere on pelicula.id_pelicula = pelicula_genere.id_pelicula
            join genere on genere.id_genere = pelicula_genere.id_genere';
        $this->genre = $this->_executeQuery($sql);
    }


    private function _assignAll()
    {
        $this->movies = $this->_mergeAllData($this->movies);
        $this->directors = $this->_mergeAllData($this->directors);
        $this->platforms = $this->_mergeAllData($this->platforms);
        $this->actors = $this->_mergeAllData($this->actors);
        $this->genre = $this->_mergeAllData($this->genre);
    }

    private function _mergeAllData($array) 
    {
        $result = $array[0];
        for ($i=1; $i < sizeof($array); $i++) { 
            $temp = $array[$i];
            $result = array_merge_recursive($result, $temp);
        }
        return $result;
    }
}
