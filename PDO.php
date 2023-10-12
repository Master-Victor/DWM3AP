<?php
    //define("DB_SERVER", "localhost");
    const DB_SERVER = "localhost:3463";
    //define("DB_USER", "root");
    const DB_USER = "root";
    //define("DB_PASS", "");
    const DB_PASS = "";
    //define("DB_NAME", "tiendita");
    const DB_NAME = "tiendita";

    const DB_DSN = "mysql:host=".DB_SERVER.";dbname=".DB_NAME.";charset=utf8mb4";
    //mysqli
    try{
        $conexion = new PDO(DB_DSN, DB_USER,DB_PASS);
        //algo que puede fallar
    }catch(Exception $e){
        echo $e->getMessage();
        echo "me rompi";
        die("ultimas palabras"); //exit
    }

    echo "cargando datos";

    $query = "SELECT * FROM comics";

    $PDOStatement = $conexion->prepare($query);
    $PDOStatement->setFetchMode(PDO::FETCH_ASSOC);
    $PDOStatement->execute();
    $datos = $PDOStatement->fetchAll();
/*    while( $dato = $PDOStatement->fetch() ){
    echo "<pre>";
    print_r($dato);
    echo "</pre>";        
    }*/
    echo "<pre>";
    print_r($datos);
    echo "</pre>";   
    
