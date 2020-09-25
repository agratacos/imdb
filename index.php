<?php 
    $version = 'v2.0.1';
    require_once('Movies\Connection.php');
    $database = new Connection();

    // echo $database->searchMovieImage();
    // include("tests.php");
?>
<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>IMDB</title>
    </head>
    <body>
        <h2>hola desde HTML</h2>
        
        <!-- include('Form\form.php');  -->
        
        <img src="
            <?php 
                echo $database->searchMovieImage('Coach Carter');
            ?>
            " alt="error">   
    </body>
</html>