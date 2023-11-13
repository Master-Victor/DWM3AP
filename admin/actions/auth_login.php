<?php

require_once "../../libraries/autoload.php";

$postData = $_POST;
echo "<pre>";
print_r($postData);
echo "</pre>";
try {
    $existe = (new Autentiticacion())->log_in($postData["username"], $postData["pass"]);
    if($existe) header('Location: ../index.php?sec=admin_comics');
    else {
        header('Location: ../index.php?sec=login');
        (new Alerta())->add_alerta("Usuario o contraseña incorrectos", "danger");
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
