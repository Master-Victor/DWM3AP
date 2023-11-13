<?php

class Autentiticacion{
    public function log_in($username, $password){
        $datosUsuario = (new Usuario())->usuario_x_username($username);
        print_r($datosUsuario);
        if( $datosUsuario ){
            if( password_verify( $password, $datosUsuario->getPassword()) ){
                //if( $password === $datosUsuario->getPassword() ){ 
                $datosLogin['username'] = $datosUsuario->getNombre_usuario();
                $datosLogin['id'] = $datosUsuario->getId();
                $datosLogin['roles'] = $datosUsuario->getRol();
                $_SESSION['loggedIn'] = $datosLogin;   
                return true;             
            }
        }else{
            (new Alerta())->add_alerta("Usuario o contraseña incorrectos", "danger");
            return false;
        }

    }

    public function registar($username, $password){
        $datosUsuario = (new Usuario())->usuario_x_username($username);
        if( $datosUsuario ){
            return false;
        }else{
            $usuario = new Usuario();
            $usuario->setNombreUsuario($username);
            $usuario->setPassword(password_hash($password, PASSWORD_DEFAULT));
            $usuario->setRoles("usuario");
            $usuario->guardar();
            return true;
        }
    }

    function verify(){
        if( isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']['roles'] == "admin"  ){
            return true;
        }else{
            header("Location: ../index.php");
        }
    }

    public function log_out(){
        if( isset($_SESSION['loggedIn']) ){
            unset($_SESSION['loggedIn']);
        }
        header("Location: ../index.php");
    }
}