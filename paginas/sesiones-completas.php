<?php
    include_once("../componentes/header.php");
    $id;
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
    }
?>
<?php
    $tituloTratamiento = "";
    if ($t = mysqli_fetch_array(mysqli_query($conexion, $lecturaTratamientos .= " WHERE `id_tratamientos`=$id"))) {
        $tituloTratamiento = $t["nombre"];
    }
?>
<?php
    $cards = "";
    $sumaTotal = 0;                    
    $fkSesion = 0;
    $fkUsuario = 0;
    $estadoSesion = "";
    $fkFechaHora = 0;
    $imagen = "";
    $monto = 0;
    $nombreUsuario = "";
    $detalles = "";

    $lecturaSesionesTratamientos .= " WHERE `fk_tratamientos`='$id'";

    $sesionesTratamientos = mysqli_query($conexion,$lecturaSesionesTratamientos);

    $numeroFilas = mysqli_num_rows($sesionesTratamientos);

    while ($sesionTratamiento = mysqli_fetch_array($sesionesTratamientos)) {
        $fkSesion = $sesionTratamiento["fk_sesiones"];
        $lecturaTratamientos = "SELECT * FROM `tratamientos`";
        $lecturaSesiones = "SELECT * FROM `sesiones`";
        $lecturaUsuarios = "SELECT * FROM `personas`";
        $lecturaHorarios = "SELECT * FROM `fechas_horas`";

        $resultadoTratamientos = mysqli_query($conexion, $lecturaTratamientos .= " WHERE `id_tratamientos`='$sesionTratamiento[fk_tratamientos]'");

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

            $sumaTotal += $monto;
        }
        $lecturaUsuarios .= " WHERE `id_personas`='$fkUsuario'";
        
        $resultadoUsuario = mysqli_query($conexion,$lecturaUsuarios);
        
        $emailUsuario = "";
        $telefono = 0;
        $dni = 0;
        $fechaNacimiento = "";

        if ($usuario = mysqli_fetch_array($resultadoUsuario)) {
            $nombreUsuario = $usuario["nombre"] . " " . $usuario["apellido"];
        }

        $cards .= "<article class='card mb-3'>
                <div>
                    <img src='../imagenes-subidas/$imagen' class='card-img-top' alt='...'>
                </div>
                <div class='card-body'>
                    <h5 class='card-title'>Paciente: $nombreUsuario </h5>
                    <hr>
                    <p class='card-text'>Estado: $estadoSesion</p>
                    <hr>
                    <p class='card-text'><small class='text-body-secondary'>Monto: $ $monto</small></p>
                    <p class='card-text'>Detalles: $detalles
                    </p>
                </div>
            </article>";
    }
    $promedio = $sumaTotal / $numeroFilas;
?>
<main>
    <link rel="stylesheet" href="../css-admin/sesiones-completas.css">
    <section>
        <article class="d-flex flex-column justifi-content-center align-items-center">
            <p class="mt-4">Promedio de las sesiones con <?php echo $tituloTratamiento . ": " . $promedio ?></p>
            <p>Cantidad de sesiones con <?php echo $tituloTratamiento . ": $numeroFilas"?></p>
        </article>
    </section>
    <section>
        <?php echo $cards ?>
    </section>
</main> 
<?php
    include_once("../componentes/footer.php");
?>