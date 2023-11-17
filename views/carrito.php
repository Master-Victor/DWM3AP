<?php
$carrito = (new Carrito())->get_carrito();
?>

<h1 class="text-center fs-2 my-5">Mis compras</h1>
<div> <?= (new Alerta())->mostrar() ?> </div>
<table class="table">
    <thead>
        <tr>
            <th scope="col" width="15%">Portada</th>
            <th scope="col">Datos del producto</th>
            <th scope="col">Precio por Unidad</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Subtotal</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($carrito as $key => $value) { ?>
            <form action="admin/actions/modificar_item_acc.php" method="get">
                <tr>
                    <td> <img class="img-fluid" src="img/covers/<?= $value["portada"] ?>" alt=""> </td>
                    <td class="align-middle"> <?= $value["producto"] ?> </td>
                    <td class="align-middle"> <?= $value["precio"] ?> </td>
                    <td class="align-middle">
                        <label for="cantidad_<?= $key ?>" class="visually-hidden">Cantidad</label>
                        <input type="number" class="form-control" value="<?= $value['cantidad'] ?>" id="cantidad_<?= $key ?>" name="cantidad[<?= $key ?>]">
                    </td>
                    <td class="align-middle"><?= $value["precio"] * $value["cantidad"] ?></td>
                    <td class="align-middle">
                        <a href="admin/actions/remove_item_acc.php?id=<?= $key ?>" class="btn btn-sm btn-danger">Eliminar</a>
                        <input type="submit" class="btn btn-sm btn-warning" value="Modificar" />
                    </td>
            </form>
            </tr>
        <?php  } ?>
    </tbody>
</table>