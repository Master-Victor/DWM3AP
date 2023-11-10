<?php

class Autentiticacion{
    public function log_in($username, $password){
        $datosUsuario = (new Usuario())->usuario_x_username($username);
        print_r($datosUsuario);
        if( $datosUsuario ){
            //if( password_verify( $password, $datosUsuario->getPassword()) ){
                if( $password === $datosUsuario->getPassword() ){ 
                $datosLogin['username'] = $datosUsuario->getNombre_usuario();
                $datosLogin['id'] = $datosUsuario->getId();
                $datosLogin['rol'] = $datosUsuario->getRol();
                $_SESSION['loggedIn'] = $datosLogin;   
                return true;             
            }
        }else{
            echo "No encontre NADA!";
            return false;
        }

    }
}