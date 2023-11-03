<?PHP
$guionistas = (new Guionista())->lista_completa();

?>
<div class="row my-5">
    <div class="col">

        <h1 class="text-center mb-5 fw-bold">Administración de Guionistas</h1>
        <div class="row mb-5 d-flex align-items-center">


            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" width="15%">Imágen</th>
                        <th scope="col">Nombre</th>
                        <th scope="col" width="45%">Biografia</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?PHP foreach ($guionistas as $G) { ?>
                        <tr>
                            <td><img src="../img/guionistas/<?= $G->getFotoPerfil() ?>" alt="Imágen Illustrativa de <?= $G->getNombreCompleto() ?>" class="img-fluid rounded shadow-sm"></td>
                            <td><?= $G->getNombreCompleto() ?></td>
                            <td><?= $G->getBiografia() ?></td>
                            <td>
                                <a href="index.php?sec=edit_personaje&id=<?= $G->getId() ?>" role="button" class="d-block btn btn-sm btn-warning mb-1">Editar</a>
                                <a href="index.php?sec=delete_personaje&id=<?= $G->getId() ?>" role="button" class="d-block btn btn-sm btn-danger">Eliminar</a>
                            </td>
                        </tr>
                    <?PHP } ?>
                </tbody>
            </table>

            <a href="index.php?sec=add_personaje" class="btn btn-primary mt-5"> Cargar nuevo guionista</a>
        </div>


    </div>
</div>