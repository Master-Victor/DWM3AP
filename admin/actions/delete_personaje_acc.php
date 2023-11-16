<?php
require_once "../../libraries/autoload.php";
$id = $_GET["id"] ?? false;
$personaje = (new Personaje())->get_x_id($id);

try {
    $personaje->delete($id);
    if(!empty($personaje->getImagen())){
        Imagen::borrarImagen(__DIR__ . "/../../img/personajes/" . $personaje->getImagen());
    }
    (new Alerta())->add_alerta("Se pudo Eliminar Personaje", "success");
    header('Location: ../index.php?sec=admin_personajes');
} catch (Exception $e) {
    echo $e->getMessage();
    die("Error al eliminar personaje");
}
