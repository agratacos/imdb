<?php
    // $a1 = [
    //     'numero' => 1,
    //     'nom' => 'prova',
    //     'descripcio' => 'descripcio de prova'
    // ];

    // $a2 = [
    //     'numero' => 2,
    //     'nom' => 'prova2',
    //     'descripcio' => 'descripcio de prova2'
    // ];

    // $a3 = [
    //     'numero' => 3,
    //     'nom' => 'prova3',
    //     'descripcio' => 'descripcio de prova3'
    // ];

    // $a4 = [
    //     'numero' => 4,
    //     'nom' => 'prova4',
    //     'descripcio' => 'descripcio de prova4'
    // ];

    // $array = array($a1, $a2, $a3, $a4);

    // $final = $array[0];
    // for ($i=1; $i < sizeof($array); $i++) { 
    //     $temp = $array[$i];
    //     $final = array_merge_recursive($final, $temp);
    //     echo "<pre>";
    //         print_r($final);
    //     echo "</pre>";

    //     echo "<br><br><br>";
    // }

    $tipus = $_GET['show'];
    $nom = $_GET['show'];

    echo $tipus . ' ' . $nom;
    echo is_null($nom) ? 'null' : 'NOT NULL'; 