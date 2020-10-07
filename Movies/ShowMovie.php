<?php namespace IMDB\Movies;

// use PDO;
use IMDB\Movies\SearchMovie as search;

class ShowMovie extends SearchMovie 
{

    private $search;

    public function __construct() 
    {
        
    }

    public function showFilm($name)
    {
        $this->search = new search($name);
        $this->search->search();
        $this->_returnFilm($dades);
        print_r($dades); // Treure-ho i fer: return json_encode($dades);
    }

    /* Fer-ho amb el mateix format que si fos una pelicula, l'únic, que primer extreure tots els noms 
    de les pelis, i després actuar com si fos una, cada peli en una posició de l'array */
    public function showAll()
    {
        $this->search = new search(NULL);
        $movies_names = $this->search->_getMoviesNames();
        $this->_returnMovies($movies_names, $dades);
        print_r($dades);          // Fer: return json_encode($dades);
    }

    /******************************************
     * Fer funcions amb les claus que es posaran als arrays que s'enviin, 
     * fer un array_combine entre aixó, i dp un array_merge per retornar el final
     ******************************************/

    private function _returnMovies($movies_names, &$dades) 
    {
        for ($i=0; $i < sizeof($movies_names); $i++) {
            $name = $movies_names[$i]['movie_name'];
            $this->_getFilm($name);
            $this->_returnFilm($dades);
        }
    }

    private function _getFilm($name) 
    {
        $this->search = new search($name);
        $this->search->search();
    }

    private function _returnFilm(&$dades)
    {
        $dades[$this->search->movies[0]['id_movie']] = [   
            'movie_data' => $this->search->movies[0], // Always return 1 position with all information
            'directors' => $this->search->directors, 
            'platforms' => $this->search->platforms, // Funció perquè retorni un array associatiu amb tots els valors
            'actors' => $this->search->actors, 
            'genre' => $this->search->genre
        ];
    }
}