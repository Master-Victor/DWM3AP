<?php

class Alerta{
    public function add_alerta($mensaje, $tipo){
        $_SESSION['alerta'] = [
            'mensaje' => $mensaje,
            'tipo' => $tipo
        ];
    }

    public function mostrar(){
        if( isset($_SESSION['alerta']) ){
            $alerta = $_SESSION['alerta'];
            unset($_SESSION['alerta']);
            //return "<div class='alert alert-{$alerta['tipo']}'>{$alerta['mensaje']}</div>";
            return $_SESSION['alerta']["mensaje"];
        }
    }

    public function limpiar_alerta(){
        if( isset($_SESSION['alerta']) ){
            unset($_SESSION['alerta']);
        }
    }
}