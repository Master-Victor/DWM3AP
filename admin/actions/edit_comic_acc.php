<?php
require_once "../../libraries/autoload.php";
$fileData = $_FILES ?? FALSE;
$id = $_GET['id'] ?? FALSE;
$imagen = "";
$personajes_secundarios = $_POST['personajes_secundarios'] ?? false;
try {
    $comic = new Comic();
        if(!empty($fileData['portada_og'])){
            Imagen::borrarImagen(__DIR__ . "/../../img/covers/" . $fileData['portada_og']);
        }
        if(!empty($_POST['personajes_secundarios'])){
            $comic->clear_personajes_sec($id);
            foreach( $personajes_secundarios as $personaje_id ){
                echo "intente agregar";
                $comic->add_personajes_sec($id, $personaje_id);
              }
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
    echo "<pre>";
    print_r($_FILES);
    echo "</pre>";
    if( $_FILES["imagen"]["size"] > 0){
        $imagen = Imagen::subirImagen($_FILES, __DIR__ . "/../../img/covers"); 
    }
    (new Alerta())->add_alerta("Se pudo modificar Comic", "success");
    header('Location: ../index.php?sec=admin_comics');
} catch ( Exception $e) {
    echo "<pre>";
    print_r($e->getMessage());
    echo "<pre>";
}
