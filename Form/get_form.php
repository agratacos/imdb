<?php
    // A partir de tota aquesta informació ¿crear un objecte pelicula? (revisar pràctica teatre)
    //      I s'hauria de pujar a la bd

    // S'han de fer verificacions
    $title = $_POST['title'];
    $description = $_POST['description'];
    $score = $_POST['score'];
    $publication_date = $_POST['publication_date'];

    $image_name = $_FILES['image']['name'];
    $origin_path = $_FILES['image']['tmp_name'];
    $destination_path = $_SERVER['DOCUMENT_ROOT'] . '/img/';
    move_uploaded_file($origin_path, $destination_path . $image_name);