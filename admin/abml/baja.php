<?php
    include_once("../../componentes/config/config.php");
    include_once("lectura.php");
    
    $nombrePaciente;
    $id;
    $bajaPersonas;
    $bajaPago;
    $bajaSesion;
    $bajaTratamiento;
    
    if (isset($_GET["id"])) {
        if (!empty($_GET["id"])) {
            $id = htmlspecialchars($_GET["id"]);
            $lecturaUsuarios .= " WHERE `id_personas`='$id'";
            
            $resultadoUsuario = mysqli_query($conexion, $lecturaUsuarios);
            if ($paciente = mysqli_fetch_array($resultadoUsuario)) {
                $nombrePaciente = $paciente["nombre"] . " " . $paciente["apellido"];
            }

            $lecturaSesiones .= " WHERE `fk_personas`='$id'";
            $resultadoSesion = mysqli_query($conexion, $lecturaSesiones);

            if ($sesion = mysqli_fetch_array($resultadoSesion)) {
                $bajaPago = "DELETE FROM `pago_sesiones` WHERE `fk_sesiones`='$sesion[id_sesiones]'";
                mysqli_query($conexion, $bajaPago);

                $bajaTratamiento = "DELETE FROM `sesiones_tratamientos` WHERE `fk_sesiones`='$sesion[id_sesiones]'";
                mysqli_query($conexion, $bajaTratamiento);
            }

            $bajaSesion = "DELETE FROM `sesiones` WHERE `fk_personas`='$id'";
            mysqli_query($conexion, $bajaSesion);

            $bajaPersonas = "DELETE FROM `personas` WHERE `id_personas`='$id'";
            mysqli_query($conexion, $bajaPersonas);

            header("Location: ../pacientes.php?baja=$nombrePaciente");
        }
    }
?>