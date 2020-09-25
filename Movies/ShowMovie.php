<?php
// ¿Va relacionat amb el SearchMovie?
class ShowMovie extends Connection {
    
    public function show($id) {
        // $search = new SearchMovie();
        
        
        // return array amb totes les dades
    }

    private function _queryMovie() {
        $sql = "SELECT pelicula.nom, pelicula.descripcio, pelicula.puntuacio, pelicula.data_publi, pelicula.caratula, 
		        director.nom as 'nom_director', genere.nom as 'nom_genere', actor.nom as 'nom_actor', plataforma.nom as 'nom_plataforma'
                from pelicula 
                join pelicula_director on pelicula.id_pelicula = pelicula_director.id_pelicula
                join director on director.dni = pelicula_director.dni_director
                join pelicula_genere on pelicula.id_pelicula = pelicula_genere.id_pelicula
                join genere on genere.id_genere = pelicula_genere.id_genere
                join pelicula_actor on pelicula.id_pelicula = pelicula_actor.id_pelicula
                join actor on actor.dni = pelicula_actor.dni_actor
                join plataforma_pelicula on pelicula.id_pelicula = plataforma_pelicula.id_pelicula
                join plataforma on plataforma.id_plataforma = plataforma_pelicula.id_plataforma
                where pelicula.id_pelicula = $id;";
        $result = $this->connect->prepare($sql);
        return $result->execute();
    }

    private function _returnMovie($result) {
        $dades = array();


        // return [
        //     'nom' => $sql['nom']
        //     'descripcio'
        // ];
    }
}
