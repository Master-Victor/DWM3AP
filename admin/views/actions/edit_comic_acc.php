<?PHP
require_once "../../functions/autoload.php";

$postData = $_POST;
$fileData = $_FILES['portada'] ?? FALSE;
$id = $_GET['id'] ?? FALSE;

echo "<pre>";
print_r($postData);
echo "</pre>";

try {
    $comic = new Comic();

    $comic->clear_personajes_sec($id);

    if (isset($postData['personajes_secundarios'])) {
        foreach ($postData['personajes_secundarios'] as $personaje_id) {
            $comic->add_personajes_sec($id, $personaje_id);
        }
    }


    if (!empty($fileData['tmp_name'])) {
        if (!empty($postData['portada_og'])) {
            (new Imagen())->borrarImagen(__DIR__ . "/../../img/covers/" . $postData['portada_og']);
        }
        $imagen = (new Imagen())->subirImagen(__DIR__ . "/../../img/covers", $fileData);
        $comic->reemplazar_imagen($imagen, $id);
    }

    $comic->edit(
        $postData['titulo'],
        $postData['personaje_principal_id'],
        $postData['serie_id'],
        $postData['guionista_id'],
        $postData['artista_id'],
        $postData['volumen'],
        $postData['numero'],
        $postData['publicacion'],
        $postData['origen'],
        $postData['editorial'],
        $postData['bajada'],
        $postData['precio'],
        $id
    );
    header('Location: ../index.php?sec=admin_comics');
    /**/
} catch (\Exception $e) {
    echo "<pre>";
    print_r($e->getMessage());
    echo "<pre>";
    die("No se pudo editar el personaje =(");
}
