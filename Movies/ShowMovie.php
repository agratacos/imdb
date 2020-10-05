<?php namespace IMDB\Movies;

// use PDO;
use IMDB\Movies\SearchMovie as search;

class ShowMovie extends SearchMovie {

    private $search;

    public function __construct() {}

    public function showFilm($name) 
    {
        $this->search = new search($name);
        $this->search->search();
        // var_dump($this->search->movies);
        // print_r($this->_returnMovie());
    }

    public function showAll()
    {
        $this->search = new search(NULL);
        $this->search->search();
        // print_r($this->_returnMovie());
    }

    /******************************************
     * Fer funcions amb les claus que es posaran als arrays que s'enviin, 
     * fer un array_combine entre aixó, i dp un array_merge per retornar el final
     ******************************************/

    // Agafar els arrays desde l'altre classe
    private function _returnMovie() 
    {
        $dades[] = array_merge($this->search->movies, $this->search->directors, $this->search->platforms, $this->search->actors, $this->search->genre);

        // $dades = array();
        
        // $dades = [
        //     'pelicula' => $this->movies,
        //     'director' => $this->directors,
        //     'platforms' => $this->platforms,
        //     'actors' => $this->actors,
        //     'genre' => $this->genre
        // ];

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
        return $dades;
    }
}
 