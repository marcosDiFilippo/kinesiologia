<?php 
    session_start();
    if ($_SESSION == NULL) {
        header("Location: ../index.php");
        exit();
    }
    if ($_SESSION["fk_rol"] == 3) {
        header("Location: ../index.php");
        exit();
    }
    include_once("../admin/abml/lectura.php");
    include_once("../componentes/config/config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $seccion ?></title>

    <link rel="icon" type="image/x-icon" href="../imagenes/logo-kine.ico">   
    <?php 
        $cssPaginas = "";
        if ($seccion == "Sesiones") {
            $cssPaginas = "<link rel='stylesheet' href='../css-admin/sesiones.css'>";
        }
        else if ($seccion == "Pacientes") {
            $cssPaginas = "<link rel='stylesheet' href='../css-admin/pacientes.css'>";
        }
        echo $cssPaginas;

        $linkCss = "<link rel='stylesheet' href='../css-admin/main.css'>";
        $rutaIndex;
        $rutaAbml = false;
        $rutaTodasSesiones;
        $rutaTratamientos;
        $rutaPacientes;
        $rutaAdministradores;
        $rutaCerrarSesion;
        $rutaSesiones;

        if (str_contains($_SERVER["PHP_SELF"], "abml")) {
            include_once("../../librerias/bootstrap-css.php");
            $rutaIndex = "../index.php";
            $rutaTodasSesiones = "../sesiones-completas.php";
            $rutaTratamientos = "../tratamientos.php";
            $rutaPacientes = "../pacientes.php";
            $rutaAdministradores = "../administradores.php";
            $rutaCerrarSesion = "../../log/cerrarSesion.php";
            $rutaSesiones = "../sesiones.php";

            $rutaAbml = true;
            $linkCss = "<link rel='stylesheet' href='../../css-admin/main.css'>";
        }
        else {
            include_once("../librerias/bootstrap-css.php");
            $rutaIndex = "../admin/index.php";
            $rutaTodasSesiones = "../admin/sesiones-completas.php";
            $rutaTratamientos = "../admin/tratamientos.php";
            $rutaPacientes = "../admin/pacientes.php";
            $rutaAdministradores = "../admin/administradores.php";
            $rutaCerrarSesion = "../log/cerrarSesion.php";
            $rutaSesiones = "../admin/sesiones.php";
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
                    <div class="navbar-nav d-flex align-items-center">
                        <a href="<?php echo $rutaIndex?>">
                            <img class="logo" src="../imagenes/logo-kine.webp" alt="Inicio">
                        </a>
                        <a class="nav-link active" aria-current="page" href=<?php echo $rutaTratamientos?> >Tratamientos</a>
                        <a class="nav-link" href=<?php echo $rutaPacientes?> >Pacientes</a>
                        <a class="nav-link" href=<?php echo $rutaSesiones?> >Sesiones</a>
                        <a class="nav-link" href=<?php echo $rutaAdministradores?> >Administradores</a>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <button class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Sesiones por tratamiento
                                    </button>
                                    <ul class="dropdown-menu">
                                        <?php
                                            $tratamientos = mysqli_query($conexion, $lecturaTratamientos);
                                            
                                            while ($tratamiento = mysqli_fetch_array($tratamientos)) {
                                                $conteoTratamientos = mysqli_query($conexion,"SELECT COUNT(`fk_tratamientos`) FROM `sesiones_tratamientos` WHERE `fk_tratamientos`='$tratamiento[id_tratamientos]'");
                                                
                                                while ($c = mysqli_fetch_array($conteoTratamientos))
                                                {
                                                    echo "<li class='d-flex align-items-center'>
                                                    <a class='dropdown-item' href='../admin/sesiones-completas.php?id=$tratamiento[id_tratamientos]'>
                                                    $tratamiento[nombre]
                                                    </a>
                                                    <small class='me-4'>($c[0])</small>
                                                    </li>";
                                                }
                                            }
                                        ?>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <a class="nav-link" href=<?php echo $rutaCerrarSesion?> >Cerrar Sesion</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>