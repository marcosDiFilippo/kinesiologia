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
            </div>
            <div class="div-sesion">
                <a class="iniciar-sesion" href="login.php">Iniciar Sesion</a>
            </div>
        </nav>
    </header>