<?php

class DeleteMovie extends Connection {
    
    public function delete($id) {
        $stmt = $this->connect->prepare("delete from pelicula where id = $id");
        $stmt->execute();
    }
}