<?php
    require_once "../../libraries/autoload.php";
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    try {
        $username = $_POST['username'];
        $password = $_POST['pass'];
        $autenticacion = new Autentiticacion();
        $autenticacion->registar($username, $password);
        header("Location: ../index.php?sec=login");
    } catch (Exception $e) {
        echo $e->getMessage();
    }