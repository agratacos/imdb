<?php namespace IMDB\Movies;

// use PDO;
use IMDB\Movies\SearchMovie as Search;

class ShowMovie extends SearchMovie 
{

    private $search;

    public function __construct() 
    {
        
    }

    public function showFilm($name)
    {
        $this->search = new Search($name);
        $this->search->search();
        $this->_returnFilm($movies);
        $data = ['movies' => $movies];

        // print_r($data); 
        // Treure-ho i fer: return json_encode($data);
        print_r(json_encode($data));
    }

    /* Fer-ho amb el mateix format que si fos una pelicula, l'únic, que primer extreure tots els noms 
    de les pelis, i després actuar com si fos una, cada peli en una posició de l'array */
    public function showAll()
    {
        $this->search = new Search(NULL);
        $movies_names = $this->search->_getMoviesNames();
        $this->_returnMovies($movies_names, $movies);
        $data = ['movies' => $movies];
        print_r($data);          // Fer: return json_encode($data);
    }

    /******************************************
     * Fer funcions amb les claus que es posaran als arrays que s'enviin, 
     * fer un array_combine entre aixó, i dp un array_merge per retornar el final
     ******************************************/

    private function _returnMovies($movies_names, &$movies) 
    {
        for ($i=0; $i < sizeof($movies_names); $i++) {
            $name = $movies_names[$i]['movie_name'];
            $this->_getFilm($name);
            $this->_returnFilm($movies);
        }
    }

    private function _getFilm($name) 
    {
        $this->search = new Search($name);
        $this->search->search();
    }

    private function _returnFilm(&$movies)
    {
        $movies[$this->search->movies[0]['id_movie']] = [   
            'movie_data' => $this->search->movies[0], // Always return 1 position with all information
            'directors' => $this->search->directors, 
            'platforms' => $this->search->platforms, // Funció perquè retorni un array associatiu amb tots els valors, perquè no surti platform_name
            'actors' => $this->search->actors, 
            'genres' => $this->search->genres
        ];
    }
}