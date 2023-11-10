<?php
require_once "../../libraries/autoload.php";
echo "<pre>";
print_r($_GET);
echo "</pre>";
$id = $_GET["id"] ?? false;
echo $id;
try {
    if( !$id ) header('Location: ../index.php?sec=admin_comics');
    $comic = (new Comic())->catalogo_x_id($id);
    $comic->clear_personajes_sec($id);
    $comic->delete();
    header('Location: ../index.php?sec=admin_comics');
} catch (Exception $e) {
    echo $e->getMessage();
    header('Location: ../index.php?sec=admin_comics');
    die();
}