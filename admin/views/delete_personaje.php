<?PHP
$id = $_GET['id'] ?? FALSE;
$personaje = (new Personaje())->get_x_id($id);
?>
<div class="row my-5 g-3">
<h1 class="text-center mb-5 fw-bold">¿Está seguro que desea eliminar este personaje?</h1>
	<div class="col-12 col-md-6">
		<img src="../img/personajes/<?= $personaje->getImagen() ?>" alt="Imágen Illustrativa de <?= $personaje->getNombre() ?>" class="img-fluid rounded shadow-sm d-block mx-auto mb-3">
	</div>
	<div class="col-12 col-md-6">
		

			<h2 class="fs-6">Nombre</h2>
			<p><?= $personaje->getNombre() ?></p>

			<h2 class="fs-6">Alias</h2>
			<p><?= $personaje->getAlias() ?></p>
			<h2 class="fs-6">Creador</h2>
			<p><?= $personaje->getCreador() ?></p>
			<h2 class="fs-6">Primera Aparicion</h2>
			<p><?= $personaje->getPrimeraAparicion() ?></p>
			<h2 class="fs-6">Biografía</h2>
			<p><?= $personaje->getBiografia() ?></p>

			<a href="actions/delete_personaje_acc.php?id=<?= $personaje->getId() ?>" role="button" class="d-block btn btn-sm btn-danger mt-4">Eliminar</a>
	</div>

</div>