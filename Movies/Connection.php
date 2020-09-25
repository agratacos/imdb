<?php namespace Movies;
/* Tots els objectes que heredin de Connection, i a partir les classes objDB, enviar en les funcions 
    de Connection informació més concreta per fer consultes */
class Connection {
    
    protected $connect;
    
    // Constructor
    function __construct() {
        try {
            $this->connect = new PDO("mysql:host=localhost;dbname=imdb", 'root', ''); 
            $this->connect -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) { echo "Error " . $ex->get_message(); }
    }

    // Mètodes

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

    // Per trobar la caràtula que busquem, fer-ho en una funció que s'hagi d'entrar el nom de la pel·licula que busquem
    public function searchMovieImage($movie_name) {
        $sql = $this->connect -> prepare("select caratula from pelicula where nom = '$movie_name'");
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC); 
        // Retorna les dades de la pel·licula que s'entra, amb els noms dels camps com a index, (PDO::FETCH_ASSOC) retalla els números i no surt duplicat.
        $link = $result['caratula'];
        /* (0, 3) perquè totes les imatges estan a la carpeta img i té 3 caràcters a retallar per posar la contra barra
        i la parteixo per posar la contra barra perquè al extreure la foto de la bd, mostra el link sense la barra */
        return $link = substr($link, 0, 3) . '\\' . substr($link, 3);
    }
}