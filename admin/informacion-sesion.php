<?php
    session_start();
    if ($_SESSION == NULL) {
        header("Location: ../index.php");
    }
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
        $id;
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            $lecturaSesiones .= " WHERE `id_sesiones`='$id'";
            $sesiones = mysqli_query($conexion,$lecturaSesiones);

            $rutaImagen;
            $usuarioSesion;
            $fecha;
            $hora;
            $estadoSesion;
            $tratamientosSesion = "<span>Tratamientos:</span> ";
            $montoSesion;
            $detallesSesion = "<span>Detalles:</span>";
            $emailUsuario;
            $telefono;
            $dni;

            if ($sesion = mysqli_fetch_array($sesiones)) {
                $rutaImagen = "../imagenes-subidas/$sesion[imagen]";
                
                if (!empty($sesion["detalles"]) or !$sesion["detalles"] == NULL) {
                    $detallesSesion .= " $sesion[detalles]";
                }
                else {
                    $detallesSesion .= " Ninguno";
                }

                $lecturaUsuarios .= "WHERE `id_personas`='$sesion[fk_personas]'";
                $usuarios = mysqli_query($conexion,$lecturaUsuarios);

                if ($usuario = mysqli_fetch_array($usuarios)) {
                    $usuarioSesion = "<span>Paciente:</span> $usuario[nombre] $usuario[apellido]";
                    $emailUsuario = "<span>Email:</span> $usuario[email]";
                    $telefono = "<span>Telefono:</span> $usuario[telefono]";
                    $dni = "<span>Dni:</span> $usuario[dni]";
                }
                $lecturaHorarios .= "WHERE `id_fechas_horas`='$sesion[fk_fechas_horas]'";
                $horarios = mysqli_query($conexion,$lecturaHorarios);

                if ($horario = mysqli_fetch_array($horarios)) {
                    $fecha = "<span>Fecha: </span> $horario[fecha]";
                    $hora = "<span>Hora: </span> $horario[hora]";
                }
                $lecturaEstados .= " WHERE `id_estado`='$sesion[fk_estado_sesion]'";
                $estados = mysqli_query($conexion,$lecturaEstados);

                $montoSesion = "<span>Monto: </span>$ $sesion[monto]";
                if ($estado = mysqli_fetch_array($estados)) {
                    $estadoSesion = "<span>Estado:</span> $estado[nombre]";
                }
                $lecturaSesionesTratamientos .= " WHERE `fk_sesiones`='$sesion[id_sesiones]'";
                $sesionesTratamientos = mysqli_query($conexion,$lecturaSesionesTratamientos);

                while ($sesionTratamiento = mysqli_fetch_array($sesionesTratamientos)) {
                    $lecturaTratamientos = "SELECT * FROM `tratamientos`";
                    $lecturaTratamientos .= " WHERE `id_tratamientos`='$sesionTratamiento[fk_tratamientos]'";
                    $tratamientos = mysqli_query($conexion,$lecturaTratamientos);
                    if ($tratamiento = mysqli_fetch_array($tratamientos)) {
                        $tratamientosSesion .= "<li>- $tratamiento[nombre]</li>";
                    }
                }
            }
        }
        include_once("../librerias/bootstrap-js.php");
    ?>
    <main id="main-info">
        <section class="section-sesion">
            <article>
                <a class="volver-atras" href="sesiones.php">Volver atras</a>
            </article>
            <article class="card mb-3">
                <div>
                    <img src="<?php echo $rutaImagen ?>" class="card-img-top" alt="...">
                </div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $usuarioSesion ?></h5>
                    <p class="card-text"><?php echo $emailUsuario ?></p>
                    <p class="card-text"><?php echo $telefono ?></p>
                    <p class="card-text"><?php echo $dni ?></p>
                    <span class="subrayado"></span>
                    <p class="card-text"><?php echo $estadoSesion ?></p>
                    <p class="card-text"><?php echo $fecha ?></p>
                    <p class="card-text"><?php echo $hora ?></p>
                    <ul class="lista-tratamientos">
                        <?php 
                            echo $tratamientosSesion;
                        ?>  
                    </ul>
                    <span class="subrayado"></span>
                    <p class="card-text"><?php echo $detallesSesion ?>
                    <p class="card-text"><small class="text-body-secondary"><?php echo $montoSesion ?></small></p>
                    </p>
                </div>
                <div class="acciones-sesion">
                    <a href="./abml/baja.php?idS=<?php echo$id?>">Dar de baja</a>
                    <a href="./abml/modificacion-sesion.php?idS=<?php echo$id?>">Editar</a>
                </div>
            </article>
        </section>
    </main>
</body>
</html>