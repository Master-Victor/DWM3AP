<?php

require_once "../libraries/funciones.php";
require_once "../class/Conexion.php";
require_once "../class/Guionista.php";
require_once "../class/Artista.php";
require_once "../class/Comic.php";
require_once "../class/Personaje.php";



$seccion = isset($_GET["sec"]) ? $_GET["sec"] : "dashboard"; //dashboard envios quienes_somos

$vistas = "404";

$seccionesValidas = [
    "dashboard" => [
        "titulo" => "Bienvenidos"
    ],
    "admin_personajes" => [
        "titulo" => "Administración de Personajes"
    ],
    "add_personaje" =>[
        "titulo" => "Agregar Personaje"
    ],
    "edit_personaje" =>[
        "titulo" => "Editar Personaje"
    ],
    "delete_personaje" => [
        "titulo" => "Eliminar Personaje"
    ]
];

if (array_key_exists($seccion, $seccionesValidas)) {
    $vistas = $seccion;
    $titulo = $seccionesValidas[$seccion]["titulo"];
} else {
    $vistas = "404";
    $titulo = "Pagina no encontrada";
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Tiendita de Comics: <?= $titulo ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <link href="css/styles.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-info bg-info">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">La Tiendita de Comics</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php?sec=dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php?sec=admin_personajes">admin personajes</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container">
        <?php
        file_exists("views/$vistas.php")
            ? require  "views/$vistas.php"
            : require "views/404.php"
        ?>
    </main>
    <footer class="bg-secondary text-light text-center">
        2023
    </footer>
</body>

</html>