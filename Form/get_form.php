<?php 
    // namespace Movies\Form;
    
    // A partir de tota aquesta informació s'hauria de pujar a la bd

    // S'han de fer verificacions
    $title = $_POST['title'];
    $description = $_POST['description'];
    $score = $_POST['score']; // if $_POST['score'] == null, entrar null a la bd 
    $publication_date = $_POST['publication_date'];

    $image_name = $_FILES['image']['name'];
    $origin_path = $_FILES['image']['tmp_name'];

    if(isImage($origin_path)){
        $destination_path = $_SERVER['DOCUMENT_ROOT'] . '/img/';
        move_uploaded_file($origin_path, $destination_path . $image_name);
    }

// Check if file uploaded is an image
function isImage($img)
{
    $check = getimagesize($img);
    if($check == false) {
        return 'File is not an image.';
    }
    return true;
}

?>