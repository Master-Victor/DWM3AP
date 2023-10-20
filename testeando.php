<?PHP
    include_once 'class/Conexion.php';
    include_once 'class/Personaje.php';
    //echo "intentando conectar";
    $conexion = new Conexion();
    (new Personaje)->insert("bruce","batman","creador",1990,"biografia","imagen.jpg");
    //echo "Conectado";