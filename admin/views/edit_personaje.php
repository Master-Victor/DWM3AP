<?php

$id = $_GET["id"] ?? false;
if (!$id) {
    header("Location: index.php?sec=admin_personajes");
}
$personaje = (new Personaje())->get_x_id($id);

?>

<div class="row my-5">
    <div class="col">
        <h1 class="text-center mb-5 fw-bold">Editar un Personaje</h1>
        <div class="row mb-5 d-flex align-items-center">
        </div>

        <form class="row g-3" action="actions/edit_personaje_acc.php?id=<?= $personaje->getId() ?>" method="post" enctype="multipart/form-data">
            <div class="col-md-6 mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input value="<?= $personaje->getNombre() ?>" type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="alias" class="form-label">Alias</label>
                <input value="<?= $personaje->getAlias() ?>" type="text" class="form-control" id="alias" name="alias" required>
            </div>
            <div class="col-md-2 mb-3">
                <label for="imagen" class="form-label">Imágen actual</label>
                <img src="../img/personajes/<?= $personaje->getImagen() ?>" alt="Imágen Illustrativa de <?= $personaje->getNombre() ?>" class="img-fluid rounded shadow-sm d-block">
                <input class="form-control" type="hidden" id="imagen_og" name="imagen_og" value="<?= $personaje->getImagen() ?>">
            </div>
            <div class="col-md-4 mb-3">
                <label for="imagen" class="form-label">Reemplazar Imagen</label>
                <input class="form-control" type="file" id="imagen" name="imagen">
            </div>
            <div class="col-md-6 mb-3">
                <label for="primera_aparicion" class="form-label">Primera Aparicion</label>
                <input value="<?= $personaje->getPrimeraAparicion() ?>" type="number" class="form-control" id="primera_aparicion" name="primera_aparicion" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="creador" class="form-label">Creador(es)</label>
                <input value="<?= $personaje->getCreador() ?>" type="text" class="form-control" id="creador" name="creador" required>
            </div>
            <div class="col-md-12 mb-3">
                <label for="biografia" class="form-label">Biografia</label>
                <textarea class="form-control" id="biografia" name="biografia" rows="3" required>
                    <?= $personaje->getBiografia() ?>
                </textarea>
            </div>

            <button type="submit" class="btn btn-primary">Editar</button>
        </form>

    </div>