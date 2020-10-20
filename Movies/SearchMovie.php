<?php namespace IMDB\Movies;

use PDO;
use IMDB\Movies\Connection;

class SearchMovie extends Connection 
{
    private $name;
    protected $movies;
    protected $directors;
    protected $platforms;
    protected $actors;
    protected $genres;

    public function __construct($name) 
    {
        parent::__construct();
        $this->name = $name;
    }
    
    public function search()
    {
        $this->_callAll();
        $this->_merge();
    }

    /**
     * Here it comes: NULL, or join's structure with his correspondly tables.
     * For get the movie's names from the corresponding filter
     */

    protected function _getMoviesNames($join = NULL)
    {
        $sql = 'SELECT pelicula.nom as movie_name FROM pelicula ';

        if ($join == NULL) {
            $stmt = $this->connect->prepare($sql);
            $stmt->execute();
        } else {
            $stmt = $this->connect->prepare($sql . $join);
            $stmt->execute(["%{$this->name}%"]);
        }
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }

    private function _callAll() 
    {
        $this->_queryMovies();
        $this->_queryDirectors();
        $this->_queryPlatforms();
        $this->_queryActors();
        $this->_queryGenres();
    }
    
    /* Per filtrar per peli, plataforma i genere.
        Comparar el valor que arriba, amb les dades de plataforma, genere i pelicula (els noms) que hi han a la BD,
        a base de ifs, i el que coincideixi, utilitzar aquella taula.
        Per defecte busca en la taula pelicula.
        
        Mirar d'utilitzar la funció _getTablesNames() adaptant-la a que retorni les 3 dades, 
        però primer mirar com retorna la informació i a veure si el nom de les pelis desde ShowMovie
        es pot agafar amb columna ( ['movie_name'] ) */
    private function _executeQuery($sql) 
    {
        // $whereString = get_where();
        $whereString = ' where pelicula.nom like :name ;';
        $stmt = $this->connect->prepare($sql . $whereString);
        $stmt->execute([':name' => "%{$this->name}%"]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function get_where()
    {
        # code...
    }

    // PROVA
    // private function _executeQuery($sql) 
    // {
    //     $whereString = " where pelicula.id = :id ;";
    //     $stmt = $this->connect->prepare($sql . $whereString);
    //     $stmt->execute([':id' => "%{$this->name}%"]);
    //     $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //     return $result;
    // }

    private function _queryMovies() 
    {
        $sql = 'SELECT id_pelicula as id_movie, nom as movie_name, descripcio as movie_description, puntuacio as score,
             data_publi as publication_date, caratula as movie_image from pelicula'; 
        $this->movies = $this->_executeQuery($sql);
    }

    private function _queryDirectors() 
    {
        $sql = 'SELECT director.nom as name, director.cognom as lastname from pelicula 
            join pelicula_director on pelicula.id_pelicula = pelicula_director.id_pelicula
            join director on pelicula_director.id_director = director.id_director';
        $this->directors = $this->_executeQuery($sql);
    }

    private function _queryPlatforms()
    {
        $sql = 'SELECT plataforma.nom as name from pelicula
            join plataforma_pelicula on pelicula.id_pelicula = plataforma_pelicula.id_pelicula
            join plataforma on plataforma_pelicula.id_plataforma = plataforma.id_plataforma';
        $this->platforms = $this->_executeQuery($sql);
    }

    private function _queryActors() 
    {
        $sql = 'SELECT actor.nom as name, actor.cognom as lastname from pelicula 
            join pelicula_actor on pelicula.id_pelicula = pelicula_actor.id_pelicula
            join actor on pelicula_actor.id_actor = actor.id_actor';
        $this->actors = $this->_executeQuery($sql);
    }

    private function _queryGenres() 
    {
        $sql = 'SELECT genere.nom as name from pelicula
            join pelicula_genere on pelicula.id_pelicula = pelicula_genere.id_pelicula
            join genere on genere.id_genere = pelicula_genere.id_genere';
        $this->genres = $this->_executeQuery($sql);
    }

    /**
     * If want return more than 1 column, do delete _merge() method for get as director's and actor's format.
     * But for now, is better this format for platforms and genres
     */
    private function _merge()
    {
        $this->platforms = $this->_mergeFields($this->platforms);
        $this->genres = $this->_mergeFields($this->genres);
    }

    private function _mergeFields($array)
    {
        $result = $array[0];
        for ($i=1; $i < sizeof($array); $i++) { 
            $temp = $array[$i];
            $result = array_merge_recursive($result, $temp);
        }
        return $result;
    }
}