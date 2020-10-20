<?php namespace IMDB\movies\actions;

use PDO;
use IMDB\movies\Connection;

class InsertMovie extends Connection 
{
    
    // La informació de la variable $data, és la que entra per el formulari
    private $data;

    public function __construct(Array $data) 
    {
        parent::__construct();
        $this->data = $data;
    }

    private function _insertActor(String $name): void 
    {
        $stmt = $this->connect->prepare('INSERT INTO actor (id_actor, nom)
            values (default, ?);');
        $stmt->execute([$name]);
    }

    private function _insertBasicTable(String $table_name, String $field_db, String $field_query): void
    {
        $stmt = $this->connect->prepare('INSERT INTO :table_name (:field_db, nom)
            values (default, ?);');
        $stmt->bindParam(':table_name', $table_name, PDO::PARAM_STR, 10);
        $stmt->bindParam(':field_db', $field_db, PDO::PARAM_STR, 15);
        $stmt->execute([$this->data[$field_query]]);
    }

    /**
     * Insert tables with N M relation
     * 
     * $field_db: Table's primary key and field_db (foreign key from reference_table_name) have the same name in the DB
     */
    private function _insertBetweenTables(String $table_name, String $field_db, String $reference_table_name): void
    {
        $id_reference_table = $this->_get_id_reference_table($reference_table_name, $field_db);
        $stmt = $this->connect->prepare('INSERT INTO :table_name (id_pelicula, :field_db)
            values (:id_movie, :id_reference_table);');
        $stmt->bindParam(':table_name', $table_name, PDO::PARAM_STR, 25);
        $stmt->bindParam(':field_db', $field_db, PDO::PARAM_STR, 20);
        $stmt->bindParam(':id_movie', $this->_getIdMovie(), PDO::PARAM_INT);
        $stmt->bindParam(':id_reference_table', $id_reference_table, PDO::PARAM_INT);
        $stmt->execute();
    }

    // Comprovar el que retorna per després aplicar-ho bé a la crida
    private function _getIdMovie(): Array
    {
        $stmt = $this->connect->prepare('SELECT id_pelicula FROM pelicula WHERE nom = :name');
        $stmt->bindParam(':name', $this->data['title'], PDO::PARAM_STR, 40);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private function _get_id_reference_table(String $table_name, String $field_db) 
    {
        $stmt = $this->connect->prepare('SELECT :field_db FROM :table_name WHERE nom = :name');
        $stmt->bindParam(':field_db', $field_db, PDO::PARAM_STR, 20);
        $stmt->bindParam(':table_name', $table_name, PDO::PARAM_STR, 25);
        $stmt->bindParam(':name', $this->data['title'], PDO::PARAM_STR, 40);
        $stmt->execute();

        while ($value = $result->fetch(PDO::FETCH_ASSOC)) {
            # code...
        }
        // En aqui, la consulta podria retornar més d'un valor (ex: tornar 2 directors), pensar com arreglar això
    }

    public function insert(): void
    {
        $this->_insertBasicTable('director', 'id_director', 'director_name');
        $this->_insertBasicTable('plataforma', 'id_plataforma', 'platform_name');
        
        // Actors
        for ($i=0; $i < sizeof($this->data['actors_names']); $i++) {
            $actor = $this->data['actors_names'][$i];
            $this->_insertActor($actor);
        }
        // $this->_insertBasicTable('actor', 'id_actor', 'actor_name');
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

        $insertMovie = $this->connect->prepare('INSERT INTO pelicula (id_pelicula, nom, descripcio, puntuacio, data_publi, caratula)
            values (default, ?, ?, ?, ?, ?);');
        $insertMovie->exectue([$this->data['title'], $this->data['description'], $this->data['score'], $this->data['publication_date'], $this->data['image']]);
    
        // Exemple
        _insertBetweenTables('pelicula_director', 'id_director', 'director');
    }
}