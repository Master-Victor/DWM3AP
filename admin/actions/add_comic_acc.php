<?php
require_once "../../libraries/autoload.php";

$postData = $_POST;

try{
    $comic = new Comic();
    $imagen = Imagen::subirImagen($_FILES, __DIR__ . "/../../img/covers");
    $comic->insert(
        $postData['titulo'],
        $postData['personaje_principal_id'],
        $postData['serie_id'],
        $postData['guionista_id'],
        $postData['artista_id'],
        $postData['volumen'],
        $postData['numero'],
        $postData['publicacion'],
        $postData['origen'],
        $postData['editorial'],
        $postData['bajada'],
        $imagen,
        $postData['precio']
    );
    header('Location: ../index.php?sec=admin_comics');
}catch( Exception $e ){
    echo "<pre>";
    print_r($e->getMessage());
    echo "<pre>";
    die("No se pudo cargar el personaje =(");
}

