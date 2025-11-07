<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>

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
                    <img id="logo" src="../imagenes/logo-kine.webp" alt="logo">
                </a>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <button class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Tipos de tratamientos
                            </button>
                            <ul class="dropdown-menu">
                                <?php
                                    $tratamientos = mysqli_query($conexion, $lecturaTratamientos);
                                    while ($tratamiento = mysqli_fetch_array($tratamientos)) {
                                        echo 
                                        "<li>
                                            <a class='dropdown-item' href='../paginas/tratamiento.php?id=$tratamiento[id_tratamientos]'>
                                                $tratamiento[nombre]
                                            </a>
                                        </li>";
                                    }
                                ?>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="div-sesion">
                <a class="iniciar-sesion" href="login.php">Iniciar Sesion</a>
            </div>
        </nav>
    </header>