<?php

require_once "../libraries/autoload.php";

$seccion = isset($_GET["sec"]) ? $_GET["sec"] : "dashboard"; //dashboard envios quienes_somos

$vistas = "404";

$seccionesValidas = [
    "dashboard" => [
        "titulo" => "Bienvenidos"
    ],
    "admin_personajes" => [
        "titulo" => "Administración de Personajes"
    ],
    "admin_series" => [
        "titulo" => "Administración de Series"
    ],    
    "admin_artistas" => [
        "titulo" => "Administración de Artistas"
    ],
    "admin_guionistas" => [
        "titulo" => "Administración de Guionistas"
    ],  
    "admin_comics" => [
        "titulo" => "Administración de Comics"
    ],         
    "add_personaje" =>[
        "titulo" => "Agregar Personaje"
    ],
    "add_comic" =>[
        "titulo" => "Agregar Comic"
    ],    
    "edit_personaje" =>[
        "titulo" => "Editar Personaje"
    ],
    "edit_comic" =>[
        "titulo" => "Editar comic"
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
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
                        <a class="nav-link active" href="index.php?sec=admin_personajes">Personajes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php?sec=admin_comics">Comics</a>
                    </li>                    
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php?sec=admin_series">Series</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php?sec=admin_guionistas">Guionistas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php?sec=admin_artistas">Artistas</a>
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