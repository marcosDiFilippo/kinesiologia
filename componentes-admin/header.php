<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <?php 
        $linkCss = "<link rel='stylesheet' href='../css-admin/main.css'>";
        $rutaAbml = false;
        $rutaTratamientos;
        $rutaPacientes;
        $rutaAdministradores;
        $rutaCerrarSesion;

        if (str_contains($_SERVER["PHP_SELF"], "abml")) {
            include_once("../../librerias/bootstrap-css.php");
            $rutaTratamientos = "../tratamientos.php";
            $rutaPacientes = "../pacientes.php";
            $rutaAdministradores = "../administradores.php";
            $rutaCerrarSesion = "../../log/cerrarSesion.php";

            $rutaAbml = true;
            $linkCss = "<link rel='stylesheet' href='../../css-admin/main.css'>";
        }
        else {
            include_once("../librerias/bootstrap-css.php");
            $rutaTratamientos = "../admin/tratamientos.php";
            $rutaPacientes = "../admin/pacientes.php";
            $rutaAdministradores = "../admin/administradores.php";
            $rutaCerrarSesion = "../log/cerrarSesion.php";
        }
        echo $linkCss;
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
                        <a class="nav-link active" aria-current="page" href=<?php echo $rutaTratamientos?>>Tratamientos</a>
                        <a class="nav-link" href=<?php echo $rutaPacientes?>>Pacientes</a>
                        <a class="nav-link" href=<?php echo $rutaAdministradores?>>Administradores</a>
                        <a class="nav-link" href=<?php echo $rutaCerrarSesion?>>Cerrar Sesion</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>