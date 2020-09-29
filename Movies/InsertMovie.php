<?php namespace IMDB\Movies;

use PDO;

class InsertMovie extends Connection {
    
    // La informació de la variable $data, és la que entra per el formulari
    private $data;

    public function __construct($data) {
        $this->data = $data;
    }

    private function _insertBasicTable($table_name, $field_db, $field_query) {
        $stmt = $this->connect->prepare("INSERT INTO $table_name ($field_db, nom)
            values (default, ?);");
        $stmt->execute(array($this->$data[$field_query]));
    }

    /**
     * Insert tables with N M relation
     * 
     * $field_db: Table's primary key and field_db (foreign key from reference_table_name) have the same name in the DB
     */
    private function _insertBetweenTables($table_name, $field_db, $reference_table_name) {
        $id_movie = $this->_get_id_movie();
        $id_reference_table = $this->_get_id_reference_table($reference_table_name, $field_db);
        $stmt = $this->connect->prepare("INSERT INTO $table_name (id_pelicula, $field_db)
            values ($id_movie, $id_reference_table);");
    }

    private function _getIdMovie() {
        $stmt = $this->connect->prepare("SELECT id_pelicula FROM pelicula WHERE nom = :name");
        $stmt->bindParam(':name', $this->data['title'], PDO::PARAM_STR, 40);
        $stmt->execute();
        return $stmt['id_pelicula']; // Si això no funciona, fer-ho amb $stmt->fetch()
    }

    private function _get_id_reference_table($table_name, $field_db) {
        $stmt = $this->connect->prepare("SELECT $field_db FROM $table_name WHERE ");
        // En aqui, la consulta podria retornar més d'un valor, pensar com arreglar això
    }

    public function insert() {
        $this->_insertBasicTable('director', 'id_director', 'director_name');
        $this->_insertBasicTable('plataforma', 'id_plataforma', 'platform_name');
        $this->_insertBasicTable('actor', 'id_actor', 'actor_name');
        $this->_insertBasicTable('genere', 'id_genere', 'genre_name');

        // $insertDirector = $this->connect->prepare("INSERT INTO director (id_director, nom)
        //     values (default, ?);");
        // $insertDirector->execute(array($data['nom_director']));
        
        // $insertPlatform = $this->connect->prepare("INSERT INTO plataforma (id_plataforma, nom)
        //     values (default, ?);");
        // $insertPlatform->execute(array($data['nom_plataforma']));
        
        // $insertActor = $this->connect->prepare("INSERT INTO actor (id_actor, nom)
        //     values (default, ?);");
        // $insertActor->execute(array($data['nom_actor']));

        $insertMovie = $this->connect->prepare("INSERT INTO pelicula (id_pelicula, nom, descripcio, puntuacio, data_publi, caratula)
            values (default, ?, ?, ?, ?, ?);");
        $insertMovie->exectue(array($this->$data['title'], $this->$data['description'], $this->$data['score'], $this->$data['publication_date'], $this->$data['image']));
    
        _insertBetweenTables();
    }
}