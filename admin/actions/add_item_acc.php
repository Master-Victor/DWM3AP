<?php
    require_once "../../libraries/autoload.php";
    $id = $_GET["id"] ?? false;
    $cantidad = $_GET["q"] ?? 1;
     if($id){
         (new Carrito())->add_item($id, $cantidad);
         header("location: ../../index.php?sec=carrito");
     }