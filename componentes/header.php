<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>

    <link rel="icon" type="image/x-icon" href="../imagenes/logo-kine.ico">   
    <?php
        include_once("../librerias/bootstrap-css.php");
        include_once("../admin/abml/lectura.php");
        include_once("../componentes/config/config.php");
    ?>
    <link rel="stylesheet" href="../css-paginas/main.css">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="../paginas/index.php">
                    <img class="logo" src="../imagenes/logo-kine.webp" alt="logo">
                </a>
                <?php
                    $listaEntera = "";

                    if ($_SESSION != NULL) {
                        $tratamientos = mysqli_query($conexion, $lecturaTratamientos);
                        
                        while ($tratamiento = mysqli_fetch_array($tratamientos)) {
                            $conteoTratamientos = mysqli_query($conexion,"SELECT COUNT(`fk_tratamientos`) FROM `sesiones_tratamientos` WHERE `fk_tratamientos`='$tratamiento[id_tratamientos]'");
                            
                            while ($c = mysqli_fetch_array($conteoTratamientos))
                            {
                                $listaEntera .= "<li class='d-flex align-items-center'>
                                <a class='dropdown-item' href='../paginas/sesiones-completas.php?id=$tratamiento[id_tratamientos]'>
                                $tratamiento[nombre]
                                </a>
                                <small class='me-4'>($c[0])</small>
                                </li>";
                            }
                        }
                        echo "<div class='collapse navbar-collapse' id='navbarNavDropdown'>
                                <ul class='navbar-nav'>
                                    <li class='nav-item dropdown'>
                                        <button class='nav-link dropdown-toggle' role='button' data-bs-toggle='dropdown' aria-expanded='false'>
                                            Tratamientos
                                        </button>
                                        <ul class='dropdown-menu'>
                                            $listaEntera
                                        </ul>
                                    </li>
                                </ul>
                            </div>";
                    }
                ?>
            </div>
            <div class="div-log d-flex justift-content-center align-items-center">
                <?php
                    if ($_SESSION == NULL) {
                        echo "<a href='../paginas/register.php'>Registrarse</a>";
                        echo "<a href='login.php'>Iniciar Sesion</a>";
                    }
                    else {
                        echo "<a class='ms-5' href='../log/cerrarSesion.php'>Cerrar Sesion</a>";
                    }
                ?>
            </div>
        </nav>
    </header>