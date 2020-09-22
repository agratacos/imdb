<?php
    require_once('Database\Connection.php'); // IMPORTANT!!

    $database = new Connection();
    print_r($database);
    echo $database->table_name;
    echo $database->__get('table_name');
    echo $database->__setTableName('director');
    echo $database->__get('table_name');