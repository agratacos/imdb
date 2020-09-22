<!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="Form\style.css">
    </head>
    <body>
        <aside>
            <h2>Entrar Pel·licula</h2>
            <form action="get_form.php" method="post" enctype="multipart/form-data">
                <p>
                    <label for="title">Títol:</label>
                    <input type="text" name="title" id="title" placeholder="Nom de la pel·licula" required>
                </p>

                <p>
                    <label for="description">Descripció:</label>
                    <textarea name="description" id="description" maxlength="500" 
                    placeholder="Sinopsis de la pel·licula" required></textarea>
                </p>

                <p>
                    <label for="score">Puntuació:</label>
                    <input type="number" name="score" id="score" min="0" max="5" step=".1">
                    
                    <label for="publication_date">Data de publicació:</label>
                    <input type="date" name="publication_date" id="publication_date" required>
                </p>

                <p>
                    <label for="image">Caràtula:</label>
                    <input type="file" name="image" id="image" required>
                </p>

                <p>
                    <input type="submit" value="Afegir pel·licula">
                </p>
            </form> 
            <!-- <div id="uploaded-image-preview">
                <script src="show_img.js"></script>
                <img src="" alt="preview-image">
            </div> -->
        </aside>
    </body>
</html>


