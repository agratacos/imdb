<?php

class DeleteMovie extends Connection {
    
    public function delete($id) {
        $this->connect->prepare("delete from pelicula where id = $id");
        // ...
    }
}
