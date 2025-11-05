<?php
    include_once("../componentes/config/config.php");
    include_once("./abml/lectura.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informacion de sesion</title>
    <?php
        include_once("../librerias/bootstrap-css.php");
    ?>

    <link rel="stylesheet" href="../css-admin/informacion-sesion.css">
</head>
<body>
    <?php
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $lecturaSesiones .= " WHERE `id_sesiones`='$id'";
            $sesiones = mysqli_query($conexion,$lecturaSesiones);

            $rutaImagen;
            $usuarioSesion;
            $horarioSesion;
            $estadoSesion;
            $tratamientosSesion = "<p><span>Tratamientos:</span> ";
            $montoSesion;
            $detallesSesion;

            if ($sesion = mysqli_fetch_array($sesiones)) {
                $rutaImagen = "../imagenes-subidas/$sesion[imagen]";
                
                $detallesSesion = "<p><span>Detalles:</span> $sesion[detalles]</p>";

                $lecturaUsuarios .= "WHERE `id_personas`='$sesion[fk_personas]'";
                $usuarios = mysqli_query($conexion,$lecturaUsuarios);

                if ($usuario = mysqli_fetch_array($usuarios)) {
                    $usuarioSesion = "<p><span>Paciente:</span> $usuario[nombre] $usuario[apellido]</p>";
                }
                $lecturaHorarios .= "WHERE `id_fechas_horas`='$sesion[fk_fechas_horas]'";
                $horarios = mysqli_query($conexion,$lecturaHorarios);

                if ($horario = mysqli_fetch_array($horarios)) {
                    $horarioSesion = "<p><span>Fecha y hora:</span> $horario[fecha]   -   $horario[hora]</p>";
                }
                $lecturaEstados .= " WHERE `id_estado`='$sesion[fk_estado_sesion]'";
                $estados = mysqli_query($conexion,$lecturaEstados);

                $montoSesion = "<p>$ $sesion[monto]</p>";
                if ($estado = mysqli_fetch_array($estados)) {
                    $estadoSesion = "<p><span>Estado:</span> $estado[nombre]</p>";
                }
                $lecturaSesionesTratamientos .= " WHERE `fk_sesiones`='$sesion[id_sesiones]'";
                $sesionesTratamientos = mysqli_query($conexion,$lecturaSesionesTratamientos);
                while ($sesionTratamiento = mysqli_fetch_array($sesionesTratamientos)) {
                    $lecturaTratamientos = "SELECT * FROM `tratamientos`";
                    $lecturaTratamientos .= " WHERE `id_tratamientos`='$sesionTratamiento[fk_tratamientos]'";
                    $tratamientos = mysqli_query($conexion,$lecturaTratamientos);
                    if ($tratamiento = mysqli_fetch_array($tratamientos)) {
                        $tratamientosSesion .= "  $tratamiento[nombre]  ";
                    }
                }
                $tratamientosSesion .= "</p>";
            }
        }
    include_once("../librerias/bootstrap-js.php");
    ?>
    <header>
        <nav>
            <a href="sesiones.php">Volver atras</a>
        </nav>
    </header>
    <main>
        <section>
            <article class="card mb-3">
                <div>
                    <img src="<?php echo $rutaImagen ?>" class="card-img-top" alt="...">
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $usuarioSesion ?></h5>
                    <p class="card-text"><?php echo $estadoSesion ?></p>
                    <p class="card-text"><?php echo $horarioSesion ?></p>
                    <p class="card-text"><?php echo $tratamientosSesion ?></p>
                    <p class="card-text"><small class="text-body-secondary"><?php echo $montoSesion ?></small></p>
                    <span class="subrayado"></span>
                    <p class="card-text"><?php echo $detallesSesion ?></p>
                </div>
            </article>
        </section>
    </main>
</body>
</html>