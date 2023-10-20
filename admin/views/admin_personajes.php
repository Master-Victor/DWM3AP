<?php

$personajes = (new Personaje())->lista_completa();

?>
<div class="row my-5">
    <div class="col">
        <h1 class="text-center mb-5 fw-bold">Administración de Personajes</h1>
        <div class="row mb-5 d-flex align-items-center">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Alias</th>
                        <th scope="col">Creador</th>
                        <th scope="col">Biografía</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($personajes as $p) { ?>
                        <tr>
                            <th scope="col"> <?= $p->getId() ?> </th>
                            <td><?= $p->getNombre() ?></td>
                            <td><?= $p->getAlias () ?></td>
                            <td><?= $p->getCreador() ?></td>
                            <td><?= $p->getBiografia() ?></td>
                            <td>
                                <a href="index.php?sec=edit_personaje&id=<?= $p->getId() ?>" role="button" class="btn btn-sm btn-warning">Editar personaje</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <a href="index.php?sec=add_personaje" class="btn btn-primary mt-5"> Cargar nuevo personaje</a>
        </div>
    </div>
</div>