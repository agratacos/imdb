<?php namespace IMDB\Movies;

// use PDO;
use IMDB\Movies\SearchMovie as Search;

/*  
    Per filtrar per plataforma i gènere, agafem el id de la url, i amb una consulta a la BD obtenim tots
    els noms de les pelis que hi formen part.
    I dp aplicar-hi el mètode _returnMovies() i ja retornarà els valors que es volen
*/
class ShowMovie extends SearchMovie 
{
    private $loc_movies;
    private $search;

    public function __construct() 
    {
        
    }

    public function showFilm($name)
    {
        $this->search = new Search($name);
        $this->search->search();
        $this->_returnFilm();
        $data = ['movies' => $this->loc_movies];
        // print_r($data); 
        echo json_encode($data);
    }

    /* Fer-ho amb el mateix format que si fos una pelicula, l'únic, que primer extreure tots els noms 
        de les pelis, i després actuar com si fos una, cada peli en una posició de l'array */

    /**
     * Arriba el nom del tipus de filtre (ex: platform), i el valor (ex: Netflix).
     * L'objecte search local es crea amb el valor i després des del mètode _getMoviesNames() de Search()
     * ja es tindra el valor per la condició del where en $this->name.
     */
    public function showAll($filter_type = NULL, $filter_name = NULL)
    {
        $join = $this->_get_join_structure($filter_type);
        $this->search = new Search($this->_get_filter($filter_name));
        $this->_returnMovies($this->search->_getMoviesNames($join));
        $data = ['movies' => $this->loc_movies];
        // print_r($data);          
        echo json_encode($data);
    }

    private function _get_filter($name)
    {
        return $name != NULL ? $name : NULL;
    }

    private function _get_join_structure($filter)
    {
        return $filter === 'platform'
                ? 'join plataforma_pelicula on pelicula.id_pelicula = plataforma_pelicula.id_pelicula
                    join plataforma on plataforma_pelicula.id_plataforma = plataforma.id_plataforma 
                    where plataforma.nom like ? ;'
                : $this->_is_genre($filter);
    }

    private function _is_genre($filter)
    {
        return $filter === 'genre'
                ? 'join pelicula_genere on pelicula.id_pelicula = pelicula_genere.id_pelicula
                    join genere on genere.id_genere = pelicula_genere.id_genere
                    where genere.nom like ? ;'
                : NULL;
    }

    /******************************************
     * Fer funcions amb les claus que es posaran als arrays que s'enviin, 
     * fer un array_combine entre aixó, i dp un array_merge per retornar el final
     ******************************************/

    private function _returnMovies($movies_names) 
    {
        for ($i=0; $i < sizeof($movies_names); $i++) {
            $name = $movies_names[$i]['movie_name'];
            $this->_getFilm($name);
            $this->_returnFilm();
        }
    }

    private function _getFilm($name) 
    {
        $this->search = new Search($name);
        $this->search->search();
    }

    private function _returnFilm()
    {
        $this->loc_movies[$this->search->movies[0]['id_movie']] = [   
            'movie_data' => $this->search->movies[0], // Always return 1 position with all information
            'directors' => $this->search->directors, 
            'platforms' => $this->search->platforms, // Funció perquè retorni un array associatiu amb tots els valors, perquè no surti platform_name
            'actors' => $this->search->actors, 
            'genres' => $this->search->genres
        ];
    }
}