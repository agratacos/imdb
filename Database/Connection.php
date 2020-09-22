<?php
/* Tots els objectes que heredin de Connection, i a partir les classes objDB, enviar en les funcions 
    de Connection informació més concreta per fer consultes */
class Connection {
    
    private $connect;
    private $table_name; 
    /* Nom de la taula com a atribut i així no s'haurà d'introduir el nom a cada consulta, i podràn 
        ser més genèriques, no escriure una consulta per cada taula */
    
    // Constructor
    function __construct() {
        try {
            $this->connect = new PDO("mysql:host=localhost;dbname=imdb", 'root', ''); 
            $this->connect -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->table_name = 'pelicula'; // Poso la taula 'pelicula' com a valor per defecte
        } catch (PDOException $ex) { echo "Error " . $ex->get_message(); }
    }

    // Getter and Setter functions
        // Es poden obtenir els valors d'ambdós atributs però només fer setter de $table_name
    function __get($variable) {
        if (property_exists($this, $variable))
            if (!empty($this -> $variable)) return $this -> $variable;
    }

    function __setTableName($changeValue) {
        // S'ha de comprovar si el nou valor és vàlid
        if (in_array(strtolower($changeValue), $this->tables_names()))
            $this->table_name = $changeValue;
    }

    // Mètodes

    // Obtenir en un array tots els noms de les taules creades en la bd
    private function tables_names() {
        $sql = $this->connect -> prepare("select table_name from information_schema.tables where table_schema = 'imdb'");
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_COLUMN);
        // Retorna un array amb tots els noms de les taules de la bd imdb
    }

    /*********************************************************************************************************
     * Intentar que només s'hagi d'entrar el nom d'una pelicula i extregui tota la informació en una línea,
     * i sigui triar els camps desitjats, això requereix una consulta molt complexe si es que és possible :)
    **********************************************************************************************************/
    // Posar el select genèric aquí i després per cada més concret una funció privada
        // Un paràmetre que s'entri concretament el where que es vol ficar de més, la taula ja està definida anteriorment
    // public function generalQuery($addWhere = null) {
    //     $sql = $this->connect -> prepare("select * from $this->table_name where nom = 'Coach Carter'");
    //     $sql->execute();
    // }

    // Per trobar la pel·licula que busquem, fer-ho en una funció que s'hagi d'entrar el nom de la pel·licula que busquem
    public function searchFilmImage() {
        $sql = $this->connect -> prepare("select * from $this->table_name where nom = 'Coach Carter'");
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC); 
        // Retorna totes les dades de la pel·licula desitjada, amb els noms dels camps com a index, (PDO::FETCH_ASSOC) retalla els números i no surt duplicat.
        $link = $result['caratula'];
        /* (0, 3) perquè totes les imatges estan a la carpeta img i té 3 caràcters a retallar per posar la contra barra
        i la parteixo per posar la contra barra perquè al extreure la foto de la bd, mostra el link sense la barra */
        return $link = substr($link, 0, 3) . '\\'. substr($link, 3);
    }
}

    // require_once('action.php');
    // function query() {
    //     $query_result = null;

    //     switch ($table_name) {
    //         case 'pelicula':
    //             $query_result = searchFilmImage($film_name);
    //             break;
    //         case 'plataforma':

    //             break;
    //         case 'director':

    //             break;
    //         case 'actor':

    //             break;
    //         case 'genere':

    //             break;
    //         case 'pelicula_director':

    //             break;
    //         case 'pelicula_actor':

    //             break;
    //         case 'pelicula_genere':

    //             break;
    //         case 'plataforma_pelicula':

    //             break;
    //         case 'puntuacio':

    //             break;
    //         // Si és qualsevol altre (default), ja està definit amb valor de null
    //     }
    //     return $query_result;
    // }