<?php

require_once "../../libraries/autoload.php";

$postData = $_POST;

try {
    $existe = (new Autentiticacion())->log_in($postData["username"], $postData["pass"]);
    if($existe) {
        if( $_SESSION["loggedIn"]["roles"] == "admin" || $_SESSION["loggedIn"]["roles"] == "superadmin"){
            header('Location: ../index.php?sec=admin_comics');
        }else{
            header('Location: ../../index.php');
        }
    } 
    else {
        print_r($existe);
        header('Location: ../index.php?sec=login');
        (new Alerta())->add_alerta("Usuario o contraseña incorrectos", "danger");
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
