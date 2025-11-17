<?php
    include_once("../componentes-admin/header.php");
    $id;
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
    }
?>
<main>
    <link rel="stylesheet" href="../css-admin/sesiones-completas.css">
    <section>
        <?php
            $tituloTratamiento = "";
            if ($t = mysqli_fetch_array(mysqli_query($conexion, $lecturaTratamientos .= " WHERE `id_tratamientos`=$id"))) {
                $tituloTratamiento = $t["nombre"];
            }
        ?>
        <h1 class="text-center">Sesiones - <?php echo $tituloTratamiento ?></h1>
        <?php
            $fkSesion = 0;
            $fkUsuario = 0;
            $estadoSesion = "";
            $fkFechaHora = 0;
            $imagen = "";
            $monto = 0;
            $nombreUsuario = "";
            $fecha = "";
            $hora = "";
            $tratamientosSesion = "";
            $detalles = "";

            $lecturaSesionesTratamientos .= " WHERE `fk_tratamientos`='$id'";

            $sesionesTratamientos = mysqli_query($conexion,$lecturaSesionesTratamientos);

            while ($sesionTratamiento = mysqli_fetch_array($sesionesTratamientos)) {
                $fkSesion = $sesionTratamiento["fk_sesiones"];
                $lecturaTratamientos = "SELECT * FROM `tratamientos`";
                $lecturaSesiones = "SELECT * FROM `sesiones`";
                $lecturaUsuarios = "SELECT * FROM `personas`";
                $lecturaHorarios = "SELECT * FROM `fechas_horas`";

                $tratamientosSesion = "";

                $resultadoTratamientos = mysqli_query($conexion, $lecturaTratamientos .= " WHERE `id_tratamientos`='$sesionTratamiento[fk_tratamientos]'");

                while ($tratamiento = mysqli_fetch_array($resultadoTratamientos)) {
                    $tratamientosSesion .= $tratamiento["nombre"];
                }

                $resultadoSesion = mysqli_query($conexion,$lecturaSesiones .= " WHERE `id_sesiones`='$fkSesion'");

                if ($sesion = mysqli_fetch_array($resultadoSesion)) {
                    $fkUsuario = $sesion["fk_personas"];
                    if ($sesion["fk_estado_sesion"] == 1) {
                        $estadoSesion = "Pendiente";
                    }
                    elseif ($sesion["fk_estado_sesion"] == 2) {
                        $estadoSesion = "En proceso";
                    }
                    else {
                        $estadoSesion = "Completada";
                    }
                    $fkFechaHora = $sesion["fk_fechas_horas"];
                    $detalles = $sesion["detalles"];
                    if (empty($detalles)) {
                        $detalles = "Ninguno";
                    }
                    $imagen = $sesion["imagen"];
                    $monto = $sesion["monto"];
                }
                $lecturaUsuarios .= " WHERE `id_personas`='$fkUsuario'";
                
                $resultadoUsuario = mysqli_query($conexion,$lecturaUsuarios);
                
                $emailUsuario = "";
                $telefono = 0;
                $dni = 0;
                $fechaNacimiento = "";

                if ($usuario = mysqli_fetch_array($resultadoUsuario)) {
                    $nombreUsuario = $usuario["nombre"] . " " . $usuario["apellido"];
                    $emailUsuario = "<span>Email:</span> $usuario[email]";
                    $telefono = "<span>Telefono:</span> $usuario[telefono]";
                    $dni = "<span>Dni:</span> $usuario[dni]";
                    $fechaNacimiento = "<span>Fecha Nacimiento:</span> $usuario[fecha_nacimiento]";
                }

                $lecturaHorarios .= " WHERE `id_fechas_horas`='$fkFechaHora'";

                $resultadoHorario = mysqli_query($conexion,$lecturaHorarios);
                
                if ($horario = mysqli_fetch_array($resultadoHorario)) {
                    $fecha = $horario["fecha"];
                    $hora = $horario["hora"];
                }

                echo "<article class='card mb-3'>
                        <div>
                            <img src='  ../imagenes-subidas/$imagen ' class='card-img-top' alt='...'>
                        </div>
                        <div class='card-body'>
                            <h5 class='card-title'>Paciente: $nombreUsuario </h5>
                            <p class='card-text'><?php echo $emailUsuario</p>
                            <p class='card-text'><?php echo $telefono</p>
                            <p class='card-text'><?php echo $dni</p>
                            <p class='card-text'><?php echo $fechaNacimiento</p>
                            <hr>
                            <p class='card-text'>Estado: $estadoSesion</p>
                            <p class='card-text'>Fecha: $fecha</p>
                            <p class='card-text'>Hora: $hora</p>
                            <hr>
                            <p class='card-text'><small class='text-body-secondary'>$ $monto</small></p>
                            <p class='card-text'>Detalles: $detalles
                            </p>
                        </div>
                    </article>";
            }
        ?>
    </section>
</main>
<?php
    include_once("../componentes-admin/footer.php");
?>