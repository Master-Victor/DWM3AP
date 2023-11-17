<?php

    class Carrito{
        public function add_item(int $id, int $cantidad){
            $itemData = (new Comic())->catalogo_x_id($id);
            if( $itemData ){
                $_SESSION["carrito"][$id] = [
                    'producto' => $itemData->getTitulo(),
                    'portada' => $itemData->getPortada(),
                    'precio' => $itemData->getPrecio(),
                    'cantidad' => $cantidad
                ];
            }
        }
        public function get_carrito(){
            if( !empty($_SESSION["carrito"]) ){
                return $_SESSION["carrito"];
            } else{
                return [];
            }
        }

        public function eliminar_item($id){
            if( isset($_SESSION["carrito"][$id]) ){
                unset($_SESSION["carrito"][$id]);
            }
        }

        public function modificar_cantidad(array $cantidades){
            echo "<pre>";
            print_r($_SESSION);
            echo "</pre>";
            foreach( $cantidades as $key => $cantidad ){
                if( $_SESSION["carrito"][$key] ){
                    $_SESSION["carrito"][$key]["cantidad"] = $cantidad;
                }
            }
        }
    }