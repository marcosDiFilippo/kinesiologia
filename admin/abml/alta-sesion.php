<?php
    error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
    session_start();
    if ($_SESSION == NULL) {
        header("Location: ../../index.php");
        exit();
    }
    if ($_SESSION["fk_rol"] == 3) {
        header("Location: ../../index.php");
        exit();
    }
    include_once("../../componentes/config/config.php");
    include_once("./lectura.php");
    include_once("../validaciones.php");
    function realizarAltaPago ($metodoPago, $fk_sesion, $conexion) {
        for ($i=0; $i < count($metodoPago); $i++) { 
            mysqli_query($conexion, "INSERT INTO `pago_sesiones`(`fk_metodos_pago`, `fk_sesiones`) VALUES ('$metodoPago[$i]','$fk_sesion')");
        }
    }   
    function realizarAltaSesion ($detalles, $imagen, $fk_persona, $fk_horario, $fk_estado, $monto, $conexion, $lecturaSesiones) : int {
        $temp = $imagen["tmp_name"];
        $nombreImagen = time() . ".webp";

        move_uploaded_file($temp, "../../imagenes-subidas/$nombreImagen");

        mysqli_query($conexion,"INSERT INTO `sesiones`(`detalles`, `imagen`, `fk_personas`, `fk_fechas_horas`, `fk_estado_sesion`, `monto`) VALUES ('$detalles','$nombreImagen','$fk_persona','$fk_horario','$fk_estado','$monto')");

        $lecturaSesiones .= " WHERE `imagen`='$nombreImagen'";
        $resultadoSelect = mysqli_query($conexion, $lecturaSesiones);

        $fk_sesion = 0;
        if ($sesion = mysqli_fetch_array($resultadoSelect)) {
            $fk_sesion = $sesion["id_sesiones"];
        }

        return $fk_sesion;
    }
    function realizarAltaTratamientos ($fk_sesion, $tratamientoss, $conexion) {
        for ($i=0; $i < count($tratamientoss); $i++) { 
            mysqli_query($conexion,"INSERT INTO `sesiones_tratamientos`(`fk_sesiones`, `fk_tratamientos`) VALUES ('$fk_sesion','$tratamientoss[$i]')");
        }
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (
            isset($_POST["fecha"]) &&
            isset($_POST["hora"]) &&
            isset($_POST["metodos-pago"]) &&
            isset($_POST["monto"]) &&
            isset($_POST["estado"]) &&
            isset($_POST["tratamientos"]) &&
            isset($_FILES["imagen"])
        ) {
            $idUsuario = (int) htmlspecialchars($_POST["id-usuario"]);
            if ($idUsuario == -1) {
                header("Location: ../sesiones.php?usuarioNoIngresado=ok");
                exit();
            }

            $fecha = htmlspecialchars($_POST["fecha"]);

            $hora = htmlspecialchars($_POST["hora"]);

            $metodoPago = array_map(function ($metodo) {
                return (int) $metodo;
            }, $_POST["metodos-pago"]);

            $monto = (double) htmlspecialchars($_POST["monto"]);

            $estado = (int) htmlspecialchars($_POST["estado"]);

            $tratamientoss = array_map(function ($tratamiento) {
                return $tratamiento;
            }, $_POST["tratamientos"]);

            $detalles = htmlspecialchars($_POST["detalles"]);

            $imagen = $_FILES["imagen"];

            $metodosPagoString = "";

            $tratamientosString = "";

            foreach ($metodoPago as $metodo) {
                $metodosPagoString .= $metodo;
            }
            foreach ($tratamientoss as $trata) {
                $tratamientosString .= $trata;
            }

            $campos = [$fecha, $hora, $metodosPagoString, $monto, $estado, $tratamientosString, $imagen];

            if (validarCamposVacios($campos) == true) {
                header("Location: ../sesiones.php?camposVacios=ok");
                exit();
            }

            $camposNumericos = [$metodosPagoString, $tratamientosString, $monto];
            if (validarLetrasCampo($camposNumericos) == true) {
                header("Location: ../sesiones.php?campoNoNumericos=ok");
                exit();
            }

            $posiblesCamposNegativos = array_map(function ($numero) {
                return (float) $numero;
            }, $camposNumericos);

            if (validarCampoNegativo($posiblesCamposNegativos) == true) {
                header("Location: ../sesiones.php?camposNegativos=ok");
                exit();
            }

            $fk_horario_aux = validarHorarios(
                $lecturaHorarios,
                $fecha, 
                $hora, 
                $conexion
            );

            $fk_horario;
            if ($fk_horario_aux != -1) {
                $fk_horario = $fk_horario_aux;
            }
            else {
                mysqli_query($conexion,"INSERT INTO `fechas_horas`(`fecha`, `hora`) VALUES ('$fecha','$hora')");

                $lecturaHorarios .= " WHERE `fecha`='$fecha' and `hora`='$hora'";
                
                $resultadoHorario = mysqli_query($conexion,$lecturaHorarios);
                
                if ($horario = mysqli_fetch_array($resultadoHorario)) {
                    $fk_horario = $horario["id_fechas_horas"];
                }
            }

            $fk_persona = $idUsuario;

            $tempImagen = time() . ".jpg";
            $fk_sesion = realizarAltaSesion(
                $detalles, 
                $imagen, 
                $fk_persona, 
                $fk_horario, 
                $estado, 
                $monto, 
                $conexion, 
                $lecturaSesiones);
            
            realizarAltaPago($metodoPago, $fk_sesion, $conexion);

            realizarAltaTratamientos($fk_sesion, $tratamientoss, $conexion);
            
            $usuarioIngresado = [];
            if ($user = mysqli_fetch_array(mysqli_query($conexion, $lecturaUsuarios .= " WHERE `id_personas`='$idUsuario'"))) {
                $usuarioIngresado = $user;
            }
            var_dump($usuarioIngresado);
            mysqli_query($conexion,"INSERT INTO `historial_acciones`(`fecha`,`hora`,`descripcion`) VALUES (CURDATE(),CURTIME(),'Se agrego una nueva sesion del paciente $usuarioIngresado[nombre]  $usuarioIngresado[apellido] a la lista')");
            header("Location: ../sesiones.php?alta=ok");
        }
        else {
            header("Location: ../sesiones.php?camposVacios=ok");
        }
    }
?>