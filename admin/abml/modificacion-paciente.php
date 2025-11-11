<?php
    session_start();
    if ($_SESSION == NULL) {
        header("Location: ../../index.php");
        exit();
    }

    include_once("../../componentes/config/config.php");
    include_once("lectura.php");
    $nombre;
    $apellido; 
    $dni; 
    $fechaNacimiento; 
    $email; 
    $telefono; 
    
    $idPersona;
    if (isset($_GET["idU"])) {
        $idPersona = $_GET["idU"];
    }
    $lecturaUsuarios .= " WHERE `id_personas`='$idPersona'";
    $usuarios = mysqli_query($conexion, $lecturaUsuarios);
    
    if ($usuario = mysqli_fetch_array($usuarios)) {
        $nombre = $usuario["nombre"];
        $apellido = $usuario["apellido"];
        $dni = $usuario["dni"];
        $fechaNacimiento = $usuario["fecha_nacimiento"];
        $email = $usuario["email"];
        $telefono = $usuario["telefono"];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificacion Paciente</title>

    <link rel="stylesheet" href="../../css-admin/main.css">

    <?php
        include_once("../../librerias/bootstrap-css.php");
    ?>
</head>
<body>
    <main class="main-mod-paciente">
        <section>
            <article>
                <a class="volver-atras" href="../pacientes.php">Volver atras</a>
            </article>
            <article class="container"> 
                <div>
                    <p>
                        Paciente Seleccionado: <?php echo $nombre . " " . $apellido?>
                    </p>
                    <p>
                        Dni: <?php echo $dni?>
                    </p>
                    <p>
                        Fecha Nacimiento: <?php echo $fechaNacimiento ?>
                    </p>
                    <p>
                        Email <?php echo $email?>
                    </p>
                    <p>
                        Telefono: <?php echo $telefono?>
                    </p>
                </div>
                <form class="container-fluid form-modificacion" action="procesar-modificacion.php" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <input type="hidden" name="id_paciente" value="<?php echo $idPersona?>">
                    </div>
                    <div class="row">
                        <div class="col-6 text-start">
                            <label for="nombre">Nombre:</label>
                            <input class="col-11 input-paciente" type="text" name="nombre" id="nombre" placeholder="Ingresa el nombre" value="<?php echo "$nombre"?>">
                            <label for="fecha-nacimiento">Fecha Nacimiento:</label>
                            <input class="col-11 input-paciente" type="date" name="fecha-nacimiento" id="fecha-nacimiento" value="<?php echo $fechaNacimiento?>">
                            <label class="ms-2" for="email">Email:</label>
                            <input class="col-11 input-paciente" type="email" name="email" id="email" placeholder="Ingrese el email" autocomplete="additional-name" value="<?php echo $email?>">
                        </div>
                        <div class="col-6">
                            <label for="apellido">Apellido:</label>
                            <input class="col-12 input-paciente" type="text" name="apellido" id="apellido" placeholder="Ingresa el apellido" value="<?php echo $apellido?>">
                            <label for="dni">Dni:</label>
                            <input class="col-12 input-paciente" type="number" name="dni" id="dni" placeholder="Ingrese el dni" value="<?php echo $dni?>">
                            <label for="telefono">Telefono:</label>
                            <input class="col-12 input-paciente" type="number" name="telefono" id="telefono" placeholder="Ingrese el telefono" value="<?php echo $telefono?>">
                        </div>
                    </div>
                    <div>
                        <button class="submit-paciente" type="submit" value="Modificar Paciente">Modificar Paciente</button>
                    </div>
                </form>
            </article>
        </section>
    </main>
</body>
</html>