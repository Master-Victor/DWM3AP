<?php
require_once '../../class/Conexion.php';
require_once '../../class/Personaje.php';

echo "<pre>";
print_r($_POST);
echo "</pre>";

try {
    (new Personaje)->insert($_POST["nombre"],$_POST["alias"],$_POST["creador"],$_POST["primera_aparicion"],$_POST["biografia"],"TODAVIA_NO_IMPORTA.jpg");
    header("Location: ../index.php?sec=admin_personajes");
} catch (\Throwable $th) {
    die("Error al insertar personaje");
}

