<?php
require_once '../../class/Conexion.php';
require_once '../../class/Personaje.php';

$postData = $_POST;
$id = $_GET["id"] ?? false;

echo "<pre>";
print_r($postData);
echo "</pre>";

if(!$id){
    header("Location: ../index.php?sec=admin_personajes");
}

try {
    (new Personaje())->edit($postData["nombre"], $postData["alias"], $postData["creador"], intval($postData["primera_aparicion"]), $postData["biografia"],"POR_AHORA_NO_IMPORTA", $id);
    //header('Location: ../index.php?sec=admin_personajes');
} catch (\Throwable $th) {
    print_r($th);
    die("Error al editar personaje");
}
