<?PHP
require_once "../../functions/autoload.php";

$postData = $_POST;
$fileData = $_FILES['imagen'];


try {

    // echo "<pre>";
    // print_r($fileData);
    // echo "</pre>";

    //empty retorna true en caso que tengamos false, null, 0, "" ó []
    
    $imagen = (new Imagen())->subirImagen(__DIR__ . "/../../img/personajes", $fileData);
    (new Personaje())->insert(
        $postData['nombre'], 
        $postData['alias'], 
        $postData['creador'], 
        $postData['primera_aparicion'], 
        $postData['bio'], 
        $imagen
    );
    header('Location: ../index.php?sec=admin_personajes');
   

} catch (\Exception $e) {
    echo "<pre>";
    print_r($e->getMessage());
    echo "<pre>";
    die("No se pudo cargar el personaje =(");
}
