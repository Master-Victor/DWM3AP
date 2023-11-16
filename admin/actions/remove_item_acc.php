<?php
    require_once "../../libraries/autoload.php";
    $id = $_GET["id"] ?? false;

    if($id){
        (new Carrito())->eliminar_item($id);
        (new Alerta())->add_alerta("Se elimino el comic", "success");
        header("Location: ../../index.php?sec=carrito");
    }