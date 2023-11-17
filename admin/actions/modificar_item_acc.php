<?php

require_once "../../libraries/autoload.php";
$cantidades = $_GET["cantidad"];

if( !empty( $cantidades ) ){
    ( new Carrito() )->modificar_cantidad($cantidades);
    (new Alerta())->add_alerta("Se pudo modificar", "success");
    header("Location: ../../index.php?sec=carrito");
}else{
    (new Alerta())->add_alerta("No se pudo modificar", "danger");
    header("Location: ../../index.php?sec=carrito");
}