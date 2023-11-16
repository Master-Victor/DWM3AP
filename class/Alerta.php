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
            $html = "<div class='alert alert-".$alerta['tipo']." alert-dismissible fade show' role='alert'>";
            $html .= "<strong>".$alerta['mensaje']."</strong> ";
            $html .= "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>";
            $html .= "</div>";
            return $html;
        }
    }

    public function limpiar_alerta(){
        if( isset($_SESSION['alerta']) ){
            unset($_SESSION['alerta']);
        }
    }
}