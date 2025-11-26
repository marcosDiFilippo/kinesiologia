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
                        echo "<div class='configuracion'>
                                <a class='d-flex align-items-center' href='../configuracion/configuracion.php?perfil=ok'>
                                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='icon icon-tabler icons-tabler-outline icon-tabler-settings'><path stroke='none' d='M0 0h24v24H0z' fill='none'/><path d='M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z' /><path d='M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0' /></svg>
                                    Configuracion
                                </a>
                            </div>";
                        echo "<a class='ms-5' href='../log/cerrarSesion.php'>Cerrar Sesion</a>";
                    }
                ?>
            </div>
        </nav>
    </header>