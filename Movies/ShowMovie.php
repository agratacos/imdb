<?php namespace IMDB\Movies;
// ¿Va relacionat amb el SearchMovie?
// use IMDB\Movies\SearchMovie as search;
use PDO;

class ShowMovie extends Connection {
    
    private $movies;
    private $directors;
    private $platforms;
    private $actors;
    private $genre;

    public function show($id) {
        // $search = new SearchMovie();
        print_r($this->_returnMovie($this->_queryMovie($id)));
    }

    private function _executeQuery($sql) {
        $stmt = $this->connect->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    private function _queryMovies($id) {
        $sql = "SELECT id_pelicula, nom, descripcio, puntuacio, data_publi, caratula from pelicula 
            where id_pelicula = $id;";
        $this->movies = _executeQuery($sql);
    }

    private function _queryDirectors($id) {
        $sql = "SELECT pelicula.id_pelicula, director.nom, director.cognoms from pelicula 
            join pelicula_director on pelicula.id_pelicula = pelicula_director.id_pelicula
            join director on pelicula_director.id_director = director.id_director
            where pelicula.id_pelicula = $id;";
        $this->directors = _executeQuery($sql);
    }

    private function _queryPlatforms($id) {
        $sql = "SELECT pelicula.id_pelicula, plataforma.nom from pelicula
            join plataforma_pelicula on pelicula.id_pelicula = plataforma_pelicula.id_pelicula
            join plataforma on plataforma_pelicula.id_plataforma = plataforma.id_plataforma
            where pelicula.id_pelicula = $id;";
        $this->platforms = _executeQuery($sql);
    }

    private function _queryActors($id) {
        $sql = "SELECT pelicula.id_pelicula, actor.nom, actor.cognoms from pelicula 
            join pelicula_actor on pelicula.id_pelicula = pelicula_actor.id_pelicula
            join actor on pelicula_actor.id_actor = actor.id_actor
            where pelicula.id_pelicula = $id;";
        $this->actors = _executeQuery($sql);
    }

    private function _queryGenre($id) {
        $sql = "SELECT pelicula.id_pelicula, genere.nom from pelicula
            join pelicula_genere on pelicula.id_pelicula = pelicula_genere.id_pelicula
            join genere on genere.id_genere = pelicula_genere.id_genere
            where pelicula.id_pelicula = $id;";
        $this->genre = _executeQuery($sql);
    }

    private function _returnMovie($result) {
        $dades = array();
        
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $dades[] = array (
                'name' => $row['nom'],
                'description' => $row['descripcio'],
                'score' => $row['puntuacio'],
                'publi_date' => $row['data_publi'],
                'image' => $row['caratula'],
                'director_name' => $row['nom_director'],
                'genre_name' => $row['nom_genere'],
                'actor_name' => $row['nom_actor'],
                'platform_name' => $row['nom_plataforma']
            );
        }
        // Mirar d'aplicar-li el array_unique a $dades, a veure què passa
        return $dades;
    }
}
