<?PHP
require_once "../../functions/autoload.php";

$id = $_GET['id'] ?? FALSE;
$personaje = (new Personaje())->get_x_id($id);

try {
    if(!empty($personaje->getImagen())){
        (new Imagen())->borrarImagen(__DIR__ . "/../../img/personajes/" . $personaje->getImagen());
    }
    $personaje->delete();
    
    
    header('Location: ../index.php?sec=admin_personajes');
} catch (\Exception $e) {
    echo "<pre>";
    print_r($e->getMessage());
    echo "<pre>";
   die("No se pudo eliminar el personaje =(");

}

