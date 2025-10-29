<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../css-admin/main.css">
    <?php
        include_once("../librerias/bootstrap-css.php");
    ?>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link active" aria-current="page" href="../admin/tratamientos.php">Tratamientos</a>
                        <a class="nav-link" href="../admin/pacientes.php">Pacientes</a>
                        <a class="nav-link" href="../admin/administradores.php">Administradores</a>
                        <a class="nav-link" href="../log/cerrarSesion.php">Cerrar Sesion</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>