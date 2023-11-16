<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">La Tiendita de Comics</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php?sec=home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?sec=quienes_somos">¿Quienes somos?</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?sec=catalogo_completo">Todos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?sec=comics&&serie=1">Iron Man</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?sec=comics&&serie=2">Batman</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?sec=comics&&serie=3">Wonder Woman</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?sec=envios">Envios</a>
                </li>
                <li>
                    <a class="nav-link active <?= isset($_SESSION["loggedIn"]) ? "d-none" : ""  ?>" href="index.php?sec=login">Login</a>
                </li>
                <li>
                    <a class="nav-link active <?= isset($_SESSION["loggedIn"]) ? "" : "d-none"  ?>" href="admin/actions/auth_logout.php">Salir</a>
                </li>
            </ul>
        </div>
    </div>
</nav>