<?php

require_once "libraries/funciones.php";
require_once "class/Conexion.php";
require_once "class/Guionista.php";
require_once "class/Artista.php";
require_once "class/Comic.php";



$seccion = isset($_GET["sec"]) ? $_GET["sec"] : "home"; //home envios quienes_somos

$vistas = "404";

$seccionesValidas = [
    "home" => [
        "titulo" => "Bienvenidos"
    ],
    "envios" => [
        "titulo" => "Envios"
    ],
    "quienes_somos" => [
        "titulo" => "Quienes Somos?"
    ],
    "404" => [
        "titulo" => "Pagina no encontrada"
    ],
    "comics" => [
        "titulo" => "Comics"
    ],
    "comic" => [
        "titulo" => "Detalle del comic"
    ],
    "catalogo_completo" => [
        "titulo" => "Todos los Comics"
    ]    
];

if( array_key_exists($seccion, $seccionesValidas) ){
    $vistas = $seccion;
    $titulo = $seccionesValidas[$seccion]["titulo"];
} else{
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

    <?php require_once "includes/nav.php" ?>

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