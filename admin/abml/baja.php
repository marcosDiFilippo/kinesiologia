<?php
    session_start();
    if ($_SESSION == NULL) {
        header("Location: ../../index.php");
        exit();
    }
    include_once("../../componentes/config/config.php");
    include_once("lectura.php");
    
    $nombrePaciente;
    $id;
    $bajaPersonas;
    $bajaPago;
    $bajaSesion;
    $bajaTratamiento;
    
    if (isset($_GET["idU"])) {
        if (!empty($_GET["idU"])) {
            $id = htmlspecialchars($_GET["idU"]);
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
            exit();
        }
    }
    if (isset($_GET["idS"])) {
        $idSesion = htmlspecialchars($_GET["idS"]);
        mysqli_query($conexion,"DELETE FROM `sesiones` WHERE `id_sesiones`='$idSesion'");
        mysqli_query($conexion,"DELETE FROM `sesiones_tratamientos` WHERE `fk_sesiones`='$idSesion'");
        mysqli_query($conexion,"DELETE FROM `pago_sesiones` WHERE `fk_sesiones`='$idSesion'");

        header("Location: ../sesiones.php?bajaS=ok");
        exit();
    }
    if (isset($_GET["idT"])) {
        $idTratamiento = $_GET["idT"];
        $lecturaTratamientos .= " WHERE `id_tratamientos`='$idTratamiento'";

        $nombreTratamiento = "";
        if ($tratamiento = mysqli_fetch_array(mysqli_query($conexion, $lecturaTratamientos))) {
            $nombreTratamiento = $tratamiento["nombre"];
        }

        mysqli_query($conexion,"DELETE FROM `tratamientos` WHERE `id_tratamientos`='$idTratamiento'");

        mysqli_query($conexion,"DELETE FROM `sesiones_tratamientos` WHERE `fk_tratamientos`='$idTratamiento'");

        header("Location: ../tratamientos.php?baja=$nombreTratamiento");
        exit();
    }
?>