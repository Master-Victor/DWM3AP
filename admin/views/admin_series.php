<?PHP
$series = (new Serie())->lista_completa();

?>
<div class="row my-5">
    <div class="col">

        <h1 class="text-center mb-5 fw-bold">Administración de Series</h1>
        <div class="row mb-5 d-flex align-items-center">


            <table class="table">
                <thead>
                    <tr>
                        
                        <th scope="col">Nombre</th>
                        <th scope="col">Historia</th>
                 
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?PHP foreach ($series as $P) { ?>
                        <tr>
                            
                            <th scope="row"><?= $P->getNombre() ?></th>
                            <td><?= $P->getHistoria() ?></td>
                            <td>
                                <a href="index.php?sec=edit_serie&id=<?= $P->getId() ?>" role="button" class="d-block btn btn-sm btn-warning mb-1">Editar</a>
                                <a href="index.php?sec=delete_serie&id=<?= $P->getId() ?>" role="button" class="d-block btn btn-sm btn-danger">Eliminar</a>
                            </td>
                        </tr>
                    <?PHP } ?>
                </tbody>
            </table>

            <a href="index.php?sec=add_personaje" class="btn btn-primary mt-5"> Cargar nueva serie</a>
        </div>


    </div>
</div>