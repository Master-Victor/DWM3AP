<?php

$id = $_GET["id"] ?? false;

try {
    (new Personaje())->delete($id);
    header('Location: ./index.php?sec=admin_personajes');
} catch (\Throwable $th) {
    die("Error al eliminar personaje");
}
