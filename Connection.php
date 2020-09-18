<?php
try {
    $connect = new PDO("mysql:host=localhost;dbname=imdb", 'root', ''); 
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = $connect->prepare("select * from pelicula" );
    $sql->execute();
    $resultat = $sql->fetchAll();

    echo "<pre>";
        print_r($resultat);
    echo "</pre>";

    // $pelicula = $resultat[1];
    // echo $pelicula[5];

    $nom_pelicula = 'Coach Carter';
    // Per trobar la pel·licula que busquem, fer-ho en una funció que s'hagi d'entrar el nom de la pelicula que busquem
    $trobat = true;
    // while ($i < sizeof($resultat) && !trobat) {
    //     $pelicula == 
    // }
    /* El primer foreach és el que té cada pel·licula en un index, 
    i el segon és el que a partir de tota les dades de la pel·licula busquem la que ens interessa */
    foreach ($resultat as $key => $pelicula) {
        foreach ($pelicula as $key => $value) {
            if ($key == 'caratula') $resultat = $value;
        }
    }

    // Per extreure la imatge, i acabar mostrant-la per el html a través del link
    foreach ($pelicula as $key => $value) {
        if ($key == 'caratula') {
            # ficar en una variable el 'value' i si compleix la condició que acabi per un break
        }
    }
    
    // echo $pelicula;
    // echo "<pre>";
    //     print_r($pelicula[5]);
    // echo "</pre>";

} catch (PDOException $ex) {
    echo "Error" . $ex->get_message();
}