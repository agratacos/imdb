<?php namespace IMDB\Movies;

use PDO;
use IMDB\Movies\SearchMovie as search;

class ShowMovie extends Connection {

    // public function __construct() {
    //     $this->var = $var;
    // }


    public function showFilm($name) 
    {
        $search = new search($name);



        print_r($this->_returnMovie());
    }

    public function showAll()
    {
        $search = new search(NULL);
    }


    private function _returnMovie($resultat) 
    {
        $dades = array();
        
        $dades = [
            'pelicula' => $this->movies,
            'director' => $this->directors,
            'platforms' => $this->platforms,
            'actors' => $this->actors,
            'genre' => $this->genre
        ];

        // foreach ($this->movies as $key => $value) {
        //     # code...
        // }

        // while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        //     $dades[] = [
        //         'name' => $row['nom'],
        //         'description' => $row['descripcio'],
        //         'score' => $row['puntuacio'],
        //         'publi_date' => $row['data_publi'],
        //         'image' => $row['caratula'],
        //         'director_name' => $row['nom_director'],
        //         'genre_name' => $row['nom_genere'],
        //         'actor_name' => $row['nom_actor'],
        //         'platform_name' => $row['nom_plataforma']
        //     ];
        // }
        // Mirar d'aplicar-li el array_unique a $dades, a veure què passa
        return json_encode($dades);
    }
}
 