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
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <!--<li class="nav-item">
                            <a class="nav-link" href="#">
                                Features
                            </a>
                        </li>-->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Tipos de tratamientos
                            </a>
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
        </nav>
    </header>