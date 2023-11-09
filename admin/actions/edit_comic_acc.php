<?php
require_once "../../libraries/autoload.php";
echo "<pre>";
print_r($_POST['personajes_secundarios']);
echo "</pre>";
$fileData = $_FILES ?? FALSE;
$id = $_GET['id'] ?? FALSE;
$imagen = "";
$personajes_secundarios = $_POST['personajes_secundarios'];
try {
    $comic = new Comic();
        if(!empty($fileData['portada_og'])){
            Imagen::borrarImagen(__DIR__ . "/../../img/covers/" . $fileData['portada_og']);
        }
        $comic->clear_personajes_sec($id);
      foreach( $personajes_secundarios as $personaje_id ){
        echo "intente agregar";
        $comic->add_personajes_sec($id, $personaje_id);
      }
    $comic->edit(
        $_POST['titulo'],
        $_POST['personaje_principal_id'],
        $_POST['serie_id'],
        $_POST['guionista_id'],
        $_POST['artista_id'],
        $_POST['volumen'],
        $_POST['numero'],
        $_POST['publicacion'],
        $_POST['origen'],
        $_POST['editorial'],
        $_POST['bajada'],
        $imagen,
        $_POST['precio'],
        $id
    );
    if(!empty($_FILES["imagen"])){
        $imagen = Imagen::subirImagen($_FILES, __DIR__ . "/../../img/covers"); 
    }
} catch ( Exception $e) {
    echo "<pre>";
    print_r($e->getMessage());
    echo "<pre>";
}

?>