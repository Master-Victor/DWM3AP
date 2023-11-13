<?php
    //require_once "includes/productos.php";
    require_once "libraries/funciones.php";
    //require_once "libraries/productos.php";

    $serieSeleccionada = isset($_GET["serie"]) ?  $_GET["serie"] : false;
    $comics = [];
    if($serieSeleccionada){
        //$comics = isset($productos[$serieSeleccionada]) ? $productos[$serieSeleccionada] : [];
        $comics = (new Comic())->catalogo_x_personaje(intval($serieSeleccionada));
    }

?>

<?php if( count($comics) > 0 ){ ?>

<h1 class="text-center my-5"> Comics de <?= $serieSeleccionada ?></h1>

<div class="row">
<?php foreach( $comics as $comic ) {?>
    <div class="col-3">
        <div class="card mb-3">
            <img src="img/covers/<?= $comic->getPortada() ?>" class="card-img-top" alt="Portada de <?=$comic->nombre_completo()?>">
            <div class="card-body">
                <p class="fs-6 m-0 fw-bold text-danger"><?=$comic->nombre_completo()?></p>
                <h5 class="card-title"> <?= $comic->getTitulo(); ?> </h5>
                <p class="card-text"><?= $comic->bajada_reducida(15) ?></p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Guion: <?= $comic->getGuionista() ?></li>
                <li class="list-group-item">Arte: <?= $comic->getArte() ?></li>
                <li class="list-group-item"><?= $comic->getPublicacion() ?></li>
            </ul>
            <div class="card-body">
                <div class="fs-3 mb-3 fw-bold text-center text-danger">$<?= $comic->precio_formateado() ?></div>
                <a href="index.php?sec=comic&id=<?= $comic->getId()?>" class="btn btn-danger w-100 fw-bold">Ver mas</a>
            </div>

        </div>
    </div>


<?php }?>
<?php }else{ ?>

    <h1>No se encontro el comic</h1>

<?php }?>